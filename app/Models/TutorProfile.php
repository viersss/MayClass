<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'headline',
        'bio',
        'specializations',
        'experience_years',
        'students_taught',
        'hours_taught',
        'rating',
        'certifications',
        'avatar_path',
    ];

    protected $casts = [
        'certifications' => 'array',
        'rating' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
