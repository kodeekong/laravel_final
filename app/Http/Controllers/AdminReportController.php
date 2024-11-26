<?php

namespace App\Http\Controllers;

use App\Models\MissedActivity;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|supervisor']);
    }

    // Show the missed activities report
    public function showReport(Request $request)
    {
        $date = $request->input('date');
        $missedActivities = MissedActivity::when($date, function ($query) use ($date) {
            return $query->whereDate('created_at', $date);
        })->get();

        return view('admin.report', compact('missedActivities'));
    }
}

