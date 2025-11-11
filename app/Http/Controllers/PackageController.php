<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['cardFeatures', 'inclusions'])->orderBy('price')->get()
            ->map(fn (Package $package) => $this->formatPackage($package));

        return view('packages.index', ['packages' => $packages]);
    }

    public function show(string $slug)
    {
        $package = Package::with(['cardFeatures', 'inclusions'])->where('slug', $slug)->firstOrFail();

        return view('packages.show', ['package' => $this->formatPackage($package)]);
    }

    private function formatPackage(Package $package): array
    {
        return [
            'id' => $package->id,
            'slug' => $package->slug,
            'level' => $package->level,
            'tag' => $package->tag,
            'card_price' => $package->card_price_label,
            'detail_title' => $package->detail_title,
            'detail_price' => $package->detail_price_label,
            'summary' => $package->summary,
            'image' => $package->image_asset,
            'card_features' => $package->cardFeatures->sortBy('position')->pluck('label')->all(),
            'included' => $package->inclusions->sortBy('position')->pluck('label')->all(),
            'price_numeric' => (int) round($package->price),
        ];
    }
}
