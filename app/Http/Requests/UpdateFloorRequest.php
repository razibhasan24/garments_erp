<?php
// app/Http/Requests/UpdateFloorRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFloorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('floor'));
    }

    public function rules(): array
    {
        return [
            'factory_id' => ['required', 'exists:factories,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('floors', 'code')->ignore($this->route('floor')->id)],
            'total_area_sqft' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
