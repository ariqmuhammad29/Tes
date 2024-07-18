<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:blog posts read');
        $this->middleware('permission:blog posts create')->only('create', 'store');
        $this->middleware('permission:blog posts update')->only('edit', 'update');
        $this->middleware('permission:blog posts delete')->only('destroy');

        view()->share('menuActive', 'blog');
        view()->share('subMenuActive', 'blog-posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request, Post $blog_post)
    {
        if ($request->has('name') != "") {
            $blog_post = $blog_post->where('title', 'like', '%' . $request->get('name') . '%');
        }
        if ($request->get('shortBy') != "") {
            // dd($request->get('shortBy'));

            if ($request->get('shortBy') == "Post A-Z") {
                $blog_post = $blog_post->orderBy('title', 'asc');
            }
            if ($request->get('shortBy') == "Post Z-A") {
                $blog_post = $blog_post->orderBy('title', 'desc');
            }
            if ($request->get('shortBy') == "Post Awal") {
                $blog_post = $blog_post->find(1);
            }
        }

        //$data['models'] = Post::orderBy('id', 'desc')->paginate(10);
        //$data['models'] = $blog_post->paginate(10)->withQueryString();
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin')) {
            $data['models'] = $blog_post->paginate(10)->withQueryString();
        } else {
            $data['models'] = $blog_post->where('user_id', auth()->user()->id)->paginate(10)->withQueryString();
        }
        return view('admin.blog.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.blog.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'required|image',
            'published_at' => ['required', 'date']
        ]);

        $post = new Post($request->all());

        $image = $post->uploadImage($request->file('image'), 'ugc/blog');
        $post->image = $image->lg;

        $post->save();

        return redirect()
            ->route('admin.blog.posts.index')
            ->with(['status' => 'success', 'message' => 'Save Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['categories'] = Category::all();
        $data['model'] = $post;
        return view('admin.blog.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'image' => 'image',
            'published_at' => ['required', 'date']
        ]);

        if ($request->hasFile('image')) {
            $newImage = $post->uploadImage($request->file('image'), 'ugc/blog');

            $payload = $request->all();

            if ($newImage) {
                $payload['image'] = $newImage->lg;

                $post->deleteImage();
            }

            $post->update($payload);
        } else {
            $post->update($request->all());
        }

        return redirect()->route('admin.blog.posts.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $image = new Post();

        if (Storage::exists($post->image->path)) {
            $image->deleteImage($post->image->path);
        }

        if ($post->delete()) {
            return redirect()->route('admin.blog.posts.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.blog.posts.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
