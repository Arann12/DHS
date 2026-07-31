@extends('backoffice.layouts.app')
@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')
<div x-data="usersData()">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div class="bo-search">
            <span class="material-icons-round" style="font-size:18px;color:#8A8478;">search</span>
            <input type="text" placeholder="Cari pengguna..." x-model="search">
        </div>
        <button class="btn-primary" @click="openModal('add')">
            <span class="material-icons-round" style="font-size:18px;">person_add</span>
            Tambah Pengguna
        </button>
    </div>

    <div class="bo-card" style="padding:0;overflow:hidden;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th style="width:56px;">Avatar</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th style="width:140px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filtered" :key="item.id">
                    <tr>
                        <td>
                            <div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;color:#fff;background:linear-gradient(135deg,#1A1F6B,#101340);" x-text="item.nama.charAt(0).toUpperCase()"></div>
                        </td>
                        <td>
                            <div style="font-weight:700;color:#1a1a2e;" x-text="item.nama"></div>
                            <div style="font-size:12px;color:#8A8478;" x-text="item.email"></div>
                        </td>
                        <td>
                            <code style="background:#f3f4f6;padding:3px 8px;border-radius:6px;font-size:13px;color:#1A1F6B;" x-text="item.username"></code>
                        </td>
                        <td>
                            <span :class="item.role === 'Super Admin' ? 'badge badge-blue' : item.role === 'Editor' ? 'badge badge-green' : 'badge badge-gray'" x-text="item.role"></span>
                        </td>
                        <td>
                            <span :class="item.aktif ? 'badge badge-green' : 'badge badge-gray'" x-text="item.aktif ? 'Aktif' : 'Nonaktif'"></span>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;justify-content:center;">
                                <button class="btn-icon" @click="openModal('edit', item)" title="Edit" :disabled="item.isSelf" :style="item.isSelf?'opacity:0.4;cursor:not-allowed;':''">
                                    <span class="material-icons-round" style="font-size:17px;">edit</span>
                                </button>
                                <button class="btn-icon" @click="toggleAktif(item.id)" title="Aktif/Nonaktif" :disabled="item.isSelf" :style="item.isSelf?'opacity:0.4;cursor:not-allowed;':''">
                                    <span class="material-icons-round" style="font-size:17px;" x-text="item.aktif ? 'toggle_on' : 'toggle_off'" :style="item.aktif ? 'color:#16a34a;' : 'color:#8A8478;'"></span>
                                </button>
                                <button class="btn-icon danger" @click="deleteItem(item.id)" title="Hapus" :disabled="item.isSelf" :style="item.isSelf?'opacity:0.4;cursor:not-allowed;':''">
                                    <span class="material-icons-round" style="font-size:17px;">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr x-show="filtered.length === 0">
                    <td colspan="6" style="text-align:center;color:#8A8478;padding:40px;">Tidak ada pengguna ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p style="font-size:12.5px;color:#aaa;margin-top:12px;">
        <span class="material-icons-round" style="font-size:14px;vertical-align:middle;">info</span>
        Akun Anda sendiri tidak dapat diedit atau dihapus. Manajemen akun dilindungi saat terhubung ke backend.
    </p>

    {{-- Modal --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;" @keydown.escape.window="modal.open=false">
        <div class="bo-modal" @click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Pengguna Baru' : 'Edit Pengguna'"></h3>
                <button class="btn-icon" @click="modal.open=false"><span class="material-icons-round">close</span></button>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="bo-label">Nama Lengkap</label>
                    <input type="text" class="bo-input" x-model="modal.form.nama" placeholder="Nama lengkap">
                </div>
                <div class="form-group">
                    <label class="bo-label">Username</label>
                    <input type="text" class="bo-input" x-model="modal.form.username" placeholder="username_unik">
                </div>
                <div class="form-group">
                    <label class="bo-label">Email</label>
                    <input type="email" class="bo-input" x-model="modal.form.email" placeholder="email@dhs.ac.id">
                </div>
                <div class="form-group">
                    <label class="bo-label">Role</label>
                    <select class="bo-select" x-model="modal.form.role">
                        <option>Super Admin</option>
                        <option>Editor</option>
                        <option>Viewer</option>
                    </select>
                </div>
                <div class="form-group" x-show="modal.mode === 'add'">
                    <label class="bo-label">Password</label>
                    <input type="password" class="bo-input" x-model="modal.form.password" placeholder="Password sementara">
                </div>
                <div class="form-group">
                    <label class="bo-label">Status</label>
                    <select class="bo-select" x-model="modal.form.aktif">
                        <option :value="true">Aktif</option>
                        <option :value="false">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div x-show="modal.mode === 'add'" style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:12px;padding:12px 14px;margin-bottom:18px;font-size:13px;color:#92400e;display:flex;gap:10px;align-items:flex-start;">
                <span class="material-icons-round" style="font-size:17px;flex-shrink:0;margin-top:1px;">warning</span>
                <span>Password akan otomatis di-hash secara aman menggunakan algoritma bcrypt di database.</span>
            </div>

            <hr class="divider">
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="modal.open=false">Batal</button>
                <button class="btn-primary" @click="saveItem()">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span x-text="modal.mode === 'add' ? 'Tambah Pengguna' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="confirmDelete.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:420px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#D4302A;">person_remove</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Pengguna?</h3>
                <p style="font-size:14px;color:#8A8478;margin:0;">Pengguna ini akan kehilangan akses ke backoffice.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button class="btn-secondary" @click="confirmDelete.open=false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteItem()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function usersData() {
    return {
        search: '',
        items: @json($users->map(fn($u) => [
            'id'       => $u->id,
            'nama'     => $u->name,
            'username' => $u->username ?? explode('@', $u->email)[0],
            'email'    => $u->email,
            'role'     => $u->role === 'super_admin' ? 'Super Admin' : ($u->role === 'admin' ? 'Admin' : 'Editor'),
            'aktif'    => (bool)$u->is_active,
            'isSelf'   => $u->id === (session('backoffice_user')['id'] ?? null),
        ])),
        modal: { open:false, mode:'add', form:{}, editId:null },
        confirmDelete: { open:false, targetId:null },

        get filtered() {
            if (!this.search) return this.items;
            const q = this.search.toLowerCase();
            return this.items.filter(i => (i.nama||'').toLowerCase().includes(q) || (i.email||'').toLowerCase().includes(q));
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item ? { ...item } : { nama:'', email:'', role:'editor', password:'', aktif:true };
            this.modal.open = true;
        },

        saveItem() {
            if (!this.modal.form.nama.trim() || !this.modal.form.email.trim()) return alert('Nama dan email tidak boleh kosong.');
            const fd = new FormData();
            fd.append('name',     this.modal.form.nama);
            fd.append('username', this.modal.form.username || this.modal.form.nama.toLowerCase().replace(/\s+/g, '_'));
            fd.append('email',    this.modal.form.email);
            fd.append('role',     this.modal.form.role.toLowerCase().replace(' ', '_'));
            if (this.modal.form.password) fd.append('password', this.modal.form.password);
            fd.append('is_active', this.modal.form.aktif ? '1' : '0');
            fd.append('_token',   '{{ csrf_token() }}');

            const url = this.modal.mode === 'add'
                ? '/backoffice/users/store'
                : `/backoffice/users/${this.modal.editId}/update`;

            fetch(url, { method: 'POST', body: fd })
                .then(r => r.ok ? location.reload() : r.text().then(t => alert('Gagal menyimpan pengguna: ' + t)));
        },

        toggleAktif(id) {
            const item = this.items.find(i => i.id === id);
            if (!item || item.isSelf) return;
            fetch(`/backoffice/users/${id}/update`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ is_active: !item.aktif })
            }).then(() => item.aktif = !item.aktif);
        },

        deleteItem(id) {
            const item = this.items.find(i => i.id === id);
            if (item?.isSelf) return alert('Tidak dapat menghapus akun Anda sendiri.');
            this.confirmDelete.targetId = id;
            this.confirmDelete.open = true;
        },

        confirmDeleteItem() {
            fetch(`/backoffice/users/${this.confirmDelete.targetId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id: this.confirmDelete.targetId })
            }).then(r => r.ok ? location.reload() : alert('Gagal menghapus pengguna.'));
        }
    };
}
</script>
@endpush

