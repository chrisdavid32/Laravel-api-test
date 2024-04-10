<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'employee_name' => $this->name,
            'gender' => $this->gender,
            'employee_number' => $this->employee_number,
            'phone' => $this->phone,
            'company_name' =>$this->company->company_name,
        ];
    }

    // private function getCompany($name)
    // {
    //     return[
    //         "name" => $name
    //     ];
    // }
}
