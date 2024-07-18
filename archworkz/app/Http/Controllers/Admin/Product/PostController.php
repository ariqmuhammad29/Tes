<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product_image;
use App\Models\Product\PostProduct;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:product posts read');
        $this->middleware('permission:product posts create')->only('create', 'store');
        $this->middleware('permission:product posts update')->only('edit', 'update');
        $this->middleware('permission:product posts delete')->only('destroy');

        view()->share('menuActive', 'product');
        view()->share('subMenuActive', 'product-posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request, PostProduct $postProduct)
    {
        if ($request->has('name') != "") {
            $postProduct = $postProduct->where('title', 'like', '%' . $request->get('name') . '%');
        }
        if ($request->get('shortBy') != "") {
            // dd($request->get('shortBy'));

            if ($request->get('shortBy') == "Post A-Z") {
                $postProduct = $postProduct->orderBy('title', 'asc');
            }
            if ($request->get('shortBy') == "Post Z-A") {
                $postProduct = $postProduct->orderBy('title', 'desc');
            }
            if ($request->get('shortBy') == "Post Awal") {
                $postProduct = $postProduct->find(1);
            }
        }

        //$data['models'] = Post::orderBy('id', 'desc')->paginate(10);
        //$data['models'] = $postProduct->paginate(10)->withQueryString();
        $data['models'] = $postProduct->paginate(10)->withQueryString();
        //$data['models'] = PostProduct::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.posts.create');
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
            'title'         => 'required|max:200',
            'project_name'         => 'required|max:200',
            'designer'         => 'required|max:200',
            'location'         => 'required|max:200',
            'description'   => 'required',
            'status'    => 'required',
            'image' => 'required'
        ]);


        $post = new PostProduct($request->except('image'));
        $post->user_id = auth()->guard('web')->user()->id;
        if ($post->save()) {
            if ($request->hasFile('image')) {
                foreach ($request->image as $key => $value) {

                    $image                  = new Product_image();
                    $imagex = $image->uploadImage($value, 'ugc/product');
                    $image->product_id    = $post->id;
                    $image->image           = $imagex->lg;
                    $image->save();

                    if ($key == 0) {
                        $post->image = $imagex->lg;
                        $post->save();
                    }
                }
            }
        }

        return redirect()
            ->route('admin.Our-Works.posts.index')
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
    public function edit(PostProduct $post)
    {
        $data['model'] = $post;


        return view('admin.product.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostProduct $post)
    {
        $request->validate([
            'title'         => 'required|max:200',
            'project_name'         => 'required|max:200',
            'designer'         => 'required|max:200',
            'location'         => 'required|max:200',
            'description'   => 'required'
        ]);

        //echo json_encode($request->all()); exit();

        // cek gambar yg sekrang
        $recentImage  = Product_image::where('product_id', $post->id)->get();

        // gambar Update
        foreach ($recentImage as $key => $result) {
            // cek jika gambar diganti
            if ($request->file('image-' . $result->id)) {
                $newImage = $result->uploadImage($request->file('image-' . $result->id), 'ugc/product');

                if ($newImage) {
                    $result->deleteImage();
                }
                $result->update(['product_id' => $post->id, 'image' => $newImage->lg]);
            }
            // gambar dihapus
            elseif (!$request->input('isimage-' . $result->id) and !$request->input('old-' . $result->id)) {
                $result->deleteImage();  // hapus gambar di storage
                $result->delete(); // hapus data
            }
        }

        // image baru
        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $value) {
                if ($value) {
                    $image                 = new Product_image();
                    $imagex = $image->uploadImage($value, 'ugc/product');
                    $image->product_id    = $post->id;
                    $image->image           = $imagex->lg;
                    $image->save();
                }
            }
        }

        $post->update($request->all());

        return redirect()->route('admin.Our-Works.posts.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PostProduct $post)
    {
        foreach ($post->images as $key => $value) {
            $value->deleteImage();
            $value->delete(); // hapus data
        }

        if ($post->delete()) {
            return redirect()->route('admin.Our-Works.posts.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }

        return redirect()->route('admin.Our-Works.posts.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
