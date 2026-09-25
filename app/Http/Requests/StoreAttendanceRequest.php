<?php
// app/Http/Requests/StoreAttendanceRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Attendance::class);
    }

    public function rules(): array
    {
        return [
            'attendance_date' => ['required', 'date'],
            'entries' => ['required', 'array', 'min:1'],
            'entries.*.employee_id' => ['required', 'exists:employees,id'],
            'entries.*.status' => ['required', 'in:Present,Absent,Leave,Holiday,Weekend,Late'],
            'entries.*.in_time' => ['nullable', 'date_format:H:i'],
            'entries.*.out_time' => ['nullable', 'date_format:H:i', 'after:entries.*.in_time'],
            'entries.*.overtime_hours' => ['nullable', 'numeric', 'min:0', 'max:12'],
            'entries.*.remarks' => ['nullable', 'string', 'max:255'],
        ];
    }
}
