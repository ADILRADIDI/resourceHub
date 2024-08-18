<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Retrieve all roles with their associated permissions.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all roles along with their associated permissions
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
        // Validate the request data
        $request->validate([
            'name' => 'required|string|unique:roles', // Role name must be unique
            'permissions' => 'array', // Permissions must be an array
            'permissions.*' => 'string|exists:permissions,name', // Each permission must exist
            // No need to validate guard_name as it will be set automatically
        ]);

        // Create a new role with guard_name set to 'web'
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web' // Set guard_name to 'web'
        ]);

        // Assign permissions if provided
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->givePermissionTo($permissions);
        }

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role
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
        // Return the specific role with its permissions
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
        // Validate the request data
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id, // Role name must be unique except for this role
            'permissions' => 'array', // Permissions must be an array
            'permissions.*' => 'string|exists:permissions,name', // Each permission must exist
            // No need to validate guard_name as it will be set automatically
        ]);

        // Update role details with guard_name set to 'web'
        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'web' // Set guard_name to 'web'
        ]);

        // Sync permissions if provided
        if ($request->has('permissions')) {
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
        // Delete the role
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}
