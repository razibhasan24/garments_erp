<?php
// app/Models/ProductionLine.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProductionLine extends Model
{
    use LogsActivity;

    protected $fillable = [
        'floor_id', 'name', 'code', 'machine_capacity',
        'manpower_capacity', 'line_type', 'is_active',
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function floor() { return $this->belongsTo(Floor::class); }
    public function machines() { return $this->hasMany(Machine::class, 'production_line_id'); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('production_line');
    }
}
