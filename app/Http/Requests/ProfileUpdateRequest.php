<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'max:191', Rule::unique(User::class)->ignore($this->user()->id)],
            'avatar' => 'image|max:1024',
            'password' => 'nullable|max:191|min:8',
            'password_confirmation' => 'nullable|same:password'
        ];
    }
}
