<?php
// app/Models/Factory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factory extends Model
{
    protected $fillable = ['name', 'code', 'address', 'phone', 'email', 'bin_number', 'trade_license_no', 'is_active'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
