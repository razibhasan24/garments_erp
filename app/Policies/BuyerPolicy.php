<?php
// app/Policies/BuyerPolicy.php
namespace App\Policies;

use App\Models\Buyer;
use App\Models\User;

class BuyerPolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-buyers'); }
    public function view(User $user, Buyer $buyer): bool { return $user->can('manage-buyers'); }
    public function create(User $user): bool { return $user->can('manage-buyers'); }
    public function update(User $user, Buyer $buyer): bool { return $user->can('manage-buyers'); }
    public function delete(User $user, Buyer $buyer): bool { return $user->can('manage-buyers'); }
    public function restore(User $user, Buyer $buyer): bool { return $user->can('manage-buyers'); }
}
