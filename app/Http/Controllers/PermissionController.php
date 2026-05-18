<?php
namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->get();
        return view('dashboard.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name','module'=>'required']);
        Permission::create(['name' => $request->name,'module'=>$request->module]);
        return redirect()->back()->with('success', 'Permission added successfully!');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Permission deleted.');
    }
}
