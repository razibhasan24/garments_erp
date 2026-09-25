<?php
// app/Models/Buyer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Buyer extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'name', 'code', 'country', 'contact_person', 'email',
        'phone', 'address', 'buyer_type', 'payment_terms', 'is_active',
    ];
    protected $casts = ['is_active' => 'boolean'];

    // orders() relationship will be added in Phase 4

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('buyer');
    }
}
