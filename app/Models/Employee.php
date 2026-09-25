<?php
// app/Models/Employee.php
namespace App\Models;

use App\Models\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'employee_id', 'factory_id', 'department_id', 'designation_id', 'floor_id', 'production_line_id',
        'name', 'name_bangla', 'father_name', 'mother_name', 'nid_no', 'birth_certificate_no',
        'date_of_birth', 'gender', 'blood_group', 'religion', 'marital_status',
        'present_address', 'permanent_address', 'phone', 'emergency_contact_name', 'emergency_contact_phone',
        'joining_date', 'employee_type', 'salary_type',
        'basic_salary', 'house_rent', 'medical_allowance', 'conveyance_allowance', 'food_allowance', 'gross_salary',
        'bank_name', 'bank_account_no', 'mobile_banking_type', 'mobile_banking_no',
        'status', 'resign_date', 'resign_reason',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'resign_date' => 'date',
        'basic_salary' => 'decimal:2',
        'house_rent' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'conveyance_allowance' => 'decimal:2',
        'food_allowance' => 'decimal:2',
        'gross_salary' => 'decimal:2',
    ];

    public function factory() { return $this->belongsTo(Factory::class); }
    public function department() { return $this->belongsTo(Department::class); }
    public function designation() { return $this->belongsTo(Designation::class); }
    public function floor() { return $this->belongsTo(Floor::class); }
    public function productionLine() { return $this->belongsTo(ProductionLine::class); }
    public function attendances() { return $this->hasMany(Attendance::class); }
    public function leaveApplications() { return $this->hasMany(LeaveApplication::class); }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
        $this->addMediaCollection('nid_copy')->singleFile();
        $this->addMediaCollection('documents');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('photo') ?: null;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('employee');
    }
}
