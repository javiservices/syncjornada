<?php

if (!function_exists('translate_role')) {
    /**
     * Translate user role to Spanish
     *
     * @param string $role
     * @return string
     */
    function translate_role($role)
    {
        $translations = [
            'admin' => 'Administrador',
            'manager' => 'Gerente',
            'employee' => 'Empleado',
        ];

        return $translations[$role] ?? ucfirst($role);
    }
}
