<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // mutator
    public function setPageSlugAttribute($value)
    {
        $this->attributes['page_slug'] = Str::slug($value);
    }

    /**
     * One to Many relationship with page content model to get page contents
     *
     */
    public function contents()
    {
        return $this->hasOne(SeoPageContent::class, 'page_id', 'id');
    }
}
