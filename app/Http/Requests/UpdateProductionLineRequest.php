<?php
// app/Http/Requests/UpdateProductionLineRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductionLineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('production_line'));
    }

    public function rules(): array
    {
        return [
            'floor_id' => ['required', 'exists:floors,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('production_lines', 'code')->ignore($this->route('production_line')->id)],
            'machine_capacity' => ['nullable', 'integer', 'min:0'],
            'manpower_capacity' => ['nullable', 'integer', 'min:0'],
            'line_type' => ['required', 'in:Sewing,Cutting,Finishing,Packing'],
            'is_active' => ['boolean'],
        ];
    }
}
