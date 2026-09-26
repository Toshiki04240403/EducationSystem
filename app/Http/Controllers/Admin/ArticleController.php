<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function showArticleList() {
        $articles = Article::orderBy('posted_date', 'desc')->get();
        return view('admin.article_list', compact('articles'));
    }

    public function destroyArticle($id) {
        $article = Article::findorFail($id);
        $article->delete();
        return redirect()->back();
    }
    
    public function showArticleCreate() {
        return view('admin.article_create');
    }
}
