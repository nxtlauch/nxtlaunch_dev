<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public $successStatus = 200;
    public $failureStatus = 100;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if (!empty($request)) {
            return [
                'meta' => ['status' => $this->successStatus],
                'response' => [
                    'posts' => [
                        "id" => $this->id,
                        "user_id" => $this->user_id,
                        "post_details" => $this->post_details,
                        "category_id" => $this->category_id,
                        "expire_date" => $this->expire_date,
                        "image" => $this->image,
                        "status" => $this->status,
                        "created_at" => $this->created_at,
                        "updated_at" => $this->updated_at,
                        /*"user" => [
                            "id" => $this->user->id,
                            "name" => $this->user->name,
                            "phone" => $this->user->phone
                        ]*/
                    ]
                ]
            ];
        } else {
            return [
                'meta' => ['status' => $this->failureStatus],
            ];
        }

    }
}
