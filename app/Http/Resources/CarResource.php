<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'brand' => new BrandResource($this->brand),
            'type' => new TypeResource($this->type),
            'price' => $this->price,
            'color' => $this->color,
            'description' => $this->description,
            'engine' => $this->engine,
            'time_to_100' => $this->time_to_100,
            'max_speed' => $this->max_speed,
            'max_power' => $this->max_power,
            'power_per_liter' => $this->power_per_liter,
            'main_image' => new CarImageResource($this->mainImage),
            'images' => CarImageResource::collection($this->images->where('is_main', false)),
            'author' => new UserResource($this->user),
        ];
    }
}
