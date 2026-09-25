<?php
// app/Services/EmployeeService.php
namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function generateEmployeeId(): string
    {
        $last = Employee::withTrashed()->orderByDesc('id')->first();
        $next = $last ? ((int) substr($last->employee_id, 4)) + 1 : 1;
        return 'EMP-' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }

    public function create(array $data, ?UploadedFile $photo = null): Employee
    {
        return DB::transaction(function () use ($data, $photo) {
            $data['employee_id'] = $this->generateEmployeeId();
            $data['gross_salary'] = $this->calculateGross($data);

            $employee = Employee::create($data);

            if ($photo) {
                $employee->addMedia($photo)->toMediaCollection('photo');
            }

            return $employee;
        });
    }

    public function update(Employee $employee, array $data, ?UploadedFile $photo = null): Employee
    {
        DB::transaction(function () use ($employee, $data, $photo) {
            $data['gross_salary'] = $this->calculateGross($data);
            $employee->update($data);

            if ($photo) {
                $employee->addMedia($photo)->toMediaCollection('photo');
            }
        });

        return $employee->fresh();
    }

    public function delete(Employee $employee): bool
    {
        return DB::transaction(fn () => $employee->delete());
    }

    private function calculateGross(array $data): float
    {
        return (float) ($data['basic_salary'] ?? 0)
            + (float) ($data['house_rent'] ?? 0)
            + (float) ($data['medical_allowance'] ?? 0)
            + (float) ($data['conveyance_allowance'] ?? 0)
            + (float) ($data['food_allowance'] ?? 0);
    }
}