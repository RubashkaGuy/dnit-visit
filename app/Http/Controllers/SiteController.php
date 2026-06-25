<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Advantage;
use App\Models\ContactRequest;
use App\Models\HeroBlock;
use App\Models\License;
use App\Models\NavLink;
use App\Models\News;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\SiteSetting;
use App\Models\TrustItem;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'settings' => SiteSetting::current(),
            'hero' => HeroBlock::current(),
            'navLinks' => NavLink::where('is_active', true)->orderBy('sort')->get(),
            'trustItems' => TrustItem::orderBy('sort')->get(),
            'services' => Service::orderBy('sort')->get(),
            'advantages' => Advantage::orderBy('sort')->get(),
            'about' => AboutSection::current(),
            'licenses' => License::orderBy('sort')->get(),
            'news' => News::where('is_published', true)->orderByDesc('published_at')->orderByDesc('id')->limit(6)->get(),
            'serviceOptions' => ServiceOption::orderBy('sort')->get(),
            'sent' => session('contact_sent', false),
        ]);
    }

    public function newsIndex()
    {
        return view('site.news-index', [
            'settings' => SiteSetting::current(),
            'navLinks' => NavLink::where('is_active', true)->orderBy('sort')->get(),
            'news' => News::where('is_published', true)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->paginate(9),
        ]);
    }

    public function newsShow(string $slug)
    {
        $item = News::where('slug', $slug)->where('is_published', true)->firstOrFail();

        $related = News::where('is_published', true)
            ->where('id', '!=', $item->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        return view('site.news-show', [
            'settings' => SiteSetting::current(),
            'navLinks' => NavLink::where('is_active', true)->orderBy('sort')->get(),
            'item' => $item,
            'related' => $related,
        ]);
    }

    public function storeContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'service' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        ContactRequest::create($data);

        return redirect()->to(url('/') . '#zayavka')->with('contact_sent', true);
    }
}
