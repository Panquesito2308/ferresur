<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse; // Agrega esta línea

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): RedirectResponse
    {
        $this->ensureIsNotRateLimited();

        // Primero intenta autenticar como cliente
        if (Auth::guard('cliente')->attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::clear($this->throttleKey());
            return redirect()->intended('/cliente/dashboard');
        }

        // Si la autenticación como cliente falla, intenta como admin o empleado
        if (Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::clear($this->throttleKey());
            $user = Auth::user();
            switch ($user->role) {
                case 'administrador':
                    return redirect()->intended('/administrador/dashboard');
                case 'empleado':
                    return redirect()->intended('/empleado/dashboard');
                default:
                    throw new \Exception('Rol de usuario no válido.');
            }
        }

        // Si la autenticación falla
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.failed'),
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            event(new Lockout($this));

            $seconds = RateLimiter::availableIn($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('username')) . '|' . $this->ip());
    }
}
