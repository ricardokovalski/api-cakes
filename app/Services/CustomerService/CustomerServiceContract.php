<?php

namespace App\Services\CustomerService;

use App\Models\Customer;

interface CustomerServiceContract
{
    public function storeCustomer(array $attributes): Customer;

    public function getCustomer(int $id): Customer;
}