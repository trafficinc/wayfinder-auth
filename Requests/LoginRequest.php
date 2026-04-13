<?php

declare(strict_types=1);

namespace Modules\Auth\Requests;

use Wayfinder\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }
}
