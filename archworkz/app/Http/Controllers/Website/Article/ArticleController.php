<?php

namespace App\Http\Controllers\Website\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        View::share('recentPosts', Post::latest()->limit(3)->get());
        View()->share('menu', 'Article');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['article']    = Post::orderBy('id', 'desc')->paginate(10);
        return view('website.article.index', $data);
    }

    public function category($slug)
    {
        $data['kategori']   = Category::where('slug', $slug)->first();
        $data['article']    = Post::where('blog_category_id', $data['kategori']->id)->paginate(8);
        return view('website.article.index', $data);
    }

    public function search(Request $request)
    {
        $data['kategori']   = '"%$request->cari%"';
        $data['article']    = Post::where('slug', 'like', "%$request->cari%")->latest()->paginate(10);
        return view('website.article.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['model'] = Post::where('slug', $slug)->first();
        return view('website.article.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
