<?php

namespace App\Http\Controllers;

use App\Models\HomepageSection;
use App\Models\NewsArticle;
use App\Models\ProgramCategory;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Statistic;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Registration;
use App\Models\FooterSetting;
use App\Models\BrandingSetting;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    /**
     * Shared data for all frontend views.
     */
    private function shared()
    {
        $footerSettings = FooterSetting::pluck('setting_value', 'setting_key')->toArray();
        $branding = BrandingSetting::pluck('setting_value', 'setting_key')->toArray();
        $siteName = $footerSettings['site_name'] ?? 'Denpasar Hotel School';
        $tagline = $footerSettings['tagline'] ?? '"Transforming Into Excellent"';
        $navLogo = $branding['logo_primary'] ?? '/image/LogoDHS.png';

        return compact('footerSettings', 'branding', 'siteName', 'tagline', 'navLogo');
    }

    public function welcome()
    {
        $sections = HomepageSection::orderBy('display_order')
            ->get()
            ->keyBy('section_key');

        $featuredNews = NewsArticle::where('status', 'dipublikasikan')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        $featuredPrograms = Program::with('category')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->orderBy('display_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('is_active', 1)
            ->where('is_featured', 1)
            ->orderBy('display_order')
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $stats = Statistic::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $galleries = Gallery::where('is_active', 1)
            ->orderBy('display_order')
            ->take(8)
            ->get();

        $programCategories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $shared = $this->shared();

        return view('welcome', array_merge($shared, compact(
            'sections', 'featuredNews', 'featuredPrograms',
            'testimonials', 'partners', 'stats', 'galleries',
            'programCategories'
        )));
    }

    public function tentang()
    {
        $sections = AboutPage::where('is_active', 1)
            ->orderBy('display_order')
            ->get()
            ->keyBy('section_key');

        $stats = Statistic::where('is_active', 1)->orderBy('display_order')->get();

        $galleries = Gallery::where('is_active', 1)
            ->orderBy('display_order')
            ->take(12)
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $shared = $this->shared();

        return view('tentang', array_merge($shared, compact('sections', 'stats', 'galleries', 'partners')));
    }

    public function akademi()
    {
        $categories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $partners = Partner::where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        // Academy hero data from about_pages
        $academyHeroRecord = AboutPage::where('section_key', 'academy_hero')->first();
        $academyHero = $academyHeroRecord
            ? (is_array($academyHeroRecord->section_content) ? $academyHeroRecord->section_content : json_decode($academyHeroRecord->section_content ?? '[]', true) ?? [])
            : [];

        $shared = $this->shared();

        return view('akademi', array_merge($shared, compact('categories', 'partners', 'academyHero')));
    }

    public function detailBerita($slug)
    {
        $article = NewsArticle::where('slug', $slug)
            ->where('status', 'dipublikasikan')
            ->with('author')
            ->firstOrFail();

        // Session-based: only increment once per visitor per article
        $sessionKey = 'viewed_article_' . $article->id;
        if (!session()->has($sessionKey)) {
            $article->increment('views_count');
            session()->put($sessionKey, true);
        }

        $related = NewsArticle::where('status', 'dipublikasikan')
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $shared = $this->shared();

        return view('detail-berita', array_merge($shared, compact('article', 'related')));
    }

    /**
     * AJAX endpoint: return current views_count for an article.
     */
    public function getArticleViews($slug)
    {
        $article = NewsArticle::where('slug', $slug)
            ->select('views_count')
            ->first();

        if (!$article) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json(['views_count' => $article->views_count]);
    }

    public function berita(Request $request)
    {
        $query = NewsArticle::where('status', 'dipublikasikan')
            ->orderBy('published_at', 'desc');

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = addcslashes($request->q, '%_');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('excerpt', 'like', "%$search%");
            });
        }

        $articles = $query->paginate(9);
        $featured = NewsArticle::where('status', 'dipublikasikan')
            ->where('is_featured', 1)
            ->orderBy('published_at', 'desc')
            ->first();

        $shared = $this->shared();

        return view('berita', array_merge($shared, compact('articles', 'featured')));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', 1)
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        $shared = $this->shared();

        return view('faq', array_merge($shared, compact('faqs')));
    }

    public function karier()
    {
        $partners = Partner::where('is_active', 1)
            ->orderBy('type')
            ->orderBy('display_order')
            ->get()
            ->groupBy('type');

        $shared = $this->shared();

        return view('karier', array_merge($shared, compact('partners')));
    }

    public function registration()
    {
        $categories = ProgramCategory::with('programs')
            ->where('is_active', 1)
            ->orderBy('display_order')
            ->get();

        $helpdesk = FooterSetting::whereIn('setting_key', ['helpdesk_wa', 'helpdesk_email', 'helpdesk_hours'])
            ->pluck('setting_value', 'setting_key')
            ->toArray();

        $shared = $this->shared();

        return view('registration', array_merge($shared, compact('categories', 'helpdesk')));
    }

    public function submitRegistration(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'hp_wa'             => 'required|string|max:50',
            'email'             => 'required|email|max:255',
            'kategori'          => 'required|string',
            'program'           => 'required|string',
            'special_request'   => 'nullable|string',
            'bukti_pendaftaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_program'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sumber_info'       => 'nullable|array',
        ]);

        $buktiPendaftaranPath = null;
        if ($request->hasFile('bukti_pendaftaran')) {
            $file = $request->file('bukti_pendaftaran');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti'), $name);
            $buktiPendaftaranPath = '/uploads/bukti/' . $name;
        }

        $buktiProgramPath = null;
        if ($request->hasFile('bukti_program')) {
            $file = $request->file('bukti_program');
            $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti'), $name);
            $buktiProgramPath = '/uploads/bukti/' . $name;
        }

        Registration::create([
            'full_name'              => $validated['nama_lengkap'],
            'phone'                  => $validated['hp_wa'],
            'email'                  => $validated['email'],
            'category_key'           => $validated['kategori'],
            'program_title'          => $validated['program'],
            'special_request'        => $validated['special_request'] ?? null,
            'registration_fee_proof' => $buktiPendaftaranPath,
            'program_fee_proof'      => $buktiProgramPath,
            'info_sources'           => $request->input('sumber_info', []),
            'status'                 => 'pending',
            'registration_date'      => now()->toDateString(),
        ]);

        return back()->with('reg_success', 'Terima kasih ' . $validated['nama_lengkap'] . '! Pendaftaran Anda telah kami terima. Tim admisi DHS akan menghubungi WhatsApp Anda dalam 1x24 jam.');
    }
}
