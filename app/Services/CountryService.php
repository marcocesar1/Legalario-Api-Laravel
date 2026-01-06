<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Collection;

class CountryService
{
    public function findAll(): Collection
    {
        $countries = Country::query()
                            ->orderBy('name')
                            ->get();

        return $countries;
    }
}