<?php

namespace App\Http\Resources;

use App\Models\Desk;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'name' => $this->name,
            'email'=>$this->email,
            'desk_list_id'=>$this->desk_list_id,
            'created_at' => $this->created_at,
            'desklist'=> DeskListResource::make($this->desklist),

           ];
    }

}
