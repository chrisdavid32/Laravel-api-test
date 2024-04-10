<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "company_name" =>  $this->company_name,
            "business_type" =>  $this->business_type,
            "business_decription" =>  $this->business_decription,
            "address" => $this->address,
            "contact_information" => $this->contact_information,
            "company_logo" => $this->company_logo ? config('app.url')."/images/".$this->company_logo : "N/A",
            "created_by" => $this->forMatUserDate($this->user->name)
        ];
    }

    private function forMatUserDate($userName)
    {
        return[
            "name" => $userName
        ];
    }
}
