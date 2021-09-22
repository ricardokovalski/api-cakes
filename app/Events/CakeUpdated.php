<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CakeUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cakeId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cakeId)
    {
        $this->cakeId = current($cakeId);
    }
}
