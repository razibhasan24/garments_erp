<?php
// app/Http/Requests/UpdateEmployeeRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('employee'));
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee')->id;

        return [
            'factory_id' => ['required', 'exists:factories,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'designation_id' => ['required', 'exists:designations,id'],
            'floor_id' => ['nullable', 'exists:floors,id'],
            'production_line_id' => ['nullable', 'exists:production_lines,id'],

            'name' => ['required', 'string', 'max:255'],
            'name_bangla' => ['nullable', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'nid_no' => ['nullable', 'string', 'max:30', Rule::unique('employees', 'nid_no')->ignore($employeeId)],
            'birth_certificate_no' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'religion' => ['nullable', 'string', 'max:50'],
            'marital_status' => ['nullable', 'in:Single,Married,Widowed,Divorced'],

            'present_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],

            'joining_date' => ['required', 'date'],
            'employee_type' => ['required', 'in:Worker,Staff,Casual'],
            'salary_type' => ['required', 'in:Monthly,Daily,Piece Rate'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'house_rent' => ['nullable', 'numeric', 'min:0'],
            'medical_allowance' => ['nullable', 'numeric', 'min:0'],
            'conveyance_allowance' => ['nullable', 'numeric', 'min:0'],
            'food_allowance' => ['nullable', 'numeric', 'min:0'],

            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_no' => ['nullable', 'string', 'max:50'],
            'mobile_banking_type' => ['nullable', 'in:bKash,Nagad,Rocket,Upay'],
            'mobile_banking_no' => ['nullable', 'string', 'max:20'],

            'photo' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:Active,Resigned,Terminated,Layoff'],
            'resign_date' => ['nullable', 'date', 'required_if:status,Resigned,Terminated,Layoff'],
            'resign_reason' => ['nullable', 'string'],
        ];
    }
}
