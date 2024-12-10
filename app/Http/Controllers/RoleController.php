<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('admin.roles.create', compact('roles')); 
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'access_level' => 'required|string|max:255',
        ]);

        Role::create([
            'role_name' => $request->role_name,
            'access_level' => $request->access_level,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function edit($id)
{
    $role = Role::findOrFail($id);
    return view('admin.roles.edit', compact('role'));  
}
public function update(Request $request, $id)
{
    $request->validate([
        'role_name' => 'required|string|max:255',
        'access_level' => 'required|string|max:255',
    ]);

    $role = Role::findOrFail($id);
    $role->update([
        'role_name' => $request->role_name,
        'access_level' => $request->access_level,
    ]);

    return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
}
public function destroy($id)
{
    $role = Role::findOrFail($id);
    $role->delete();

    return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
}

}
