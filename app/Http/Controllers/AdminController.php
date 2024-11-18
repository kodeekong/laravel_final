<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show list of users with 'pending' status
    public function showApprovals()
    {
        $pendingUsers = User::where('status', 'pending')->get(); // Get users with pending status
        return view('admin.approvals', compact('pendingUsers'));  // Pass the pending users to the view
    }

    // Approve a user
    public function approveUser(User $user)
    {
        $user->update(['status' => 'approved']);  // Update the user's status to 'approved'
        return redirect()->route('admin.approvals')->with('success', 'User approved successfully.');  // Redirect back to approvals page with success message
    }

    // Reject a user
    public function rejectUser(User $user)
    {
        $user->update(['status' => 'rejected']);  // Update the user's status to 'rejected'
        return redirect()->route('admin.approvals')->with('success', 'User rejected successfully.');  // Redirect back with success message
    }
}
