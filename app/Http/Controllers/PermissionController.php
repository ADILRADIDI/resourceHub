<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Retrieve all permissions.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all permissions
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Create a new permission.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        // Create new permission
        $permission = Permission::create($request->all());

        return response()->json([
            'message' => 'Permission created successfully',
            'permission' => $permission
        ], 201);
    }

    /**
     * Retrieve a specific permission.
     * 
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    /**
     * Update a specific permission.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Permission $permission)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        // Update permission details
        $permission->update($request->all());

        return response()->json([
            'message' => 'Permission updated successfully',
            'permission' => $permission
        ]);
    }

    /**
     * Delete a specific permission.
     * 
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission)
    {
        // Delete permission
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
