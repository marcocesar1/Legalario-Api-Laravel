<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Http\Requests\Customer\CreateCustomerRequest;

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

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        try {
            $data = $this->service->create($request->all());

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
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
