<?php

namespace App\Services\CakeService;

use App\Models\Cake;

class LowStockService extends CakeService implements LowStockServiceContract
{
    /**
     * @param int $id
     * @return Cake
     * @throws \Exception
     */
    public function lowStock(int $id): Cake
    {
        $cake = $this->getCake($id);

        if ($cake->quantity <= 0) {
            throw new \Exception("Cake {$cake->id} - Quantidade baixa ou zerada.", 400);
        }

        $cake->update([
            'quantity' => $cake->quantity -= 1
        ]);

        return $cake->fresh();
    }
}