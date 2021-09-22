<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Attached
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $parent;
    protected $related;

    public function __construct(Model $parent, array $related)
    {
        $this->parent    = $parent;
        $this->related   = $related;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getRelated()
    {
        return $this->related;
    }
}
