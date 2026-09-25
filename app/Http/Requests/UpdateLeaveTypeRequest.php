<?php
// app/Http/Requests/UpdateLeaveTypeRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeaveTypeRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->can('manage-leave-types'); }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:20', Rule::unique('leave_types', 'code')->ignore($this->route('leave_type')->id)],
            'days_per_year' => ['required', 'integer', 'min:0'],
            'is_paid' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
