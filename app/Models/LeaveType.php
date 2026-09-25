<?php
// app/Models/LeaveType.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = ['name', 'code', 'days_per_year', 'is_paid', 'is_active'];
    protected $casts = ['is_paid' => 'boolean', 'is_active' => 'boolean'];

    public function leaveApplications() { return $this->hasMany(LeaveApplication::class); }
}
