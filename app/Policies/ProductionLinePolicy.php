<?php
// app/Policies/ProductionLinePolicy.php
namespace App\Policies;

use App\Models\ProductionLine;
use App\Models\User;

class ProductionLinePolicy
{
    public function viewAny(User $user): bool { return $user->can('manage-lines'); }
    public function view(User $user, ProductionLine $productionLine): bool { return $user->can('manage-lines'); }
    public function create(User $user): bool { return $user->can('manage-lines'); }
    public function update(User $user, ProductionLine $productionLine): bool { return $user->can('manage-lines'); }
    public function delete(User $user, ProductionLine $productionLine): bool { return $user->can('manage-lines'); }
}
