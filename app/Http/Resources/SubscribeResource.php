<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'subscribe' => $this->cakes()
                ->where('customer_id', $this->id)
                ->first()
                ->pivot
                ->created_at
                ->toDateTimeString()
        ];
    }
}
