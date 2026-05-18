<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class RoleController extends Controller
{
    
    public function index() 
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    
    public function create()
    {
        return view('dashboard.roles.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role added successfully');
    }

    
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

/*
    public function editPermissions($id)
{
    $role = Role::findOrFail($id);
    $permissions = Permission::all();
    $allowedPermissions = $role->permissions()->wherePivot('allowed', true)->pluck('permission_id')->toArray();

    return view('dashboard.roles.permissions', compact('role', 'permissions', 'allowedPermissions'));
}
*/

public function editPermissions($id)
{
    $role = Role::findOrFail($id);

    // Group permissions by module
    $permissionsByModule = Permission::all()->groupBy('module');

    $allowedPermissions = $role->permissions()
        ->wherePivot('allowed', true)
        ->pluck('permission_id')
        ->toArray();

    return view('dashboard.roles.permissions', compact('role', 'permissionsByModule', 'allowedPermissions'));
}

/*
public function updatePermissions(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $permissionsData = [];
    foreach (Permission::all() as $permission) {
        $permissionsData[$permission->id] = [
            'allowed' => isset($request->permissions[$permission->id])
        ];
    }

    $role->permissions()->sync($permissionsData);

    return redirect()->back()->with('success', 'Permissions updated successfully!');
}*/

public function updatePermissions(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $permissions = $request->input('permissions', []);
    $syncData = [];

    foreach (Permission::all() as $permission) {
        $syncData[$permission->id] = ['allowed' => in_array($permission->id, $permissions)];
    }

    $role->permissions()->sync($syncData);

    return redirect()->back()->with('success', 'Permissions updated successfully.');
}


}
