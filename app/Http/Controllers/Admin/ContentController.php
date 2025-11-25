<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advantage;
use App\Models\Article;
use App\Models\Faq;
use App\Models\LandingContent;
use App\Models\LandingMentor;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        $hero = LandingContent::where('key', 'like', 'hero_%')->pluck('value', 'key');
        $articles = Article::latest()->get();
        $advantages = Advantage::all();
        $testimonials = Testimonial::all();
        $mentors = LandingMentor::all();
        $faqs = Faq::all();

        return view('admin.content.index', compact('hero', 'articles', 'advantages', 'testimonials', 'mentors', 'faqs'));
    }

    public function updateHero(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'required|string',
            'hero_description' => 'required|string',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        LandingContent::updateOrCreate(['key' => 'hero_title'], ['value' => $data['hero_title']]);
        LandingContent::updateOrCreate(['key' => 'hero_description'], ['value' => $data['hero_description']]);

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('landing', 'public');
            LandingContent::updateOrCreate(['key' => 'hero_image'], ['value' => $path, 'type' => 'image']);
        }

        return redirect()->route('admin.content.index')->with('success', 'Hero section updated successfully.');
    }

    // Articles
    public function storeArticle(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);
        return redirect()->route('admin.content.index')->with('success', 'Article created successfully.');
    }

    public function updateArticle(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);
        return redirect()->route('admin.content.index')->with('success', 'Article updated successfully.');
    }

    public function destroyArticle(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.content.index')->with('success', 'Article deleted successfully.');
    }

    // Advantages
    public function storeAdvantage(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        Advantage::create($data);
        return redirect()->route('admin.content.index')->with('success', 'Advantage created successfully.');
    }

    public function updateAdvantage(Request $request, Advantage $advantage)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $advantage->update($data);
        return redirect()->route('admin.content.index')->with('success', 'Advantage updated successfully.');
    }

    public function destroyAdvantage(Advantage $advantage)
    {
        $advantage->delete();
        return redirect()->route('admin.content.index')->with('success', 'Advantage deleted successfully.');
    }

    // Testimonials
    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'badge' => 'nullable|string',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.content.index')->with('success', 'Testimonial created successfully.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'badge' => 'nullable|string',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.content.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.content.index')->with('success', 'Testimonial deleted successfully.');
    }

    // Mentors
    public function storeMentor(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'quote' => 'nullable|string',
            'experience' => 'nullable|string',
            'students_count' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('mentors', 'public');
        }

        LandingMentor::create($data);
        return redirect()->route('admin.content.index')->with('success', 'Mentor created successfully.');
    }

    public function updateMentor(Request $request, LandingMentor $mentor)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'quote' => 'nullable|string',
            'experience' => 'nullable|string',
            'students_count' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('mentors', 'public');
        }

        $mentor->update($data);
        return redirect()->route('admin.content.index')->with('success', 'Mentor updated successfully.');
    }

    public function destroyMentor(LandingMentor $mentor)
    {
        $mentor->delete();
        return redirect()->route('admin.content.index')->with('success', 'Mentor deleted successfully.');
    }

    // FAQs
    public function storeFaq(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create($data);
        return redirect()->route('admin.content.index')->with('success', 'FAQ created successfully.');
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($data);
        return redirect()->route('admin.content.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroyFaq(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.content.index')->with('success', 'FAQ deleted successfully.');
    }
}
