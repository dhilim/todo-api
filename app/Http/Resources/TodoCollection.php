<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'todos' => $this->collection,
            'total' => $this->collection->count(),
            'skip' => $request->get('skip', 0),
            'limit' => $request->get('limit', 10),
        ];
    }
}
