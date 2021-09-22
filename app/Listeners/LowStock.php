<?php

namespace App\Listeners;

use App\Events\CakeUpdated;
use App\Services\CakeService\LowStockServiceContract;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LowStock implements ShouldQueue
{
    use InteractsWithQueue;

    protected $lowStockService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LowStockServiceContract $lowStockService)
    {
        $this->lowStockService = $lowStockService;
    }

    /**
     * Handle the event.
     *
     * @param CakeUpdated $event
     * @return void
     */
    public function handle(CakeUpdated $event)
    {
        try {
            $this->lowStockService->lowStock($event->cakeId);
        } catch (Exception $exception) {
            Log::warning('listener.LowStock.handle', [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

    }
}
