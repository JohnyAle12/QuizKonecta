<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'reference' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'category' => ['required', 'numeric']
        ];
    }
}
