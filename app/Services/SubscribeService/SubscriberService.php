<?php

namespace App\Services\SubscribeService;

use App\Models\Customer;
use App\Services\CakeService\CakeServiceContract;
use App\Services\CustomerService\CustomerServiceContract;
use Exception;

class SubscriberService implements SubscribeServiceContract
{
    /**
     * @var CakeServiceContract
     */
    protected $cakeService;

    /**
     * @var CustomerServiceContract
     */
    protected $customerService;

    /**
     * @param CakeServiceContract $cakeService
     * @param CustomerServiceContract $customerService
     */
    public function __construct(
        CakeServiceContract $cakeService,
        CustomerServiceContract $customerService
    )
    {
        $this->cakeService = $cakeService;
        $this->customerService = $customerService;
    }

    /**
     * @param array $information
     * @param int $id
     * @return Customer
     * @throws Exception
     */
    public function subscribe(array $information, int $id): Customer
    {
        $cake = $this->cakeService->getCake($id);

        if ($cake->quantity <= 0) {
            throw new Exception("Cake ou of stock", 400);
        }

        if (! $customer = $this->customerService->findCustomerByEmail($information['email'])) {
            $customer = $this->customerService->storeCustomer($information);
        }

        if ($customer->cakes()->where('cake_id', $cake->id)->first()) {
            throw new Exception("Prezado {$customer->name}, você já efetuou sua inscrição para lista de interessados para o bolo {$cake->name}.", 400);
        }

        $customer->syncCakes($cake, false);

        return $customer->fresh('cakes');
    }
}