<?php

namespace App\Services\CustomerService;

use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerService implements CustomerServiceContract
{
    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param array $attributes
     * @return Customer
     */
    public function storeCustomer(array $attributes): Customer
    {
        return $this->customer::create($attributes);
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if ($customer = $this->customer::find($id)) {
            return $customer;
        }

        throw new ModelNotFoundException("Customer not found.", 404);
    }

    public function findCustomerByEmail($email)
    {
        return $this->customer::where("email", "like", "%$email%")->first();
    }
}