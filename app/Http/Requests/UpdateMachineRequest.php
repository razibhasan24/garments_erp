<?php
// app/Http/Requests/UpdateMachineRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('machine'));
    }

    public function rules(): array
    {
        return [
            'floor_id' => ['required', 'exists:floors,id'],
            'production_line_id' => ['nullable', 'exists:production_lines,id'],
            'name' => ['required', 'string', 'max:255'],
            'asset_code' => ['required', 'string', 'max:50', Rule::unique('machines', 'asset_code')->ignore($this->route('machine')->id)],
            'brand' => ['nullable', 'string', 'max:100'],
            'model_no' => ['nullable', 'string', 'max:100'],
            'purchase_date' => ['nullable', 'date'],
            'purchase_price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:Running,Idle,Under Maintenance,Scrapped'],
        ];
    }
}
