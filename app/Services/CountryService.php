<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Collection;

class CountryService
{
    public function findAll(): Collection
    {
        $countries = Customer::query()
                        ->select('country')
                        ->distinct()
                        ->orderBy('country')
                        ->get()
                        ->pluck('country');

        return $countries;
    }
}