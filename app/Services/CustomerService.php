<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerService
{
    public function create(array $data): Customer
    {
        $customer = new Customer();
        $customer->fill($data);
        $customer->save();

        return $customer;
    }

    public function findAll(array $filters): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $country = $filters['country'] ?? null;
        $perPage = $filters['per_page'] ?? 10;

        $customers = Customer::query()
                        ->with('country')
                        ->when($search, function ($query) use ($search) {
                            return $query->where('name', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->when($country, function ($query) use ($country) {
                            return $query->where('country_id', $country);
                        })
                        ->orderBy('name')
                        ->paginate($perPage);

        return $customers;
    }
}