<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToUpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_perusahaan' => $this->id_perusahaan,
            'id_user_card' => $this->id_user_card,
            'tgl_topup' => $this->tgl_topup,
            'jumlah' => $this->jumlah,
            'id_rekening' => $this->id_rekening,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
