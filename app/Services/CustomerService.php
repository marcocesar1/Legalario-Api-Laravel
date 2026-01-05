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

    public function findAll(array $params): Collection
    {
        $customers = Customer::query()->get();

        return $customers;
    }
}