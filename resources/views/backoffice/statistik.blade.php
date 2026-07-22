@extends('backoffice.layouts.app')
@section('title', 'Editor About Us')
@section('page-title', 'Editor Lengkap Halaman About Us')

@section('content')
<div x-data="aboutUsCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh perubahan Halaman About Us berhasil disimpan (demo).
    </div>

    {{-- Tabs --}}
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="tab in tabs" :key="tab.id">
            <button type="button" @click="activeTab = tab.id"
                :class="activeTab === tab.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 14px;font-size:12.5px;white-space:nowrap;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:16px;" x-text="tab.icon"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </div>

    {{-- TAB 1: HERO --}}
    <div x-show="activeTab === 'hero'">
        <div class="bo-card" style="max-width:750px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. Hero Banner About Us</h2>
            <div class="form-group">
                <label class="bo-label">Judul Utama H1</label>
                <input type="text" class="bo-input" x-model="hero.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Sub-label / Category</label>
                <input type="text" class="bo-input" x-model="hero.subtitle">
            </div>
            <div class="form-group">
                <label class="bo-label">URL Gambar Banner</label>
                <input type="text" class="bo-input" x-model="hero.bgImage">
            </div>
        </div>
    </div>

    {{-- TAB 2: TAGLINE / INTRO --}}
    <div x-show="activeTab === 'intro'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">2. Tagline & Intro</h2>
            <div class="form-group">
                <label class="bo-label">Label Overline</label>
                <input type="text" class="bo-input" x-model="intro.label">
            </div>
            <div class="form-group">
                <label class="bo-label">Judul Tagline (H2)</label>
                <input type="text" class="bo-input" x-model="intro.headline">
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 1</label>
                <textarea class="bo-textarea" rows="3" x-model="intro.p1"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 2</label>
                <textarea class="bo-textarea" rows="3" x-model="intro.p2"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Teks Kutipan Samping (Quote)</label>
                <textarea class="bo-textarea" rows="2" x-model="intro.quote"></textarea>
            </div>
        </div>
    </div>

    {{-- TAB 3: VISI MISI CORE VALUES --}}
    <div x-show="activeTab === 'vision'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Visi</h2>
                    <textarea class="bo-textarea" rows="3" x-model="vision.visi"></textarea>
                </div>
                <div class="bo-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">Misi</h2>
                        <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="vision.misi.push('')">
                            <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Item
                        </button>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <template x-for="(m, idx) in vision.misi" :key="idx">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <input type="text" class="bo-input" x-model="vision.misi[idx]">
                                <button class="btn-icon danger" style="width:30px;height:30px;" @click="vision.misi.splice(idx,1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Core Values</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <template x-for="(val, idx) in vision.coreValues" :key="idx">
                        <div style="padding:12px;background:#fafafa;border-radius:10px;border:1.5px solid #eee;">
                            <input type="text" class="bo-input" style="padding:6px;font-weight:700;margin-bottom:6px;" x-model="val.title">
                            <textarea class="bo-textarea" style="min-height:50px;padding:6px;" x-model="val.desc"></textarea>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 4: TIMELINE SEJARAH --}}
    <div x-show="activeTab === 'timeline'">
        <div class="bo-card" style="max-width:850px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">4. Sejarah & Milestone Timeline</h2>
                <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="timeline.push({year:'', title:'', desc:''})">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Milestone
                </button>
            </div>

            <div style="display:flex;flex-direction:column;gap:14px;">
                <template x-for="(item, idx) in timeline" :key="idx">
                    <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div style="display:flex;gap:12px;margin-bottom:8px;">
                            <input type="text" class="bo-input" style="width:100px;font-weight:700;padding:6px;" x-model="item.year" placeholder="Tahun">
                            <input type="text" class="bo-input" style="flex:1;font-weight:700;padding:6px;" x-model="item.title" placeholder="Judul Milestone">
                            <button class="btn-icon danger" style="width:32px;height:32px;" @click="timeline.splice(idx,1)">
                                <span class="material-icons-round" style="font-size:16px;">delete</span>
                            </button>
                        </div>
                        <textarea class="bo-textarea" style="min-height:50px;padding:6px;" x-model="item.desc" placeholder="Deskripsi milestone..."></textarea>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 5: PESAN DIREKTUR & KEPEMIMPINAN --}}
    <div x-show="activeTab === 'leadership'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Kata Sambutan Direktur</h2>
                <div class="form-group">
                    <label class="bo-label">Paragraf 1</label>
                    <textarea class="bo-textarea" rows="3" x-model="director.p1"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Paragraf 2</label>
                    <textarea class="bo-textarea" rows="3" x-model="director.p2"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">URL Foto Direktur</label>
                    <input type="text" class="bo-input" x-model="director.photo">
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Profil Tim Kepemimpinan</h2>
                <div class="form-group">
                    <label class="bo-label">Nama Lengkap & Gelar</label>
                    <input type="text" class="bo-input" x-model="leader.name">
                </div>
                <div class="form-group">
                    <label class="bo-label">Jabatan</label>
                    <input type="text" class="bo-input" x-model="leader.title">
                </div>
                <div class="form-group">
                    <label class="bo-label">Bio / Deskripsi Singkat</label>
                    <textarea class="bo-textarea" rows="3" x-model="leader.bio"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">URL Foto Profil</label>
                    <input type="text" class="bo-input" x-model="leader.photo">
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 6: BOTTOM CTA --}}
    <div x-show="activeTab === 'cta'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">6. CTA Bottom Banner</h2>
            <div class="form-group">
                <label class="bo-label">Judul Banner H2</label>
                <input type="text" class="bo-input" x-model="cta.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Deskripsi Banner</label>
                <textarea class="bo-textarea" rows="3" x-model="cta.desc"></textarea>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="bo-label">Tombol 1 Teks</label>
                    <input type="text" class="bo-input" x-model="cta.btn1Text">
                </div>
                <div class="form-group">
                    <label class="bo-label">Tombol 2 Teks</label>
                    <input type="text" class="bo-input" x-model="cta.btn2Text">
                </div>
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Perubahan Halaman About Us
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function aboutUsCompleteData() {
    return {
        saved: false,
        activeTab: 'hero',
        tabs: [
            { id:'hero',       label:'1. Hero Banner',   icon:'wallpaper' },
            { id:'intro',      label:'2. Tagline & Intro', icon:'auto_stories' },
            { id:'vision',     label:'3. Visi & Misi & Values', icon:'stars' },
            { id:'timeline',   label:'4. Sejarah Timeline', icon:'timeline' },
            { id:'leadership', label:'5. Pesan & Leadership', icon:'record_voice_over' },
            { id:'cta',        label:'6. Bottom CTA', icon:'call_to_action' },
        ],
        hero: {
            title: 'Membangun Pemimpin Hospitality Masa Depan',
            subtitle: 'INSTITUSI & WARISAN',
            bgImage: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg'
        },
        intro: {
            label: 'TENTANG DHS',
            headline: 'Transforming Into Excellent',
            p1: 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.',
            p2: 'Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.',
            quote: '"Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."'
        },
        vision: {
            visi: 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.',
            misi: [
                'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
                'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
                'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'
            ],
            coreValues: [
                { title: 'Integritas (Integrity)', desc: 'DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.' },
                { title: 'Tanggung Jawab (Responsibility)', desc: 'DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.' },
                { title: 'Kualitas (Quality)', desc: 'DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.' }
            ]
        },
        timeline: [
            { year: '2005', title: 'DHS Berdiri', desc: 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali.' },
            { year: '2009', title: 'Akreditasi Nasional', desc: 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan.' },
            { year: '2013', title: 'Gedung Training Center Baru', desc: 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant.' },
            { year: '2017', title: 'MoU dengan Marriott International', desc: 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung.' },
            { year: '2022', title: 'Program Internasional', desc: 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura.' },
            { year: '2024', title: 'DHS Hari Ini', desc: '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara.' }
        ],
        director: {
            p1: '"Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten."',
            p2: '"Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global."',
            photo: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ'
        },
        leader: {
            name: 'I Made Dwija Suastana, S.H., M.H.',
            title: 'Direktur Denpasar Hotel School',
            bio: 'Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.',
            photo: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ'
        },
        cta: {
            title: 'Jadilah Bagian dari Keluarga DHS',
            desc: 'Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.',
            btn1Text: 'Jelajahi Program',
            btn2Text: 'Daftar Sekarang'
        },
        saveAll() {
            this.saved = true;
            setTimeout(() => this.saved = false, 3500);
        }
    };
}
</script>
@endpush
