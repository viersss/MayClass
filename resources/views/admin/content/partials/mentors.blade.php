<div>
    <button class="ct-btn ct-btn-primary" onclick="ctOpenModal('addMentorModal')">Tambah Mentor</button>

    <table class="ct-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Role</th>
                <th>Experience</th>
                <th>Students</th>
                <th style="width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mentors as $mentor)
                <tr>
                    <td>{{ $mentor->name }}</td>
                    <td>{{ $mentor->role }}</td>
                    <td>{{ $mentor->experience }}</td>
                    <td>{{ $mentor->students_count }}</td>
                    <td>
                        <button class="ct-btn ct-btn-secondary ct-btn-sm"
                            onclick="ctOpenModal('editMentor{{ $mentor->id }}')" style="margin-right:8px;">Edit</button>
                        <form action="{{ route('admin.content.mentors.destroy', $mentor) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ct-btn ct-btn-danger ct-btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div id="editMentor{{ $mentor->id }}" class="ct-modal-overlay">
                    <div class="ct-modal">
                        <form action="{{ route('admin.content.mentors.update', $mentor) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="ct-modal-header">
                                <h3>Edit Mentor</h3>
                                <button type="button" class="ct-modal-close"
                                    onclick="ctCloseModal('editMentor{{ $mentor->id }}')">×</button>
                            </div>
                            <div class="ct-modal-body">
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Nama</label>
                                    <input type="text" name="name" class="ct-form-input" value="{{ $mentor->name }}"
                                        required>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Role</label>
                                    <input type="text" name="role" class="ct-form-input" value="{{ $mentor->role }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Quote</label>
                                    <textarea name="quote" class="ct-form-textarea">{{ $mentor->quote }}</textarea>
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Experience</label>
                                    <input type="text" name="experience" class="ct-form-input"
                                        value="{{ $mentor->experience }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Students Count</label>
                                    <input type="text" name="students_count" class="ct-form-input"
                                        value="{{ $mentor->students_count }}">
                                </div>
                                <div class="ct-form-group">
                                    <label class="ct-form-label">Avatar</label>
                                    @if($mentor->avatar)
                                        <img src="{{ asset('storage/' . $mentor->avatar) }}"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:50%;margin-bottom:12px;">
                                    @endif
                                    <input type="file" name="avatar" class="ct-form-input" accept="image/*">
                                </div>
                            </div>
                            <div class="ct-modal-footer">
                                <button type="button" class="ct-btn ct-btn-secondary"
                                    onclick="ctCloseModal('editMentor{{ $mentor->id }}')">Batal</button>
                                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#94a3b8;padding:40px;">Belum ada mentor</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addMentorModal" class="ct-modal-overlay">
    <div class="ct-modal">
        <form action="{{ route('admin.content.mentors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="ct-modal-header">
                <h3>Tambah Mentor Baru</h3>
                <button type="button" class="ct-modal-close" onclick="ctCloseModal('addMentorModal')">×</button>
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
                    <label class="ct-form-label">Quote</label>
                    <textarea name="quote" class="ct-form-textarea"></textarea>
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Experience</label>
                    <input type="text" name="experience" class="ct-form-input">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Students Count</label>
                    <input type="text" name="students_count" class="ct-form-input">
                </div>
                <div class="ct-form-group">
                    <label class="ct-form-label">Avatar</label>
                    <input type="file" name="avatar" class="ct-form-input" accept="image/*">
                </div>
            </div>
            <div class="ct-modal-footer">
                <button type="button" class="ct-btn ct-btn-secondary"
                    onclick="ctCloseModal('addMentorModal')">Batal</button>
                <button type="submit" class="ct-btn ct-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>