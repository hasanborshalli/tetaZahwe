<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:100'],
            'phone'      => ['required', 'string', 'max:30'],
            'email'      => ['nullable', 'email', 'max:150'],
            'event_type' => ['nullable', 'string', 'max:100'],
            'event_date' => ['nullable', 'date'],
            'message'    => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'phone.required'   => 'Please enter your phone number.',
            'message.required' => 'Please write your message.',
            'message.min'      => 'Message must be at least 10 characters.',
        ];
    }
}
