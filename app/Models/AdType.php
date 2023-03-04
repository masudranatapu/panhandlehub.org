<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdType extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
