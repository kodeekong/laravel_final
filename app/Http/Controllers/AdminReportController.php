<?php

namespace App\Http\Controllers;

use App\Models\MissedActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|supervisor'); 
    }

    public function index(Request $request)
    {
        $date = $request->input('date');
        
        $query = MissedActivity::query();

        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        $missedActivities = $query->get();

        return view('admin.report', compact('missedActivities'));
    }
}
