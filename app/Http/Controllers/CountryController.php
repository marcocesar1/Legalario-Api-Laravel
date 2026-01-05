<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use Illuminate\Http\Request;

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

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
