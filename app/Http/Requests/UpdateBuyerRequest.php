<?php
// app/Http/Requests/UpdateBuyerRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBuyerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('buyer'));
    }

    public function rules(): array
    {
        $buyerId = $this->route('buyer')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('buyers', 'code')->ignore($buyerId)],
            'country' => ['nullable', 'string', 'max:100'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'buyer_type' => ['required', 'in:Direct,Buying House'],
            'payment_terms' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }
}
