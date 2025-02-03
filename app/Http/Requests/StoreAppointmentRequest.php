<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set this to true if authorization is not required
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'date' => 'required|date|after_or_equal:today',
            'doctor' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not exceed 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email may not exceed 255 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.max' => 'The phone number must be less than 15 digits.',
            'date.required' => 'The appointment date is required.',
            'date.date' => 'Please provide a valid date.',
            'date.after_or_equal' => 'The appointment date must be today or a future date.',
            'doctor.required' => 'The doctor field is required.',
            'doctor.string' => 'The doctor field must be a valid string.',
            'doctor.max' => 'The doctor field may not exceed 255 characters.',
            'message.string' => 'The message must be a valid string.',
            'message.max' => 'The message may not exceed 1000 characters.',
            'user_id.required' => 'The user ID is required.',
            'user_id.integer' => 'The user ID must be a valid integer.',
            'user_id.exists' => 'The user ID must exist in the users table.',
        ];
    }
}
