<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CakeResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "weight" => $this->weight,
            "value" => $this->value,
            "quantity" => $this->quantity,
            "created_at" => $this->created_at->format("Y-m-d H:i:s"),
            "interested" => SubscribeResource::collection($this->interested)
        ];
    }
}
