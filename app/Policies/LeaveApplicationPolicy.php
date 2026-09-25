<?php
// app/Policies/LeaveApplicationPolicy.php
namespace App\Policies;

use App\Models\LeaveApplication;
use App\Models\User;

class LeaveApplicationPolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-leave'); }
    public function view(User $user, LeaveApplication $leave): bool { return $user->can('manage-leave'); }
    public function create(User $user): bool { return $user->can('manage-leave'); }
    public function update(User $user, LeaveApplication $leave): bool { return $user->can('manage-leave'); }
    public function approve(User $user, LeaveApplication $leave): bool { return $user->can('approve-leave'); }
    public function delete(User $user, LeaveApplication $leave): bool { return $user->can('manage-leave'); }
}
