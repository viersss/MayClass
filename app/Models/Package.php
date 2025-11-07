<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'level',
        'tag',
        'card_price_label',
        'detail_title',
        'detail_price_label',
        'image_url',
        'price',
        'summary',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(PackageFeature::class);
    }

    public function cardFeatures(): HasMany
    {
        return $this->features()->where('type', 'card')->orderBy('position');
    }

    public function inclusions(): HasMany
    {
        return $this->features()->where('type', 'included')->orderBy('position');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
