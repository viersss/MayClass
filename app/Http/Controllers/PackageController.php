<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Support\PackagePresenter;
use App\Support\ProfileAvatar;
use App\Support\ProfileLinkResolver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PackageController extends Controller
{
    public function index()
    {
        if (! Schema::hasTable('packages')) {
            return view('packages.index', [
                'catalog' => collect(),
                'stageDefinitions' => config('mayclass.package_stages', []),
                'profileLink' => ProfileLinkResolver::forUser(Auth::user()),
                'profileAvatar' => ProfileAvatar::forUser(Auth::user()),
            ]);
        }

        $query = Package::query()->orderBy('level')->orderBy('price');

        if (Schema::hasTable('package_features')) {
            $query->with(['cardFeatures' => fn ($features) => $features->orderBy('position')]);
        }

        $packages = $query->get();
        $catalog = PackagePresenter::groupByStage($packages);

        return view('packages.index', [
            'catalog' => $catalog,
            'stageDefinitions' => config('mayclass.package_stages', []),
            'profileLink' => ProfileLinkResolver::forUser(Auth::user()),
            'profileAvatar' => ProfileAvatar::forUser(Auth::user()),
        ]);
    }

    public function show(string $slug)
    {
        $package = Package::with(['cardFeatures', 'inclusions'])->where('slug', $slug)->firstOrFail();

        return view('packages.show', [
            'package' => $this->formatPackage($package),
            'profileLink' => ProfileLinkResolver::forUser(Auth::user()),
            'profileAvatar' => ProfileAvatar::forUser(Auth::user()),
        ]);
    }

    private function formatPackage(Package $package): array
    {
        return PackagePresenter::detail($package);
    }
}
