<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // dd($request->user());
        //return parent::toArray($request);
        return ['id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'cast' => $this->cast,
                'director' => $this->director,
                'time' => $this->time,
                'genre_id' => $this->genre_id,
                'created_at' =>$this->created_at,
                'updated_at' =>$this->updated_at,
                'sad' =>$this->sad,
                'funny' =>$this->funny,
                'scare' =>$this->scare,
                'moved' =>$this->moved,

            ],
            'relationships' => [
                //'user' => new UserResource($this->user)
                'genre' => new GenreResource($this->genre),
            ],
            'links' => [
                'self' => ''
            ]

        ];
    }
}
