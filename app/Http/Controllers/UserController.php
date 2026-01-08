<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = User::with('company');

        if ($user->role === 'manager') {
            $query->where('company_id', $user->company_id);
        }

        // Filtros
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('company_id') && $user->role === 'admin') {
            $query->where('company_id', $request->company_id);
        }

        $users = $query->paginate(20);

        $companies = $user->role === 'admin' ? Company::all() : collect();

        return view('users.index', compact('users', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $companies = collect();

        if ($user->role === 'admin') {
            $companies = Company::all();
        } elseif ($user->role === 'manager') {
            // Managers no necesitan ver el campo de empresa, siempre crean en su empresa
            $companies = collect();
        }

        return view('users.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Para managers, forzar su empresa y limitar roles
        if ($user->role === 'manager') {
            $request->merge([
                'company_id' => $user->company_id,
                'role' => 'employee' // Managers solo pueden crear empleados
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_id' => 'required|exists:companies,id',
            'role' => 'required|in:admin,manager,employee',
        ]);

        if ($user->role !== 'admin' && $request->company_id != $user->company_id) {
            abort(403);
        }

        if ($user->role !== 'admin' && $request->role === 'admin') {
            abort(403);
        }

        // Managers no pueden crear managers
        if ($user->role === 'manager' && $request->role === 'manager') {
            abort(403);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('company')->findOrFail($id);
        $authUser = auth()->user();

        if ($authUser->role === 'manager' && $user->company_id !== $authUser->company_id) {
            abort(403, 'Solo puedes ver usuarios de tu empresa.');
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();
        if ($authUser->role !== 'admin' && $user->company_id !== $authUser->company_id) {
            abort(403);
        }

        if ($authUser->role === 'admin') {
            $companies = Company::all();
        } else {
            $companies = Company::where('id', $authUser->company_id)->get();
        }
        return view('users.edit', compact('user', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();
        if ($authUser->role !== 'admin' && $user->company_id !== $authUser->company_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'company_id' => 'required|exists:companies,id',
            'role' => 'required|in:admin,manager,employee',
        ]);

        if ($authUser->role !== 'admin' && $request->company_id != $authUser->company_id) {
            abort(403);
        }

        if ($authUser->role !== 'admin' && $request->role === 'admin') {
            abort(403);
        }

        // Managers no pueden asignar el rol de manager
        if ($authUser->role === 'manager' && $request->role === 'manager') {
            abort(403);
        }

        $user->update($request->except('password'));
        return redirect()->route('users.index')->with('success', 'Usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();
        if ($authUser->role !== 'admin' && $user->company_id !== $authUser->company_id) {
            abort(403);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
    }
}
