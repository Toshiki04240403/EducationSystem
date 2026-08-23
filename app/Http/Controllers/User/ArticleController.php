<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
  public function showArticle($id) {
    $article = Article::find($id);

    return view('user.article', compact('article'));
  }
}
