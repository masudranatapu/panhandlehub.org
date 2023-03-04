<?php

namespace Modules\Ad\Entities;

use App\Models\User;
use App\Models\AdType;
use App\Models\Country;
use Modules\Brand\Entities\Brand;
use Modules\Ad\Entities\AdFeature;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Category\Entities\SubCategory;
use Modules\Ad\Database\factories\AdFactory;
use Modules\CustomField\Entities\CustomField;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\CustomField\Entities\ProductCustomField;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];
    protected $casts = ['wishlisted' => 'boolean', 'show_phone' => 'boolean', 'services' => 'array', 'availability' => 'array'];


    protected static function newFactory()
    {
        return AdFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->thumbnail)) {
            return asset('backend/image/default-ad.png');
        }

        return asset($this->thumbnail);
    }

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query, $api = false)
    {
        if ($api) {
            return $query->where('user_id', auth('api')->id());
        } else {
            return $query->where('user_id', auth('user')->id());
        }
    }

    /**
     *  Active ad scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('status', 1);
        });
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActiveSubcategory($query)
    {
        return $query->whereHas('subcategory', function ($q) {
            $q->where('status', 1);
        });
    }

    /**
     *  Inactive Category scope
     * @return mixed
     */
    public function scopeInactiveCategory($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('status', 0);
        });
    }


    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    /**
     *  BelongTo
     * @return BelongsTo|Collection|Country[]
     */
    function countries(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'iso');
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * ad_type
     *
     * @return void
     */
    public function ad_type(): BelongsTo
    {
        return $this->belongsTo(AdType::class, 'ad_type_id');
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  Has Many
     * @return HasMany|Collection|AdGallery[]
     */
    function galleries(): HasMany
    {
        return $this->hasMany(AdGallery::class);
    }




    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'ad_id');
    }

    public function adFeatures()
    {
        return $this->hasMany(AdFeature::class, 'ad_id');
    }

    public function productCustomFields()
    {
        return $this->hasMany(ProductCustomField::class, 'ad_id')->oldest('order')->with('customField.values', 'customField.customFieldGroup');
    }
}
