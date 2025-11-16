<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AvatarResolver
{
    /**
     * Resolve the first accessible avatar URL from the given candidates.
     */
    public static function resolve(iterable $candidates): ?string
    {
        $disk = Storage::disk('public');

        foreach ($candidates as $candidate) {
            $normalized = self::normalize($candidate);

            if (! $normalized) {
                continue;
            }

            if ($disk->exists($normalized)) {
                return $disk->url($normalized);
            }
        }

        foreach ($candidates as $candidate) {
            if (! $candidate) {
                continue;
            }

            if (filter_var($candidate, FILTER_VALIDATE_URL)) {
                return $candidate;
            }

            if (Str::startsWith($candidate, 'storage/')) {
                return asset($candidate);
            }
        }

        return null;
    }

    private static function normalize(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $trimmed = ltrim($path);

        if ($trimmed === '') {
            return null;
        }

        return preg_replace('#^(?:storage/|public/)+#', '', $trimmed) ?: $trimmed;
    }
}
