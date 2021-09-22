<?php

namespace App\Services\SubscribeService;

use App\Models\Customer;

interface SubscribeServiceContract
{
    public function subscribe(array $information, int $id): Customer;
}