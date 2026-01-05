<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Collection;

class CustomerService
{
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function findAll(array $filters): Collection
    {
        $search = $filters['search'] ?? null;
        $country = $filters['country'] ?? null;

        $customers = Customer::query()
                        ->when($search, function ($query) use ($search) {
                            return $query->where('name', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->when($country, fn ($query) => $query->where('country', $country))
                        ->get();

        return $customers;
    }
}