<?php

namespace App\Http\Controllers;

use App\Models\MissedActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    // Constructor to apply role-based middleware
    public function __construct()
    {
        $this->middleware('role:admin|supervisor'); // Ensure only admins and supervisors can access
    }

    // Method to display the missed activities report
    public function index(Request $request)
    {
        // Fetch the date input from the request (if any)
        $date = $request->input('date');
        
        // Start a query to fetch Missed Activities
        $query = MissedActivity::query();

        // If a date is provided, filter the results by appointment date
        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        // Execute the query and get the results
        $missedActivities = $query->get();

        // Return the view and pass the missed activities data
        return view('admin.report', compact('missedActivities'));
    }
}
