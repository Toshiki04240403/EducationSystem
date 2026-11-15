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

        public function storeArticle(Request $request)
        {

            $request->validate([
                'posted_date' => 'required',
                'title' => 'required|max:255',
                'article_contents' => 'required',
            ]);

            Article::create([
                'posted_date' => $request->input('posted_date'),
                'title' => $request->input('title'),
                'article_contents' => $request->input('article_contents'),
            ]);

            return redirect()->route('admin.show.article.list')->with('success', 'お知らせを登録しました。');
        }

    public function showArticleEdit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.article_create', compact('article')); 
    }

    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'posted_date'      => 'required',
            'title'            => 'required|max:255',
            'article_contents' => 'required',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'posted_date'      => $request->input('posted_date'),
            'title'            => $request->input('title'),
            'article_contents' => $request->input('article_contents'),
        ]);

        return redirect()->route('admin.show.article.list')->with('success', 'お知らせを更新しました。');
    }
}
