<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'attributes' => [
                'id'         => $this->id,
                'amount'     => $this->amount,
                'type'       => $this->type,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'type'       => 'transactions',
        ];
    }
}
