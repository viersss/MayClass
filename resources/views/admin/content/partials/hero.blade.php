<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('heroModal')">Edit Hero Section</button>

    <div style="margin-top:24px;padding:24px;background:#f9fafb;border-radius:8px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;">
            <div>
                <h3 style="margin:0 0 8px 0;font-size:18px;font-weight:600;">{{ $hero['hero_title'] ?? 'Judul Hero' }}
                </h3>
                <p style="margin:0;color:#64748b;">{{ $hero['hero_description'] ?? 'Deskripsi Hero' }}</p>
            </div>
            <div>
                @if(isset($hero['hero_image']))
                    <img src="{{ asset('storage/' . $hero['hero_image']) }}" alt="Hero"
                        style="width:100%;max-height:200px;object-fit:cover;border-radius:8px;">
                @else
                    <div style="padding:40px;background:#e2e8f0;border-radius:8px;text-align:center;color:#94a3b8;">No Image
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="heroModal" class="ct-modal-overlay">
    <div class="ct-modal">
        <form action="{{ route('admin.content.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ct-modal-header">
                <h3>Edit Hero Section</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('heroModal')">×</button>
            </div>
            <div class="ct-modal-body">
                <div class="ct-form-group">
                    <label class="ct-form-label">Judul Hero</label>
                    <input type="text" name="hero_title" class="ct-form-input" value="{{ $hero['hero_title'] ?? '' }}"
                        required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Deskripsi Hero</label>
                    <textarea name="hero_description" class="ct-form-textarea"
                        required>{{ $hero['hero_description'] ?? '' }}</textarea>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Gambar Background</label>
                    @if(isset($hero['hero_image']))
                        <img src="{{ asset('storage/' . $hero['hero_image']) }}"
                            style="width:100%;max-height:150px;object-fit:cover;border-radius:8px;margin-bottom:12px;">
                    @endif
                    <input type="file" name="hero_image" class="ct-form-input" accept="image/*">
                    <small style="color:#64748b;">Biarkan kosong jika tidak ingin mengubah gambar</small>
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary" onclick="ctCloseModal('heroModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>