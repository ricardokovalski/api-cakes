<?php

namespace App\Services\CakeService;

use App\Models\Cake;
use App\Models\Customer;

interface LowStockServiceContract
{
    public function lowStock(int $id, Customer $interested): Cake;
}