<?php

namespace App\Http\Controllers;

use App\Support\Insights;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InsightsController extends Controller
{
    public function index(Request $request, Insights $insights): View
    {
        $category = $request->query('category');

        return view('pages.insights.index', [
            'pageLabel' => 'Insights',
            'featured' => $insights->featured(1)->first(),
            'articles' => $insights->all($category),
            'categories' => $insights->categories(),
            'category' => $category,
        ]);
    }

    public function show(string $slug, Insights $insights): View
    {
        $article = $insights->find($slug);

        abort_unless($article, 404);

        return view('pages.insights.show', [
            'pageLabel' => 'Insights',
            'article' => $article,
            'related' => $insights->related($article, 3),
        ]);
    }
}
