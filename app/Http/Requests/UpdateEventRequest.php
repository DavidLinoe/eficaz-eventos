<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location'    => ['required', 'string', 'max:255'],
            'starts_at'   => ['required', 'date'],
            'capacity'    => ['nullable', 'integer', 'min:1'],
            'status'      => ['required', 'in:active,cancelled'],
        ];
    }
}
