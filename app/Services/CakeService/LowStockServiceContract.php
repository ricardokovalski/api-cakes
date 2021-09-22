<?php

namespace App\Services\CakeService;

use App\Models\Cake;

interface LowStockServiceContract
{
    public function lowStock(int $id): Cake;
}