<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array
    {
        if(!Auth::attempt($credentials)) {
            throw new \Exception('Las credenciales no son correctas');
        }

        $user = Auth::user();

        return [
            'user' => $user,
            'token' => $this->generateToken($user),
        ];
    }

    public function generateToken(User $user): string
    {
        return $user->createToken('auth')->plainTextToken;
    }
}