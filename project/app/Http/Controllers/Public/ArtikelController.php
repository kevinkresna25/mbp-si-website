<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::published()
            ->with(['category', 'author'])
            ->when($request->kategori, function ($query, $slug) {
                $query->whereHas('category', fn($q) => $q->where('slug', $slug));
            })
            ->when($request->search, fn($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        $categories = ArticleCategory::withCount(['articles' => fn($q) => $q->published()])
            ->orderBy('name')
            ->get();

        return view('public.artikel.index', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::published()
            ->with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.artikel.show', compact('article', 'relatedArticles'));
    }
}
