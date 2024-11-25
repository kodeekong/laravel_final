<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show list of users with 'pending' status
    public function showApprovals()
{
    // Fetch users who are not admins or supervisors and are pending approval
    $pendingUsers = User::where('status', 'pending')
                 ->whereNotIn('role', ['Admin', 'Supervisor'])
                 ->get();

    return view('admin.approvals', compact('pendingUsers'));
}



    public function approveUser(User $user)
{
    // Debug: Check if the User model is being received
    if (!$user) {
        return redirect()->route('admin.approvals')->with('error', 'User not found.');
    }

    // Update user status to 'approved'
    $user->status = 'approved';
    $result = $user->save(); // Save to the database

    // Debug: Check if the save operation succeeded
    if (!$result) {
        return redirect()->route('admin.approvals')->with('error', 'Failed to approve user.');
    }

    return redirect()->route('admin.approvals')->with('success', 'User approved successfully.');
}

public function rejectUser(User $user)
{
    if (!$user) {
        return redirect()->route('admin.approvals')->with('error', 'User not found.');
    }

    $user->status = 'rejected';
    $result = $user->save();

    if (!$result) {
        return redirect()->route('admin.approvals')->with('error', 'Failed to reject user.');
    }

    return redirect()->route('admin.approvals')->with('success', 'User rejected successfully.');
}

}
