<?php
// app/Models/Attendance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id', 'attendance_date', 'in_time', 'out_time',
        'working_hours', 'overtime_hours', 'status', 'remarks', 'marked_by',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'working_hours' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
    ];

    public function employee() { return $this->belongsTo(Employee::class); }
    public function markedBy() { return $this->belongsTo(User::class, 'marked_by'); }
}
