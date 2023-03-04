<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'translation_code');
    }
}
