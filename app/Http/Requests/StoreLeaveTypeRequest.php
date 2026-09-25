<?php
// app/Http/Requests/StoreLeaveTypeRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveTypeRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->can('manage-leave-types'); }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:20', 'unique:leave_types,code'],
            'days_per_year' => ['required', 'integer', 'min:0'],
            'is_paid' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
