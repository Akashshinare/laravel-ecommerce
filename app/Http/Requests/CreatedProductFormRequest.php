<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreatedProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all users to make this request (adjust as needed)
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid'              => ['required', 'string', 'max:36'],
            'category_id'       => ['nullable', 'exists:categories,id'],
            'brand_id'          => ['nullable', 'exists:brands,id'],
            'name'              => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name'),
            ],
            'slug'              => ['nullable', 'string', 'max:255'],
            'small_description' => ['required', 'string'],
            'description'       => ['required', 'string'],
            'original_price'    => ['required', 'numeric', 'min:0'],
            'selling_price'     => ['required', 'numeric', 'min:0'],
            'image'             => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'quantity'          => ['required', 'integer', 'min:0'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string'],
            'meta_keyword'      => ['nullable', 'string'],
            'is_trending'       => ['nullable', 'boolean'],
            'is_active'         => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uuid' => $this->uuid ?? (string) Str::uuid(),
            'slug' => $this->slug ?: Str::slug($this->name),
            'is_trending' => $this->boolean('is_trending'),
            'is_active'   => $this->boolean('is_active'),
        ]);
    }
}