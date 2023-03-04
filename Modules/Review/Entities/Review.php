<?php

namespace Modules\Review\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'stars',
        'comment',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Review\Database\factories\ReviewFactory::new();
    }

    /**
     * Get the user for the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user for the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerUser()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
