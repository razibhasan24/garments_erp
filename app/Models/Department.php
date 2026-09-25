<?php
// app/Models/Department.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Department extends Model
{
    use LogsActivity;

    protected $fillable = ['factory_id', 'name', 'code', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function factory() { return $this->belongsTo(Factory::class); }
    public function designations() { return $this->hasMany(Designation::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('department');
    }
}
