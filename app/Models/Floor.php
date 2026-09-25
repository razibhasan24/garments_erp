<?php
// app/Models/Floor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Floor extends Model
{
    use LogsActivity;

    protected $fillable = ['factory_id', 'name', 'code', 'total_area_sqft', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function factory() { return $this->belongsTo(Factory::class); }
    public function productionLines() { return $this->hasMany(ProductionLine::class); }
    public function machines() { return $this->hasMany(Machine::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('floor');
    }
}
