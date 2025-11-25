<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('addArticleModal')">Tambah Artikel</button>

    <table class="ct-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Featured</th>
                <th style="width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category }}</td>
                    <td>{{ $article->is_featured ? '⭐ Ya' : 'Tidak' }}</td>
                    <td>
                        <button class="ct-btn ct-btn-secondary ct-btn-sm"
                            onclick="ctOpenModal('editArticle{{ $article->id }}')" style="margin-right:8px;">Edit</button>
                        <form action="{{ route('admin.content.articles.destroy', $article) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ct-btn ct-btn-danger ct-btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div id="editArticle{{ $article->id }}" class="ct-modal-overlay">
                    <div class="ct-modal">
                        <form action="{{ route('admin.content.articles.update', $article) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="ct-modal-header">
                                <h3>Edit Artikel</h3>
                                <button type="button" class="ct-modal-close"
                                    onclick="ctCloseModal('editArticle{{ $article->id }}')">×</button>
                            </div>
                            <div class="ct-modal-body">
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Judul</label>
                                    <input type="text" name="title" class="ct-form-input" value="{{ $article->title }}"
                                        required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Kategori</label>
                                    <input type="text" name="category" class="ct-form-input"
                                        value="{{ $article->category }}" required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Konten</label>
                                    <textarea name="content" class="ct-form-textarea"
                                        required>{{ $article->content }}</textarea>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Link</label>
                                    <input type="url" name="link" class="ct-form-input" value="{{ $article->link }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Gambar</label>
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}"
                                            style="width:100%;max-height:150px;object-fit:cover;border-radius:8px;margin-bottom:12px;">
                                    @endif
                                    <input type="file" name="image" class="ct-form-input" accept="image/*">
                                </div>
                                <div class="ct-form-group">
                                    <label style="display:flex;align-items:center;gap:8px;">
                                        <input type="checkbox" name="is_featured" value="1" {{ $article->is_featured ? 'checked' : '' }} style="width:18px;height:18px;">
                                        <span class="ct-form-label" style="margin:0;">Featured?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="ct-modal-footer">
                                <button type="button" class="ct-btn ct-btn-secondary"
                                    onclick="ctCloseModal('editArticle{{ $article->id }}')">Batal</button>
                                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#94a3b8;padding:40px;">Belum ada artikel</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addArticleModal" class="ct-modal-overlay">
    <div class="ct-modal">
        <form action="{{ route('admin.content.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ct-modal-header">
                <h3>Tambah Artikel Baru</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('addArticleModal')">×</button>
            </div>
            <div class="ct-modal-body">
                <div class="ct-form-group">
                    <label class="ct-form-label">Judul</label>
                    <input type="text" name="title" class="ct-form-input" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Kategori</label>
                    <input type="text" name="category" class="ct-form-input" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Konten</label>
                    <textarea name="content" class="ct-form-textarea" required></textarea>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Link</label>
                    <input type="url" name="link" class="ct-form-input">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Gambar</label>
                    <input type="file" name="image" class="ct-form-input" accept="image/*">
                </div>
                <div class="ct-form-group">
                    <label style="display:flex;align-items:center;gap:8px;">
                        <input type="checkbox" name="is_featured" value="1" style="width:18px;height:18px;">
                        <span class="ct-form-label" style="margin:0;">Featured?</span>
                    </label>
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary"
                    onclick="ctCloseModal('addArticleModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>