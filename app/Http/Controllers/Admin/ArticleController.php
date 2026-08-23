<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function showArticleList() {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.article_list', compact('articles'));
    }
    
    public function showArticleCreate() {
        return view('admin.article_create');
    }
}
