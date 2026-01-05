<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerService
{
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function findAll(array $filters): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $country = $filters['country'] ?? null;
        $perPage = $filters['per_page'] ?? 10;

        $customers = Customer::query()
                        ->when($search, function ($query) use ($search) {
                            return $query->where('name', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->when($country, fn ($query) => $query->where('country', $country))
                        ->paginate($perPage);

        return $customers;
    }
}