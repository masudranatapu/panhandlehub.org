<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPageContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $img = $this->image;
        if ($img) {
            return asset($img);
        }
    }
}
