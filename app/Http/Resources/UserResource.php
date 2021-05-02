<?php

namespace App\Http\Resources;

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
        return [
            'userid' => $this->userid,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => (!empty($this->created_at)) ? $this->created_at : null,
            'updated_at' => (!empty($this->updated_at)) ? $this->updated_at : null,
        ];
    }
}
