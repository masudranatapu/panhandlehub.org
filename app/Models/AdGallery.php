<?php

namespace App\Models;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdGallery extends Model
{
    use HasFactory;

    public function addSliderImage(){
        return $this->hasMany(Ad::class, 'ad_id');
    }
}
