@extends('backoffice.layouts.app')
@section('title', 'Kelola Akun Pengguna')
@section('page-title', 'Kelola Akun Backoffice')

@php
    $currentId = session('backoffice_user.id');
    $userItems = $users->map(function($u) use ($currentId) {
        $roleKey = $u->role ?? 'admin';
        $words = preg_split('/\s+/', trim($u->name ?? 'User'));
        $initials = strtoupper(substr($words[0] ?? 'U', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));

        $colors = [
            'super_admin' => 'linear-gradient(135deg, #1e3a8a, #005697)',
            'admin'       => 'linear-gradient(135deg, #6d28d9, #8b5cf6)',
            'finance'     => 'linear-gradient(135deg, #047857, #10b981)',
        ];

        return [
            'id'                  => $u->id,
            'nama'                => $u->name,
            'username'            => $u->username ?? explode('@', $u->email)[0],
            'email'               => $u->email,
            'roleKey'             => $roleKey,
            'aktif'               => (bool)$u->is_active,
            'isSelf'              => (int)$u->id === (int)$currentId,
            'initials'            => $initials,
            'avatarBg'            => $colors[$roleKey] ?? 'linear-gradient(135deg, #475569, #64748b)',
            'lastLoginFormatted'  => $u->last_login_at ? date('d M Y, H:i', strtotime($u->last_login_at)) : null,
        ];
    })->values();
@endphp

