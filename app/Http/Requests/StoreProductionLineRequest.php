<?php
// app/Http/Requests/StoreProductionLineRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionLineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\ProductionLine::class);
    }

    public function rules(): array
    {
        return [
            'floor_id' => ['required', 'exists:floors,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:production_lines,code'],
            'machine_capacity' => ['nullable', 'integer', 'min:0'],
            'manpower_capacity' => ['nullable', 'integer', 'min:0'],
            'line_type' => ['required', 'in:Sewing,Cutting,Finishing,Packing'],
            'is_active' => ['boolean'],
        ];
    }
}
