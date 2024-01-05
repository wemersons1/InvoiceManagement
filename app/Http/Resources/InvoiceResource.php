<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'value' => $this->value,
            'date_of_issue' => $this->date_of_issue,
            'sender_cnpj' => $this->sender_cnpj,
            'sender_name' => $this->sender_name,
            'transporter_cnpj' => $this->transporter_cnpj,
            'transporter_name' => $this->transporter_name,
            'created_by'  => $this->created_by_user->name,
        ];
    }
}
