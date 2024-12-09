<?php

namespace App\Http\Controllers;

use App\Models\MissedActivity;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin|Supervisor']); // Middleware to restrict access to Admin/Supervisor
    }

    // Show the missed activities report
    public function showReport(Request $request)
    {
        // Get the date input if it exists
        $date = $request->input('date');

        // Filter the missed activities by date if specified
        $missedActivities = MissedActivity::when($date, function ($query) use ($date) {
            return $query->whereDate('appointment_date', $date);
        })->get();  // Retrieve missed activities from the database

        return view('admin.report', compact('missedActivities'));
    }
}

