<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\SchoolProfile;
use App\Models\Page;
use App\Models\Post;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Document;
use App\Models\Facility;
use App\Models\Achievement;
use App\Models\Extracurricular;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected function getSharedData()
    {
        return [
            'schoolProfile' => SchoolProfile::first() ?? new SchoolProfile([
                'name' => 'Madrasah',
                'npsn' => '-',
                'phone' => '-',
                'email' => '-',
                'address' => '-',
                'accreditation' => '-',
                'headmaster' => '-',
            ]),
        ];
    }

    public function home()
    {
        $data = array_merge($this->getSharedData(), [
            'posts' => Post::where('status', 'published')->latest('published_at')->take(3)->get(),
            'announcements' => Announcement::where('is_active', true)->latest()->take(3)->get(),
            'events' => Event::where('status', 'published')->take(3)->get(),
            'achievements' => Achievement::where('is_published', true)->latest()->take(4)->get(),
        ]);

        return view('public.home', $data);
    }

    public function profile()
    {
        $data = array_merge($this->getSharedData(), [
            'pages' => Page::where('status', 'published')->orderBy('sort_order')->get(),
        ]);

        return view('public.profile', $data);
    }

    public function posts()
    {
        $data = array_merge($this->getSharedData(), [
            'posts' => Post::where('status', 'published')->latest('published_at')->paginate(9),
        ]);

        return view('public.posts', $data);
    }

    public function postDetail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $data = array_merge($this->getSharedData(), [
            'post' => $post,
            'recentPosts' => Post::where('status', 'published')->where('id', '!=', $post->id)->latest('published_at')->take(3)->get(),
        ]);

        return view('public.post-detail', $data);
    }

    public function announcements()
    {
        $data = array_merge($this->getSharedData(), [
            'announcements' => Announcement::where('is_active', true)->latest()->paginate(10),
        ]);

        return view('public.announcements', $data);
    }

    public function events()
    {
        $data = array_merge($this->getSharedData(), [
            'events' => Event::where('status', 'published')->orderBy('start_at')->paginate(10),
        ]);

        return view('public.events', $data);
    }

    public function galleries()
    {
        $data = array_merge($this->getSharedData(), [
            'galleries' => Gallery::with('items')->where('is_published', true)->latest()->paginate(9),
        ]);

        return view('public.galleries', $data);
    }

    public function documents()
    {
        $data = array_merge($this->getSharedData(), [
            'documents' => Document::where('is_published', true)->latest()->paginate(10),
        ]);

        return view('public.documents', $data);
    }

    public function facilities()
    {
        $data = array_merge($this->getSharedData(), [
            'facilities' => Facility::all(),
        ]);

        return view('public.facilities', $data);
    }

    public function achievements()
    {
        $data = array_merge($this->getSharedData(), [
            'achievements' => Achievement::where('is_published', true)->latest()->paginate(12),
        ]);

        return view('public.achievements', $data);
    }

    public function extracurriculars()
    {
        $data = array_merge($this->getSharedData(), [
            'extracurriculars' => Extracurricular::all(),
        ]);

        return view('public.extracurriculars', $data);
    }

    public function contact()
    {
        return view('public.contact', $this->getSharedData());
    }
}
