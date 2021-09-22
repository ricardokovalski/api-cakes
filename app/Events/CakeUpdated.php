<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CakeUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cakeId;

    public $interested;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cakeId, Customer $interested)
    {
        $this->cakeId = current($cakeId);
        $this->interested = $interested;
    }
}
