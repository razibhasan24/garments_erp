<?php
// app/Policies/FloorPolicy.php
namespace App\Policies;

use App\Models\Floor;
use App\Models\User;

class FloorPolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-floors'); }
    public function view(User $user, Floor $floor): bool { return $user->can('manage-floors'); }
    public function create(User $user): bool { return $user->can('manage-floors'); }
    public function update(User $user, Floor $floor): bool { return $user->can('manage-floors'); }
    public function delete(User $user, Floor $floor): bool { return $user->can('manage-floors'); }
}
