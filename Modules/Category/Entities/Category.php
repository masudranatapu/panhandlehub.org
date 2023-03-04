<?php

namespace Modules\Category\Entities;

use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Blog\Entities\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CustomField\Entities\CustomField;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_url'];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-thumbnail.jpg');
        }

        return asset($this->image);
    }

    /**
     * Set the category name.
     * Set the category slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Ad[]
     */
    function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function customFields()
    {
        return $this->belongsToMany(CustomField::class, 'category_custom_field')->withPivot('order')->oldest('order');
    }
}
