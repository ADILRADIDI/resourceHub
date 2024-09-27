<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Retrieve all roles with their associated permissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return response()->json($roles);
    }

    /**
     * Create a new role.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        // If the role is "super-admin", assign all available permissions
        if ($role->name === 'super-admin') {
            $allPermissions = Permission::all();
            $role->syncPermissions($allPermissions);
        } elseif ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->givePermissionTo($permissions);
        }

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role->load('permissions')
        ], 201);
    }

    /**
     * Retrieve a specific role.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return response()->json($role->load('permissions'));
    }

    /**
     * Update a specific role.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        \Log::info($request->all());
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        // If the role is "super-admin", assign all available permissions
        if ($role->name === 'super-admin') {
            $allPermissions = Permission::all();
            $role->syncPermissions($allPermissions);
        } elseif ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->syncPermissions($permissions);
        }

        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role->load('permissions')
        ]);
    }

    /**
     * Delete a specific role.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
}
