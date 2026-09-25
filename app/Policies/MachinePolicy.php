<?php
// app/Policies/MachinePolicy.php
namespace App\Policies;

use App\Models\Machine;
use App\Models\User;

class MachinePolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-machines'); }
    public function view(User $user, Machine $machine): bool { return $user->can('manage-machines'); }
    public function create(User $user): bool { return $user->can('manage-machines'); }
    public function update(User $user, Machine $machine): bool { return $user->can('manage-machines'); }
    public function delete(User $user, Machine $machine): bool { return $user->can('manage-machines'); }
}
