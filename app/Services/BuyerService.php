<?php
// app/Services/BuyerService.php
namespace App\Services;

use App\Models\Buyer;
use Illuminate\Support\Facades\DB;

class BuyerService
{
    public function create(array $data): Buyer
    {
        return DB::transaction(fn () => Buyer::create($data));
    }

    public function update(Buyer $buyer, array $data): Buyer
    {
        DB::transaction(fn () => $buyer->update($data));
        return $buyer->fresh();
    }

    public function delete(Buyer $buyer): bool
    {
        return DB::transaction(fn () => $buyer->delete());
    }
}