<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('addFaqModal')">Tambah FAQ</button>

    <table class="ct-table">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th style="width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ Str::limit($faq->answer, 100) }}</td>
                    <td>
                        <button class="ct-btn ct-btn-secondary ct-btn-sm" onclick="ctOpenModal('editFaq{{ $faq->id }}')"
                            style="margin-right:8px;">Edit</button>
                        <form action="{{ route('admin.content.faqs.destroy', $faq) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ct-btn ct-btn-danger ct-btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div id="editFaq{{ $faq->id }}" class="ct-modal-overlay">
                    <div class="ct-modal">
                        <form action="{{ route('admin.content.faqs.update', $faq) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="ct-modal-header">
                                <h3>Edit FAQ</h3>
                                <button type="button" class="ct-modal-close"
                                    onclick="ctCloseModal('editFaq{{ $faq->id }}')">×</button>
                            </div>
                            <div class="ct-modal-body">
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Pertanyaan</label>
                                    <input type="text" name="question" class="ct-form-input" value="{{ $faq->question }}"
                                        required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Jawaban</label>
                                    <textarea name="answer" class="ct-form-textarea" required>{{ $faq->answer }}</textarea>
                                </div>
                            </div>
                            <div class="ct-modal-footer">
                                <button type="button" class="ct-btn ct-btn-secondary"
                                    onclick="ctCloseModal('editFaq{{ $faq->id }}')">Batal</button>
                                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;color:#94a3b8;padding:40px;">Belum ada FAQ</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addFaqModal" class="ct-modal-overlay">
    <div class="ct-modal">
        <form action="{{ route('admin.content.faqs.store') }}" method="POST">
            @csrf
            <div class="ct-modal-header">
                <h3>Tambah FAQ Baru</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('addFaqModal')">×</button>
            </div>
            <div class="ct-modal-body">
                <div class="ct-form-group">
                    <label class="ct-form-label">Pertanyaan</label>
                    <input type="text" name="question" class="ct-form-input" required>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Jawaban</label>
                    <textarea name="answer" class="ct-form-textarea" required></textarea>
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary"
                    onclick="ctCloseModal('addFaqModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>