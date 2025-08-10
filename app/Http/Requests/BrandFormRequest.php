<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'uuid'      => ['required'],
            'name'      => ['required'],
            'image'     => ['nullable'], // image is optional now
            'is_active' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uuid'      => Str::uuid(),
            'is_active' => $this->is_active == true ? 1 : 0,
        ]);
    }
}