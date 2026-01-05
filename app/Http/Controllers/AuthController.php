<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $this->service->login($request->validated());

            return new ApiSuccessResponse($data);
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                'Error al iniciar sesión',
                $th
            );
        }
    }
}
