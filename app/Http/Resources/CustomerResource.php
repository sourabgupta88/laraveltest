<?php

namespace App\Http\Resources;

use App\Helpers\NfStringHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'customerId' => $this->customer_id,
            'dob' => $this->dob,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            "address" => $this->address,
            "current_unit_number" => $this->current_unit_number,
            "current_street_number" => $this->current_street_number,
            "current_street_name" => $this->current_street_name,
            "current_street_type" => $this->current_street_type,
            "current_suburb" => $this->current_suburb,
            "current_state" => $this->current_state,
            "current_postcode" => $this->current_postcode,
            "gender" => $this->gender,
        ];
    }

}
