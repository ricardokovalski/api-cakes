<?php

namespace App\Services\CakeService;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Collection;

interface CakeServiceContract
{
    public function getCakes(): Collection;

    public function storeCake(array $attributes): Cake;

    public function getCake(int $id): Cake;

    public function updateCake(array $attributes, int $id): Cake;

    public function deleteCake(int $id): bool;
}