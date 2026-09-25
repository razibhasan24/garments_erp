<?php
// app/Models/Designation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Designation extends Model
{
    use LogsActivity;

    protected $fillable = ['department_id', 'name', 'code', 'grade_level', 'default_basic_salary', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'default_basic_salary' => 'decimal:2'];

    public function department() { return $this->belongsTo(Department::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('designation');
    }
}
