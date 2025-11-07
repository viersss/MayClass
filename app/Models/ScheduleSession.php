<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'title',
        'category',
        'mentor_name',
        'start_at',
        'is_highlight',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'is_highlight' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
