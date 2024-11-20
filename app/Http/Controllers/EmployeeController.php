<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Show the employees page
    public function index(Request $request)
    {
        // Fetch employees with search filters if provided
        $query = Employees::with('user'); // Fetch the related user data

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

        return view('employee.index', compact('employees'));
    }

    // Update employee salary
    public function updateSalary(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|exists:employees,employee_id',
            'new_salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::where('employee_id', $request->input('emp_id'))->firstOrFail();
        $employee->salary = $request->input('new_salary');
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Salary updated successfully.');
    }
}
