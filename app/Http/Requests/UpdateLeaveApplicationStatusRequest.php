<?php
// app/Http/Requests/UpdateLeaveApplicationStatusRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveApplicationStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('approve', $this->route('leave_application'));
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:Approved,Rejected'],
            'rejection_reason' => ['nullable', 'required_if:status,Rejected', 'string', 'max:500'],
        ];
    }
}
