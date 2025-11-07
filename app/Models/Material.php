<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'subject',
        'title',
        'level',
        'summary',
        'thumbnail_url',
    ];

    public function objectives(): HasMany
    {
        return $this->hasMany(MaterialObjective::class)->orderBy('position');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(MaterialChapter::class)->orderBy('position');
    }
}
