<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // This method will show the form to create a new role
    public function create()
    {
        return view('admin.roles.create');  // This works as expected
    }

    // This method will list all the roles
    public function index()
    {
        $roles = Role::all();  // Retrieve all roles from the database
        return view('admin.roles.index', compact('roles'));  // Pass the roles to the view
    }

    // This method stores a newly created role in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'role_name' => 'required|string|max:255',
            'access_level' => 'required|string|max:255',
        ]);

        // Create the role in the database
        Role::create([
            'role_name' => $request->role_name,
            'access_level' => $request->access_level,
        ]);

        // Redirect to the role index page with success message
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
}