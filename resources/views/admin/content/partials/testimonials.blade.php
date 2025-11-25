<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('addTestimonialModal')">Tambah Testimoni</button>

    <table class="ct-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Role</th>
                <th>Rating</th>
                <th style="width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $test)
                <tr>
                    <td>{{ $test->name }}</td>
                    <td>{{ $test->role }}</td>
                    <td>{{ str_repeat('⭐', $test->rating) }}</td>
                    <td>
                        <button class="ct-btn ct-btn-secondary ct-btn-sm" onclick="ctOpenModal('editTest{{ $test->id }}')"
                            style="margin-right:8px;">Edit</button>
                        <form action="{{ route('admin.content.testimonials.destroy', $test) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ct-btn ct-btn-danger ct-btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div id="editTest{{ $test->id }}" class="ct-modal-overlay">
                    <div class="ct-modal">
                        <form action="{{ route('admin.content.testimonials.update', $test) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="ct-modal-header">
                                <h3>Edit Testimoni</h3>
                                <button type="button" class="ct-modal-close"
                                    onclick="ctCloseModal('editTest{{ $test->id }}')">×</button>
                            </div>
                            <div class="ct-modal-body">
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Nama</label>
                                    <input type="text" name="name" class="ct-form-input" value="{{ $test->name }}" required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Role</label>
                                    <input type="text" name="role" class="ct-form-input" value="{{ $test->role }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Badge</label>
                                    <input type="text" name="badge" class="ct-form-input" value="{{ $test->badge }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Konten</label>
                                    <textarea name="content" class="ct-form-textarea"
                                        required>{{ $test->content }}</textarea>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Rating (1-5)</label>
                                    <input type="number" name="rating" class="ct-form-input" min="1" max="5"
                                        value="{{ $test->rating }}" required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Avatar</label>
                                    @if($test->avatar)
                                        <img src="{{ asset('storage/' . $test->avatar) }}"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:50%;margin-bottom:12px;">
                                    @endif
                                    <input type="file" name="avatar" class="ct-form-input" accept="image/*">
                                </div>
                            </div>
                            <div class="ct-modal-footer">
                                <button type="button" class="ct-btn ct-btn-secondary"
                                    onclick="ctCloseModal('editTest{{ $test->id }}')">Batal</button>
                                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#94a3b8;padding:40px;">Belum ada testimoni</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addTestimonialModal" class="ct-modal-overlay">
    <div class=" ct-modal">
        <form action="{{ route('admin.content.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ct-modal-header">
                <h3>Tambah Testimoni Baru</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('addTestimonialModal')">×</button>
            </div>
            <div class="ct-modal-body">
                <div class="ct-form-group">
                    <label class="ct-form-label">Nama</label>
                    <input type="text" name="name" class="ct-form-input" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Role</label>
                    <input type="text" name="role" class="ct-form-input">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Badge</label>
                    <input type="text" name="badge" class="ct-form-input">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Konten</label>
                    <textarea name="content" class="ct-form-textarea" required></textarea>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Rating (1-5)</label>
                    <input type="number" name="rating" class="ct-form-input" min="1" max="5" value="5" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Avatar</label>
                    <input type="file" name="avatar" class="ct-form-input" accept="image/*">
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary"
                    onclick="ctCloseModal('addTestimonialModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>