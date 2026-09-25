<?php
// app/Policies/AttendancePolicy.php
namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;

class AttendancePolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-attendance'); }
    public function view(User $user, Attendance $attendance): bool { return $user->can('manage-attendance'); }
    public function create(User $user): bool { return $user->can('manage-attendance'); }
    public function update(User $user, Attendance $attendance): bool { return $user->can('manage-attendance'); }
    public function delete(User $user, Attendance $attendance): bool { return $user->can('manage-attendance'); }
}
