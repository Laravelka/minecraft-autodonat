<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'vk_id' => $this->vk_id,
            'name' => $this->name,
            'discord_id' => $this->discord_id,
            'telegram_id' => $this->telegram_id,
            'created_at' => $this->created_at->toDayDateTimeString(),
            'updated_at' => $this->updated_at?->toDayDateTimeString(),
        ];
    }
}
