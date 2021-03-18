<?php

namespace Domain\User\Resources;

use Domain\User\DataTransferObjects\UserData;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return UserData::fromModel($this->resource)->toArray();
    }
}
