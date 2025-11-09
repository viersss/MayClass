<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends BaseAdminController
{
    public function index(): View
    {
        $packages = Schema::hasTable('packages')
            ? Package::orderBy('level')->get()
            : collect();

        return $this->render('admin.packages.index', [
            'packages' => $packages,
        ]);
    }

    public function create(): View
    {
        return $this->render('admin.packages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePayload($request);

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('status', __('Paket berhasil dibuat.'));
    }

    public function edit(Package $package): View
    {
        return $this->render('admin.packages.edit', [
            'package' => $package,
        ]);
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $data = $this->validatePayload($request, $package->id);

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('status', __('Paket berhasil diperbarui.'));
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('status', __('Paket berhasil dihapus.'));
    }

    private function validatePayload(Request $request, ?int $packageId = null): array
    {
        return $request->validate([
            'slug' => ['required', 'string', 'max:255', Rule::unique(Package::class)->ignore($packageId)],
            'level' => ['required', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:50'],
            'card_price_label' => ['required', 'string', 'max:50'],
            'detail_title' => ['required', 'string', 'max:255'],
            'detail_price_label' => ['required', 'string', 'max:50'],
            'image_url' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'summary' => ['required', 'string'],
        ]);
    }
}
