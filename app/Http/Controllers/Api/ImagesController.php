<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ImageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImagesController extends Controller
{
    /**
     * 上传图片
     * @param ImageRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(ImageRequest $request)
    {
        $user = $this->user();
        $image = $request->file('image');

        if (!$request->hasFile('image') || !$image->isValid()) {
            return $this->response->errorBadRequest('未知图像资源');
        }
        $path = $request->file('image')->store($request->type);

        $realPath = storage_path('app/public') . '/' . $path;
        $img = \Intervention\Image\Facades\Image::make($realPath);
        $img->widen(floor($img->width() / 2), function ($constraint) {
            $constraint->upsize();
        })
            ->save($realPath);

        $image = new Image();
        $image->path = $path;
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer());
    }
}
