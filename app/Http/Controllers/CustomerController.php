<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $service)
    {}
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->service->findAll($request->all());

            return new ApiSuccessResponse($data);
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                'Error al obtener los clientes',
                $th
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        try {
            $data = $this->service->create($request->all());

            return new ApiSuccessResponse($data);
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                'Error al crear el cliente',
                $th
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
