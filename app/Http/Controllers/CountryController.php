<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\CountryService;

class CountryController extends Controller
{
    public function __construct(private CountryService $service)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->service->findAll();

            return new ApiSuccessResponse($data);
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                'Error al obtener los países',
                $th
            );
        }
    }
}
