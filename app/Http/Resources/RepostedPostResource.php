<?php

namespace App\Http\Resources;

use App\Models\PostImage;
use Illuminate\Http\Resources\Json\JsonResource;

class RepostedPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = isset($this->image) ? $this->image->id : null;
        if ($image !== null) {
            $image_url = PostImage::where('post_id', $this->id)->first()->getUrlAttirbute();
        }else{
            $image_url = null;
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $image_url,
        ];
    }
}
