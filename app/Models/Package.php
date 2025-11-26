<?php

namespace App\Models;

use App\Support\ImageRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'level',
        'grade_range',
        'tag',
        'card_price_label',
        'detail_title',
        'detail_price_label',
        'image_url',
        'price',
        'max_students',
        'available_class',
        'summary',
        'tutor_id',
        'zoom_link',
        'program_points',
        'facility_points',
        'schedule_info',
    ];

    protected $casts = [
        'price' => 'float',
        'max_students' => 'integer',
        'available_class' => 'integer',
        'program_points' => 'array',
        'facility_points' => 'array',
        'schedule_info' => 'array',
    ];

    public function getImageAssetAttribute(): string
    {
        $key = $this->attributes['image_url'] ?? '';

        return ImageRepository::url("packages.$key");
    }

    public function features(): HasMany
    {
        return $this->hasMany(PackageFeature::class);
    }

    /**
     * Relasi Tunggal ke Tutor (Legacy/Utama)
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    /**
     * Relasi Banyak ke Tutor (Multiple Tutors per Package)
     * Memperbaiki error RelationNotFoundException [tutors]
     */
    public function tutors(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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

    public function checkoutSessions(): HasMany
    {
        return $this->hasMany(CheckoutSession::class);
    }

    public function scheduleTemplates(): HasMany
    {
        return $this->hasMany(ScheduleTemplate::class);
    }

    public function scheduleSessions(): HasMany
    {
        return $this->hasMany(ScheduleSession::class);
    }

    public function scopeWithQuotaUsage($query)
    {
        return $query
            ->withCount([
                'enrollments as active_enrollment_count' => function ($enrollments) {
                    $enrollments
                        ->where('is_active', true)
                        ->where(function ($query) {
                            $query
                                ->whereNull('ends_at')
                                ->orWhere('ends_at', '>=', now());
                        });
                },
                'checkoutSessions as pending_checkout_count' => function ($sessions) {
                    $sessions
                        ->whereIn('status', ['checkout_in_progress', 'awaiting_payment', 'awaiting_verification'])
                        ->where(function ($query) {
                            $query
                                ->whereNull('order_id')
                                ->orWhereHas('order', function ($orders) {
                                    $orders
                                        ->whereIn('status', ['initiated', 'pending'])
                                        ->where(function ($orderQuery) {
                                            $orderQuery
                                                ->whereNull('expires_at')
                                                ->orWhere('expires_at', '>', now());
                                        });
                                });
                        });
                },
            ]);
    }

    public function quotaSnapshot(bool $lock = false): array
    {
        // Calculate total limit based on quota per class * available classes
        $perClassLimit = $this->max_students !== null ? (int) $this->max_students : null;
        $classes = $this->available_class ? (int) $this->available_class : 1;

        $limit = $perClassLimit !== null ? $perClassLimit * $classes : null;

        $activeEnrollments = $this->resolvedActiveEnrollmentCount($lock);
        $checkoutHolds = $this->resolvedPendingCheckoutCount($lock);
        $used = $activeEnrollments + $checkoutHolds;
        $remaining = $limit !== null ? max(0, $limit - $used) : null;

        return [
            'limit' => $limit,
            'per_class_limit' => $perClassLimit,
            'available_classes' => $classes,
            'active_enrollments' => $activeEnrollments,
            'checkout_holds' => $checkoutHolds,
            'used' => $used,
            'remaining' => $remaining,
            'is_full' => $limit !== null && $remaining <= 0,
        ];
    }

    public function hasQuota(): bool
    {
        return $this->max_students !== null;
    }

    private function resolvedActiveEnrollmentCount(bool $lock = false): int
    {
        $query = $this->enrollments()
            ->where('is_active', true)
            ->where(function ($subQuery) {
                $subQuery
                    ->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });

        if ($lock) {
            $query->lockForUpdate();
        }

        if (!$lock && property_exists($this, 'active_enrollment_count')) {
            return (int) $this->active_enrollment_count;
        }

        return (int) $query->count();
    }

    private function resolvedPendingCheckoutCount(bool $lock = false): int
    {
        $query = $this->checkoutSessions()
            ->whereIn('status', ['checkout_in_progress', 'awaiting_payment', 'awaiting_verification'])
            ->where(function ($sessionQuery) {
                $sessionQuery
                    ->whereNull('order_id')
                    ->orWhereHas('order', function ($orders) {
                        $orders
                            ->whereIn('status', ['initiated', 'pending'])
                            ->where(function ($orderQuery) {
                                $orderQuery
                                    ->whereNull('expires_at')
                                    ->orWhere('expires_at', '>', now());
                            });
                    });
            });

        if ($lock) {
            $query->lockForUpdate();
        }

        if (!$lock && property_exists($this, 'pending_checkout_count')) {
            return (int) $this->pending_checkout_count;
        }

        return (int) $query->count();
    }
}