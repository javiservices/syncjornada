<?php

namespace App\Http\Controllers;

use App\Models\IncidentAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentAlertController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->role, ['admin'])) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function edit()
    {
        $alert = IncidentAlert::where('active', true)->first();
        if (!$alert) {
            $alert = new IncidentAlert(['message' => '', 'type' => 'warning', 'active' => true]);
        }
        return view('admin.incident_alert_edit', compact('alert'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger',
            'active' => 'boolean',
        ]);

        $alert = IncidentAlert::where('active', true)->first();
        if (!$alert) {
            $alert = new IncidentAlert();
        }

        $alert->message = $request->message;
        $alert->type = $request->type;
        $alert->active = $request->has('active');
        $alert->save();

        return redirect()->back()->with('success', 'Alerta actualizada.');
    }
}