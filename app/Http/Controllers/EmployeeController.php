<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display the list of employees.
     */
    public function index(Request $request)
    {
        // Fetch employees based on search filters
        $query = Employee::query();

        if ($request->has('search_id')) {
            $query->where('emp_id', $request->input('search_id'));
        }
        if ($request->has('search_name')) {
            $query->where('name', 'like', '%' . $request->input('search_name') . '%');
        }
        if ($request->has('search_role')) {
            $query->where('role', 'like', '%' . $request->input('search_role') . '%');
        }
        if ($request->has('search_salary')) {
            $query->where('salary', $request->input('search_salary'));
        }

        $employees = $query->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Update the salary of an employee.
     */
    public function updateSalary(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|exists:employees,emp_id',
            'new_salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::where('emp_id', $request->input('emp_id'))->first();

        // Only allow Admin to update salaries
        if (auth()->user()->role !== 'Admin') {
            return redirect()->route('employees.index')->with('error', 'Unauthorized action.');
        }

        $employee->update(['salary' => $request->input('new_salary')]);

        return redirect()->route('employees.index')->with('success', 'Salary updated successfully.');
    }
}
