<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showApprovals()
{
    $pendingUsers = User::where('status', 'pending')
                 ->whereNotIn('role', ['Admin', 'Supervisor'])
                 ->get();

    return view('admin.approvals', compact('pendingUsers'));
}



    public function approveUser(User $user)
{
    if (!$user) {
        return redirect()->route('admin.approvals')->with('error', 'User not found.');
    }

    $user->status = 'approved';
    $result = $user->save(); 

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
