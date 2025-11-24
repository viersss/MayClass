<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('addAdvantageModal')">Tambah Keunggulan</button>

    <table class="ct-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th style="width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($advantages as $advantage)
                <tr>
                    <td>{{ $advantage->title }}</td>
                    <td>{{ Str::limit($advantage->description, 100) }}</td>
                    <td>
                        <button class="ct-btn ct-btn-secondary ct-btn-sm"
                            onclick="ctOpenModal('editAdv{{ $advantage->id }}')" style="margin-right:8px;">Edit</button>
                        <form action="{{ route('admin.content.advantages.destroy', $advantage) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ct-btn ct-btn-danger ct-btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div id="editAdv{{ $advantage->id }}" class="ct-modal-overlay">
                    <div class="ct-modal">
                        <form action="{{ route('admin.content.advantages.update', $advantage) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="ct-modal-header">
                                <h3>Edit Keunggulan</h3>
                                <button type="button" class="ct-modal-close"
                                    onclick="ctCloseModal('editAdv{{ $advantage->id }}')">×</button>
                            </div>
                            <div class="ct-modal-body">
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Judul</label>
                                    <input type="text" name="title" class="ct-form-input" value="{{ $advantage->title }}"
                                        required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Deskripsi</label>
                                    <textarea name="description" class="ct-form-textarea"
                                        required>{{ $advantage->description }}</textarea>
                                </div>
                            </div>
                            <div class="ct-modal-footer">
                                <button type="button" class="ct-btn ct-btn-secondary"
                                    onclick="ctCloseModal('editAdv{{ $advantage->id }}')">Batal</button>
                                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;color:#94a3b8;padding:40px;">Belum ada keunggulan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addAdvantageModal" class="ct-modal-overlay">
    <div class="ct-modal">
        <form action="{{ route('admin.content.advantages.store') }}" method="POST">
            @csrf
            <div class="ct-modal-header">
                <h3>Tambah Keunggulan Baru</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('addAdvantageModal')">×</button>
            </div>
            <div class="ct-modal-body">
                <div class="ct-form-group">
                    <label class="ct-form-label">Judul</label>
                    <input type="text" name="title" class="ct-form-input" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Deskripsi</label>
                    <textarea name="description" class="ct-form-textarea" required></textarea>
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary"
                    onclick="ctCloseModal('addAdvantageModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>