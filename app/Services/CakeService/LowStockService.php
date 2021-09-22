<?php

namespace App\Services\CakeService;

use App\Jobs\SendEmailInterested;
use App\Models\Cake;
use App\Models\Customer;

class LowStockService extends CakeService implements LowStockServiceContract
{
    /**
     * @param int $id
     * @param Customer $interested
     * @return Cake
     * @throws \Exception
     */
    public function lowStock(int $id, Customer $interested): Cake
    {
        $cake = $this->getCake($id);

        if ($cake->quantity <= 0) {
            throw new \Exception("Cake {$cake->id} - Quantidade baixa ou zerada.", 400);
        }

        $cake->update([
            'quantity' => $cake->quantity -= 1
        ]);

        dispatch(new SendEmailInterested($cake, $interested));

        return $cake->fresh();
    }
}