<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employees::with('user'); 

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('employee_id', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%");
                  });
        }

        $employees = $query->get();

        return view('admin.employees', compact('employees'));
    }

    public function emp_index(Request $request)
{
    $query = Employees::query();

    // Apply filters if necessary
    if ($request->filled('name')) {
        $query->where('first_name', 'like', '%' . $request->name . '%')
              ->orWhere('last_name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    if ($request->filled('salary')) {
        $query->where('salary', $request->salary);
    }

    // Fetch all employees using get()
    $employees = $query->get();

    // Pagination manually
    $perPage = 10;  // Items per page
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $employees->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create a LengthAwarePaginator instance manually
    $employeesPaginator = new LengthAwarePaginator(
        $currentItems,
        $employees->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );

    // Pass $employeesPaginator to the view
    return view('admin.employees', compact('employeesPaginator'));
}


public function updateSalary(Request $request)
{
    // Ensure only admins can access this method
    if (auth()->user()->role !== 'Admin') {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'emp_id' => 'required|exists:users,id',
        'salary' => 'required|numeric|min:0',
    ]);

    $employee = \App\Models\Employees::findOrFail($request->employee_id);
    $employee->salary = $request->salary;
    $employee->save();

    return redirect()->route('admin.employees')->with('success', 'Salary updated successfully.');
}

}