@section('content')
<div x-data="usersManager()" x-cloak>

    {{-- Header Banner / Title Section --}}
    <div style="margin-bottom:24px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <h2 style="font-family:'Playfair Display',serif;font-size:24px;font-weight:700;color:#0F2440;margin:0 0 6px;">
                    Kelola Akun Pengguna Backoffice
                </h2>
                <p style="font-size:13.5px;color:#64748b;margin:0;max-width:680px;line-height:1.5;">
                    Hak istimewa <strong style="color:#005697;">Super Admin</strong> untuk membuat akun baru staf operasional, menentukan hak akses modul (Super Admin, Admin CMS, Finance), mengubah kata sandi, dan mengontrol status aktif akun.
                </p>
            </div>
            <button type="button" class="btn-primary" @click="openModal('add')" style="display:inline-flex;align-items:center;gap:8px;padding:11px 20px;border-radius:12px;font-weight:600;box-shadow:0 4px 14px rgba(0,86,151,0.25);">
                <span class="material-icons-round" style="font-size:20px;">person_add</span>
                <span>Buat Akun Baru</span>
            </button>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(210px, 1fr));gap:16px;margin-bottom:24px;">
        {{-- Total Users --}}
        <div class="bo-card" style="padding:18px 20px;display:flex;align-items:center;gap:16px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.03);">
            <div style="width:48px;height:48px;border-radius:14px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:26px;">people</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;">Total Akun</div>
                <div style="font-size:22px;font-weight:800;color:#0f172a;line-height:1.2;" x-text="items.length">0</div>
                <div style="font-size:11.5px;color:#0284c7;margin-top:2px;" x-text="items.filter(i => i.aktif).length + ' akun aktif'">0 akun aktif</div>
            </div>
        </div>

        {{-- Super Admin --}}
        <div class="bo-card" style="padding:18px 20px;display:flex;align-items:center;gap:16px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.03);">
            <div style="width:48px;height:48px;border-radius:14px;background:#eff6ff;color:#1d4ed8;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:26px;">shield</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;">Super Admin</div>
                <div style="font-size:22px;font-weight:800;color:#1d4ed8;line-height:1.2;" x-text="items.filter(i => i.roleKey === 'super_admin').length">0</div>
                <div style="font-size:11.5px;color:#64748b;margin-top:2px;">Akses Penuh Semua Modul</div>
            </div>
        </div>

        {{-- Admin CMS --}}
        <div class="bo-card" style="padding:18px 20px;display:flex;align-items:center;gap:16px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.03);">
            <div style="width:48px;height:48px;border-radius:14px;background:#f5f3ff;color:#7c3aed;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:26px;">admin_panel_settings</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;">Admin CMS</div>
                <div style="font-size:22px;font-weight:800;color:#7c3aed;line-height:1.2;" x-text="items.filter(i => i.roleKey === 'admin').length">0</div>
                <div style="font-size:11.5px;color:#64748b;margin-top:2px;">Pengelola Web &amp; Konten</div>
            </div>
        </div>

        {{-- Finance --}}
        <div class="bo-card" style="padding:18px 20px;display:flex;align-items:center;gap:16px;background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.03);">
            <div style="width:48px;height:48px;border-radius:14px;background:#ecfdf5;color:#059669;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:26px;">account_balance_wallet</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;">Finance</div>
                <div style="font-size:22px;font-weight:800;color:#059669;line-height:1.2;" x-text="items.filter(i => i.roleKey === 'finance').length">0</div>
                <div style="font-size:11.5px;color:#64748b;margin-top:2px;">Pengelola Kas &amp; Piutang</div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Toolbar --}}
    <div class="bo-card" style="margin-bottom:20px;padding:16px 20px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
            <div style="display:flex;align-items:center;gap:12px;flex:1;min-width:280px;">
                <div class="bo-search" style="flex:1;background:#f8fafc;border:1px solid #cbd5e1;border-radius:10px;padding:9px 14px;">
                    <span class="material-icons-round" style="font-size:20px;color:#94a3b8;">search</span>
                    <input type="text" placeholder="Cari nama, email, username..." x-model="search" style="font-size:13.5px;width:100%;">
                    <button type="button" x-show="search" @click="search=''" style="background:none;border:none;color:#94a3b8;cursor:pointer;padding:0;">
                        <span class="material-icons-round" style="font-size:18px;">close</span>
                    </button>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                {{-- Filter Role --}}
                <div style="display:flex;align-items:center;gap:6px;">
                    <span style="font-size:12.5px;color:#64748b;font-weight:600;">Role:</span>
                    <select class="bo-select" x-model="filterRole" style="padding:7px 12px;font-size:13px;width:auto;border-radius:8px;">
                        <option value="">Semua Role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin CMS</option>
                        <option value="finance">Finance</option>
                    </select>
                </div>

                {{-- Filter Status --}}
                <div style="display:flex;align-items:center;gap:6px;">
                    <span style="font-size:12.5px;color:#64748b;font-weight:600;">Status:</span>
                    <select class="bo-select" x-model="filterStatus" style="padding:7px 12px;font-size:13px;width:auto;border-radius:8px;">
                        <option value="">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div x-show="search || filterRole || filterStatus">
                    <button type="button" class="btn-secondary" @click="resetFilters()" style="padding:7px 12px;font-size:12.5px;display:flex;align-items:center;gap:4px;">
                        <span class="material-icons-round" style="font-size:16px;">restart_alt</span> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #e2e8f0;border-radius:16px;background:#ffffff;box-shadow:0 4px 16px rgba(0,0,0,0.03);">
        <div style="overflow-x:auto;">
            <table class="bo-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0;color:#475569;font-size:12px;text-transform:uppercase;letter-spacing:0.04em;">
                        <th style="padding:14px 20px;text-align:left;width:280px;">Nama Pengguna &amp; Email</th>
                        <th style="padding:14px 18px;text-align:left;width:170px;">Username</th>
                        <th style="padding:14px 18px;text-align:left;width:160px;">Role Akses</th>
                        <th style="padding:14px 18px;text-align:center;width:130px;">Status</th>
                        <th style="padding:14px 18px;text-align:left;width:170px;">Terakhir Login</th>
                        <th style="padding:14px 20px;text-align:center;width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="item in filtered" :key="item.id">
                        <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.15s;" :style="item.isSelf ? 'background:#fafcff;' : ''">
                            {{-- User Info --}}
                            <td style="padding:14px 20px;">
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <div :style="'background:' + item.avatarBg + ';color:#ffffff;width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;box-shadow:0 2px 6px rgba(0,0,0,0.12);'"
                                         x-text="item.initials">
                                    </div>
                                    <div style="min-width:0;">
                                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                                            <span style="font-weight:700;color:#0f172a;font-size:14px;" x-text="item.nama"></span>
                                            <template x-if="item.isSelf">
                                                <span style="display:inline-flex;align-items:center;gap:3px;font-size:11px;font-weight:600;padding:2px 7px;border-radius:6px;background:#dbeafe;color:#1e40af;">
                                                    <span class="material-icons-round" style="font-size:13px;">verified_user</span> Akun Anda
                                                </span>
                                            </template>
                                        </div>
                                        <div style="font-size:12.5px;color:#64748b;margin-top:2px;" x-text="item.email"></div>
                                    </div>
                                </div>
                            </td>

                            {{-- Username --}}
                            <td style="padding:14px 18px;">
                                <code style="background:#f1f5f9;color:#334155;padding:4px 8px;border-radius:6px;font-size:12.5px;font-family:ui-monospace,SFMono-Regular,Consolas,monospace;font-weight:600;" x-text="'@' + item.username"></code>
                            </td>

                            {{-- Role --}}
                            <td style="padding:14px 18px;">
                                <template x-if="item.roleKey === 'super_admin'">
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;">
                                        <span class="material-icons-round" style="font-size:15px;">shield</span> Super Admin
                                    </span>
                                </template>
                                <template x-if="item.roleKey === 'admin'">
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe;">
                                        <span class="material-icons-round" style="font-size:15px;">admin_panel_settings</span> Admin CMS
                                    </span>
                                </template>
                                <template x-if="item.roleKey === 'finance'">
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;">
                                        <span class="material-icons-round" style="font-size:15px;">account_balance_wallet</span> Finance
                                    </span>
                                </template>
                            </td>

                            {{-- Status --}}
                            <td style="padding:14px 18px;text-align:center;">
                                <template x-if="item.aktif">
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:999px;font-size:11.5px;font-weight:700;background:#dcfce7;color:#15803d;">
                                        <span style="width:6px;height:6px;border-radius:50%;background:#22c55e;"></span> Aktif
                                    </span>
                                </template>
                                <template x-if="!item.aktif">
                                    <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:999px;font-size:11.5px;font-weight:700;background:#fee2e2;color:#b91c1c;">
                                        <span style="width:6px;height:6px;border-radius:50%;background:#ef4444;"></span> Nonaktif
                                    </span>
                                </template>
                            </td>

                            {{-- Last Login --}}
                            <td style="padding:14px 18px;font-size:12.5px;color:#64748b;">
                                <div x-text="item.lastLoginFormatted || 'Belum pernah login'"></div>
                            </td>

                            {{-- Actions --}}
                            <td style="padding:14px 20px;text-align:center;">
                                <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                                    {{-- Edit --}}
                                    <button type="button" class="btn-icon" @click="openModal('edit', item)" title="Edit Akun" style="width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;">
                                        <span class="material-icons-round" style="font-size:17px;color:#0284c7;">edit</span>
                                    </button>

                                    {{-- Toggle Status --}}
                                    <button type="button" class="btn-icon" @click="toggleAktif(item)"
                                            :disabled="item.isSelf"
                                            :title="item.isSelf ? 'Tidak bisa menonaktifkan akun sendiri' : (item.aktif ? 'Klik untuk Nonaktifkan' : 'Klik untuk Aktifkan')"
                                            :style="item.isSelf ? 'opacity:0.35;cursor:not-allowed;width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;' : 'width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;'">
                                        <span class="material-icons-round" style="font-size:19px;"
                                              :style="item.aktif ? 'color:#16a34a;' : 'color:#94a3b8;'"
                                              x-text="item.aktif ? 'toggle_on' : 'toggle_off'"></span>
                                    </button>

                                    {{-- Delete --}}
                                    <button type="button" class="btn-icon danger" @click="openDeleteModal(item)"
                                            :disabled="item.isSelf"
                                            :title="item.isSelf ? 'Tidak bisa menghapus akun sendiri' : 'Hapus Pengguna'"
                                            :style="item.isSelf ? 'opacity:0.35;cursor:not-allowed;width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;' : 'width:34px;height:34px;border-radius:8px;border:1px solid #fed7d7;background:#fff5f5;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;'">
                                        <span class="material-icons-round" style="font-size:17px;color:#e11d48;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filtered.length === 0">
                        <td colspan="6" style="text-align:center;color:#64748b;padding:50px 20px;">
                            <div style="width:60px;height:60px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;color:#94a3b8;">
                                <span class="material-icons-round" style="font-size:32px;">person_search</span>
                            </div>
                            <div style="font-weight:700;font-size:15px;color:#334155;margin-bottom:4px;">Tidak Ada Pengguna Ditemukan</div>
                            <div style="font-size:13px;color:#94a3b8;">Coba sesuaikan kata kunci pencarian atau filter role.</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Security Alert & Guidelines --}}
    <div style="margin-top:20px;padding:16px 20px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;display:flex;align-items:flex-start;gap:14px;">
        <span class="material-icons-round" style="font-size:22px;color:#005697;flex-shrink:0;margin-top:1px;">verified_user</span>
        <div style="font-size:13px;color:#475569;line-height:1.6;">
            <strong style="color:#0f172a;">Pedoman Hak Akses Pengguna Backoffice:</strong>
            <ul style="margin:6px 0 0;padding-left:18px;">
                <li><strong>Super Admin:</strong> Memegang seluruh otoritas sistem termasuk Keuangan Kas, Modul CMS, dan pembuatan/penghapusan akun staf.</li>
                <li><strong>Admin CMS:</strong> Diberikan kepada staf operasional website untuk memperbarui konten profil, program kursus, berita, formulir admisi, dan layanan tanpa akses keuangan.</li>
                <li><strong>Finance:</strong> Diberikan kepada bendahara atau staf keuangan untuk mencatat transaksi kas, memproses pelunasan cicilan / piutang, dan mengelola kategori kas.</li>
                <li>Akun Anda sendiri terlindungi dari penghapusan dan penonaktifan secara otomatis untuk mencegah sistem kehilangan administrator.</li>
            </ul>
        </div>
    </div>

    {{-- MODAL FORM (ADD & EDIT USER) --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;" @keydown.escape.window="closeModal()">
        <div class="bo-modal wide" @click.stop style="max-width:680px;border-radius:20px;padding:28px 32px;">
            {{-- Modal Header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;border-radius:12px;background:#eff6ff;color:#005697;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:24px;" x-text="modal.mode === 'add' ? 'person_add' : 'manage_accounts'"></span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;line-height:1.2;"
                            x-text="modal.mode === 'add' ? 'Buat Akun Backoffice Baru' : 'Edit Akun Pengguna'">
                        </h3>
                        <p style="margin:3px 0 0;font-size:12.5px;color:#64748b;"
                           x-text="modal.mode === 'add' ? 'Tambahkan akun staf baru untuk operasional backoffice DHS.' : 'Perbarui data identitas, peran hak akses, dan kredensial akun.'">
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-icon" @click="closeModal()" title="Tutup">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            {{-- Validation Error Alert --}}
            <div x-show="modal.errorMessage" style="margin-bottom:18px;padding:12px 16px;border-radius:10px;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;font-size:13px;display:flex;align-items:center;gap:10px;">
                <span class="material-icons-round" style="font-size:18px;flex-shrink:0;">error_outline</span>
                <span x-text="modal.errorMessage"></span>
            </div>

            {{-- Form Body --}}
            <form @submit.prevent="saveUser()">
                <div class="form-grid-2" style="margin-bottom:14px;">
                    {{-- Nama Lengkap --}}
                    <div class="form-group" style="margin-bottom:16px;">
                        <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:13px;color:#334155;">
                            Nama Lengkap <span style="color:#ef4444;">*</span>
                        </label>
                        <div style="position:relative;">
                            <span class="material-icons-round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:18px;color:#94a3b8;">badge</span>
                            <input type="text" class="bo-input" x-model="modal.form.nama" @input="onNameInput()" placeholder="Contoh: Budi Santoso" style="padding-left:38px;" required>
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="form-group" style="margin-bottom:16px;">
                        <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:13px;color:#334155;">
                            Username Login <span style="color:#ef4444;">*</span>
                        </label>
                        <div style="position:relative;">
                            <span class="material-icons-round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:18px;color:#94a3b8;">alternate_email</span>
                            <input type="text" class="bo-input" x-model="modal.form.username" placeholder="budi_santoso" style="padding-left:38px;" required>
                        </div>
                        <div style="font-size:11.5px;color:#64748b;margin-top:4px;">Digunakan untuk masuk sistem. Huruf kecil, angka, underscore.</div>
                    </div>
                </div>

                <div class="form-grid-2" style="margin-bottom:14px;">
                    {{-- Email --}}
                    <div class="form-group" style="margin-bottom:16px;">
                        <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:13px;color:#334155;">
                            Alamat Email <span style="color:#ef4444;">*</span>
                        </label>
                        <div style="position:relative;">
                            <span class="material-icons-round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:18px;color:#94a3b8;">email</span>
                            <input type="email" class="bo-input" x-model="modal.form.email" placeholder="budi@dhs.ac.id" style="padding-left:38px;" required>
                        </div>
                    </div>

                    {{-- Status Akun --}}
                    <div class="form-group" style="margin-bottom:16px;">
                        <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:13px;color:#334155;">
                            Status Akun <span style="color:#ef4444;">*</span>
                        </label>
                        <select class="bo-select" x-model="modal.form.aktif" :disabled="modal.isSelfAccount" style="height:44px;">
                            <option :value="true">🟢 Aktif (Bisa Login)</option>
                            <option :value="false">🔴 Nonaktif (Akses Ditangguhkan)</option>
                        </select>
                        <template x-if="modal.isSelfAccount">
                            <div style="font-size:11.5px;color:#b45309;margin-top:4px;">Akun Anda sendiri harus selalu aktif.</div>
                        </template>
                    </div>
                </div>

                {{-- Role Selection Section --}}
                <div style="margin-bottom:18px;">
                    <label class="bo-label" style="display:block;margin-bottom:8px;font-weight:600;font-size:13px;color:#334155;">
                        Pilih Hak Akses / Role <span style="color:#ef4444;">*</span>
                    </label>

                    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));gap:12px;">
                        {{-- Option 1: Super Admin --}}
                        <label style="cursor:pointer;border-radius:12px;padding:12px;border:2px solid;display:block;transition:all 0.15s;"
                               :style="modal.form.role === 'super_admin' ? 'border-color:#1d4ed8;background:#eff6ff;' : 'border-color:#e2e8f0;background:#ffffff;'"
                               @click="if(!modal.isSelfAccount) modal.form.role = 'super_admin'">
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                                <input type="radio" name="role_choice" value="super_admin" x-model="modal.form.role" :disabled="modal.isSelfAccount" style="accent-color:#1d4ed8;">
                                <span class="material-icons-round" style="font-size:18px;color:#1d4ed8;">shield</span>
                                <span style="font-weight:700;font-size:13px;color:#1e3a8a;">Super Admin</span>
                            </div>
                            <div style="font-size:11.5px;color:#475569;line-height:1.4;">
                                Akses mutlak semua modul CMS, Keuangan Kas, &amp; Kelola Akun.
                            </div>
                        </label>

                        {{-- Option 2: Admin CMS --}}
                        <label style="cursor:pointer;border-radius:12px;padding:12px;border:2px solid;display:block;transition:all 0.15s;"
                               :style="modal.form.role === 'admin' ? 'border-color:#7c3aed;background:#f5f3ff;' : 'border-color:#e2e8f0;background:#ffffff;'"
                               @click="if(!modal.isSelfAccount) modal.form.role = 'admin'">
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                                <input type="radio" name="role_choice" value="admin" x-model="modal.form.role" :disabled="modal.isSelfAccount" style="accent-color:#7c3aed;">
                                <span class="material-icons-round" style="font-size:18px;color:#7c3aed;">admin_panel_settings</span>
                                <span style="font-weight:700;font-size:13px;color:#5b21b6;">Admin CMS</span>
                            </div>
                            <div style="font-size:11.5px;color:#475569;line-height:1.4;">
                                Mengelola Web, Berita, Program, Admisi &amp; Layanan (Tanpa Keuangan).
                            </div>
                        </label>

                        {{-- Option 3: Finance --}}
                        <label style="cursor:pointer;border-radius:12px;padding:12px;border:2px solid;display:block;transition:all 0.15s;"
                               :style="modal.form.role === 'finance' ? 'border-color:#059669;background:#ecfdf5;' : 'border-color:#e2e8f0;background:#ffffff;'"
                               @click="if(!modal.isSelfAccount) modal.form.role = 'finance'">
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                                <input type="radio" name="role_choice" value="finance" x-model="modal.form.role" :disabled="modal.isSelfAccount" style="accent-color:#059669;">
                                <span class="material-icons-round" style="font-size:18px;color:#059669;">account_balance_wallet</span>
                                <span style="font-weight:700;font-size:13px;color:#065f46;">Finance</span>
                            </div>
                            <div style="font-size:11.5px;color:#475569;line-height:1.4;">
                                Mengelola Buku Kas, Keuangan Program &amp; Piutang (Tanpa Web CMS).
                            </div>
                        </label>
                    </div>

                    <template x-if="modal.isSelfAccount">
                        <div style="font-size:11.5px;color:#b45309;margin-top:6px;display:flex;align-items:center;gap:4px;">
                            <span class="material-icons-round" style="font-size:14px;">lock</span>
                            <span>Peran akun Anda sendiri terkunci demi menjaga integritas akses sistem.</span>
                        </div>
                    </template>
                </div>

                {{-- Password Section --}}
                <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:16px;margin-bottom:20px;">
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:12px;">
                        <span class="material-icons-round" style="font-size:18px;color:#005697;">lock</span>
                        <span style="font-weight:700;font-size:13px;color:#0F2440;"
                              x-text="modal.mode === 'add' ? 'Atur Kata Sandi Akun' : 'Ubah Kata Sandi (Opsional)'">
                        </span>
                    </div>

                    <div class="form-grid-2">
                        {{-- Password --}}
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:12.5px;color:#334155;">
                                <span x-text="modal.mode === 'add' ? 'Password *' : 'Password Baru'"></span>
                                <template x-if="modal.mode === 'add'">
                                    <span style="color:#ef4444;">*</span>
                                </template>
                            </label>
                            <div style="position:relative;">
                                <input :type="modal.showPassword ? 'text' : 'password'"
                                       class="bo-input"
                                       x-model="modal.form.password"
                                       :placeholder="modal.mode === 'add' ? 'Minimal 8 karakter' : 'Kosongkan jika tidak diubah'"
                                       style="padding-right:40px;">
                                <button type="button" @click="modal.showPassword = !modal.showPassword"
                                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:2px;">
                                    <span class="material-icons-round" style="font-size:18px;" x-text="modal.showPassword ? 'visibility_off' : 'visibility'"></span>
                                </button>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group" style="margin-bottom:10px;">
                            <label class="bo-label" style="display:block;margin-bottom:6px;font-weight:600;font-size:12.5px;color:#334155;">
                                <span x-text="modal.mode === 'add' ? 'Konfirmasi Password *' : 'Konfirmasi Password Baru'"></span>
                                <template x-if="modal.mode === 'add' || modal.form.password">
                                    <span style="color:#ef4444;">*</span>
                                </template>
                            </label>
                            <div style="position:relative;">
                                <input :type="modal.showConfirmPassword ? 'text' : 'password'"
                                       class="bo-input"
                                       x-model="modal.form.password_confirmation"
                                       placeholder="Ketik ulang password"
                                       style="padding-right:40px;">
                                <button type="button" @click="modal.showConfirmPassword = !modal.showConfirmPassword"
                                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;padding:2px;">
                                    <span class="material-icons-round" style="font-size:18px;" x-text="modal.showConfirmPassword ? 'visibility_off' : 'visibility'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Password Match Indicator --}}
                    <div style="font-size:12px;margin-top:6px;">
                        <template x-if="modal.form.password && modal.form.password.length < 8">
                            <span style="color:#ef4444;display:inline-flex;align-items:center;gap:4px;">
                                <span class="material-icons-round" style="font-size:14px;">close</span> Password harus minimal 8 karakter.
                            </span>
                        </template>
                        <template x-if="modal.form.password && modal.form.password.length >= 8 && modal.form.password_confirmation && modal.form.password !== modal.form.password_confirmation">
                            <span style="color:#ef4444;display:inline-flex;align-items:center;gap:4px;">
                                <span class="material-icons-round" style="font-size:14px;">close</span> Konfirmasi password tidak cocok.
                            </span>
                        </template>
                        <template x-if="modal.form.password && modal.form.password.length >= 8 && modal.form.password === modal.form.password_confirmation">
                            <span style="color:#16a34a;display:inline-flex;align-items:center;gap:4px;">
                                <span class="material-icons-round" style="font-size:14px;">check_circle</span> Password cocok dan aman (bcrypt hash).
                            </span>
                        </template>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;padding-top:16px;border-top:1px solid #f1f5f9;">
                    <button type="button" class="btn-secondary" @click="closeModal()" :disabled="modal.saving">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary" :disabled="modal.saving" style="display:inline-flex;align-items:center;gap:8px;">
                        <span class="material-icons-round" style="font-size:18px;" x-text="modal.saving ? 'hourglass_empty' : 'save'"></span>
                        <span x-text="modal.saving ? 'Menyimpan...' : (modal.mode === 'add' ? 'Simpan & Buat Akun' : 'Simpan Perubahan')"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CONFIRM DELETE MODAL --}}
    <div class="bo-modal-backdrop" x-show="deleteConfirm.open" x-transition style="display:none;" @keydown.escape.window="deleteConfirm.open = false">
        <div class="bo-modal" style="max-width:440px;text-align:center;padding:28px 24px;" @click.stop>
            <div style="width:58px;height:58px;border-radius:50%;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <span class="material-icons-round" style="font-size:30px;">person_remove</span>
            </div>
            <h3 style="margin:0 0 8px;font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;">Hapus Akun Pengguna?</h3>
            <p style="font-size:13.5px;color:#64748b;margin:0 0 20px;line-height:1.5;">
                Apakah Anda yakin ingin menghapus akun <strong style="color:#0f172a;" x-text="deleteConfirm.targetName"></strong> (<span x-text="'@' + deleteConfirm.targetUsername"></span>)? Pengguna ini tidak akan bisa login lagi ke backoffice.
            </p>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button type="button" class="btn-secondary" @click="deleteConfirm.open = false" :disabled="deleteConfirm.deleting">
                    Batal
                </button>
                <button type="button" class="btn-danger" @click="confirmDeleteUser()" :disabled="deleteConfirm.deleting" style="display:inline-flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:18px;">delete</span>
                    <span x-text="deleteConfirm.deleting ? 'Menghapus...' : 'Ya, Hapus Akun'"></span>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function usersManager() {
    return {
        search: '',
        filterRole: '',
        filterStatus: '',
        items: @json($userItems),

        modal: {
            open: false,
            mode: 'add',
            editId: null,
            isSelfAccount: false,
            saving: false,
            showPassword: false,
            showConfirmPassword: false,
            errorMessage: '',
            form: {
                nama: '',
                username: '',
                email: '',
                role: 'admin',
                aktif: true,
                password: '',
                password_confirmation: ''
            }
        },

        deleteConfirm: {
            open: false,
            targetId: null,
            targetName: '',
            targetUsername: '',
            deleting: false
        },

        get filtered() {
            return this.items.filter(item => {
                const matchSearch = !this.search || 
                    (item.nama || '').toLowerCase().includes(this.search.toLowerCase()) ||
                    (item.email || '').toLowerCase().includes(this.search.toLowerCase()) ||
                    (item.username || '').toLowerCase().includes(this.search.toLowerCase());

                const matchRole = !this.filterRole || item.roleKey === this.filterRole;

                const matchStatus = this.filterStatus === '' || 
                    (this.filterStatus === '1' && item.aktif) || 
                    (this.filterStatus === '0' && !item.aktif);

                return matchSearch && matchRole && matchStatus;
            });
        },

        resetFilters() {
            this.search = '';
            this.filterRole = '';
            this.filterStatus = '';
        },

        onNameInput() {
            // Suggest username automatically if in add mode and username hasn't been manually set
            if (this.modal.mode === 'add' && (!this.modal.form.username || this.modal.form.usernameAuto)) {
                this.modal.form.username = this.modal.form.nama.toLowerCase().replace(/[^a-z0-9]/g, '_').replace(/_+/g, '_').slice(0, 30);
                this.modal.form.usernameAuto = true;
            }
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.isSelfAccount = item ? item.isSelf : false;
            this.modal.errorMessage = '';
            this.modal.showPassword = false;
            this.modal.showConfirmPassword = false;
            this.modal.saving = false;

            if (mode === 'add') {
                this.modal.form = {
                    nama: '',
                    username: '',
                    usernameAuto: true,
                    email: '',
                    role: 'admin',
                    aktif: true,
                    password: '',
                    password_confirmation: ''
                };
            } else if (item) {
                this.modal.form = {
                    nama: item.nama,
                    username: item.username,
                    usernameAuto: false,
                    email: item.email,
                    role: item.roleKey,
                    aktif: item.aktif,
                    password: '',
                    password_confirmation: ''
                };
            }
            this.modal.open = true;
        },

        closeModal() {
            this.modal.open = false;
            this.modal.errorMessage = '';
        },

        saveUser() {
            this.modal.errorMessage = '';

            // Client Validation
            if (!this.modal.form.nama.trim()) {
                this.modal.errorMessage = 'Nama lengkap wajib diisi.';
                return;
            }
            if (!this.modal.form.username.trim()) {
                this.modal.errorMessage = 'Username login wajib diisi.';
                return;
            }
            if (!this.modal.form.email.trim()) {
                this.modal.errorMessage = 'Email wajib diisi.';
                return;
            }
            if (this.modal.mode === 'add') {
                if (!this.modal.form.password) {
                    this.modal.errorMessage = 'Password wajib diisi untuk akun baru.';
                    return;
                }
                if (this.modal.form.password.length < 8) {
                    this.modal.errorMessage = 'Password harus minimal 8 karakter.';
                    return;
                }
                if (this.modal.form.password !== this.modal.form.password_confirmation) {
                    this.modal.errorMessage = 'Konfirmasi password tidak cocok dengan password.';
                    return;
                }
            } else {
                // Edit mode
                if (this.modal.form.password) {
                    if (this.modal.form.password.length < 8) {
                        this.modal.errorMessage = 'Password baru harus minimal 8 karakter.';
                        return;
                    }
                    if (this.modal.form.password !== this.modal.form.password_confirmation) {
                        this.modal.errorMessage = 'Konfirmasi password baru tidak cocok.';
                        return;
                    }
                }
            }

            this.modal.saving = true;

            const fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}');
            fd.append('name', this.modal.form.nama.trim());
            fd.append('username', this.modal.form.username.trim());
            fd.append('email', this.modal.form.email.trim());
            fd.append('role', this.modal.form.role);
            fd.append('is_active', this.modal.form.aktif ? '1' : '0');

            if (this.modal.form.password) {
                fd.append('password', this.modal.form.password);
            }

            const url = this.modal.mode === 'add'
                ? '/backoffice/users/store'
                : `/backoffice/users/${this.modal.editId}/update`;

            fetch(url, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: fd
            })
            .then(async response => {
                const data = await response.json().catch(() => null);
                if (!response.ok) {
                    const msg = (data && data.message) ? data.message : (data && data.error) ? data.error : 'Gagal menyimpan data pengguna. Silakan periksa kembali formulir.';
                    throw new Error(msg);
                }
                return data;
            })
            .then(() => {
                location.reload();
            })
            .catch(err => {
                this.modal.saving = false;
                this.modal.errorMessage = err.message || 'Terjadi kesalahan sistem.';
            });
        },

        toggleAktif(item) {
            if (item.isSelf) {
                alert('Anda tidak dapat menonaktifkan akun sendiri.');
                return;
            }
            const nextStatus = !item.aktif;
            fetch(`/backoffice/users/${item.id}/update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_active: nextStatus ? 1 : 0 })
            })
            .then(async res => {
                const data = await res.json().catch(() => null);
                if (!res.ok) {
                    throw new Error(data?.message || 'Gagal mengubah status akun.');
                }
                item.aktif = nextStatus;
            })
            .catch(err => {
                alert(err.message || 'Gagal mengubah status akun.');
            });
        },

        openDeleteModal(item) {
            if (item.isSelf) {
                alert('Anda tidak dapat menghapus akun yang sedang digunakan untuk login.');
                return;
            }
            this.deleteConfirm.targetId = item.id;
            this.deleteConfirm.targetName = item.nama;
            this.deleteConfirm.targetUsername = item.username;
            this.deleteConfirm.deleting = false;
            this.deleteConfirm.open = true;
        },

        confirmDeleteUser() {
            if (!this.deleteConfirm.targetId) return;
            this.deleteConfirm.deleting = true;

            fetch(`/backoffice/users/${this.deleteConfirm.targetId}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: this.deleteConfirm.targetId })
            })
            .then(async res => {
                const data = await res.json().catch(() => null);
                if (!res.ok) {
                    throw new Error(data?.message || 'Gagal menghapus pengguna.');
                }
                location.reload();
            })
            .catch(err => {
                this.deleteConfirm.deleting = false;
                alert(err.message || 'Gagal menghapus pengguna.');
            });
        }
    };
}
</script>
@endpush
