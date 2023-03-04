<?php

namespace Modules\Testimonial\Actions;

use App\Actions\File\FileUpload;

class UpdateTestimonial
{
    public static function update($request, $testimonial)
    {
        $image = $request->image;
        if($image != null){
            deleteImage($image);
            $url = uploadImage($image, 'testimonial');
        }

        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'image' => $url ?? null,
            'stars' => $request->stars,
            'code' => $request->code,
        ]);

        return $testimonial;
    }
}
