<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product_image;
use Illuminate\Support\Facades\Storage;

class ProductImagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:product categories read');
        $this->middleware('permission:product categories create')->only('create', 'store');
        $this->middleware('permission:product categories update')->only('edit', 'update');
        $this->middleware('permission:product categories delete')->only('destroy');

        view()->share('menuActive', 'product');
        view()->share('subMenuActive', 'product-post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Product_image::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.images.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.images.create');
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
            'product_id'  => 'required',
            'image'         => 'required|image'
        ]);

        $path = $request->file('image')->store('product');

        $productimages = new Product_image($request->only('product_id') + ['image' => $path]);
        $productimages->save();

        return redirect()
            ->route('admin.product.images.index')
            ->with([
                'message' => 'Save Successfully'
            ]);
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
     * @param  ProductImages  $productimages
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImages $productimages)
    {
        return view('admin.product.images.edit', ['model' => $productimages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ProductImages  $productimages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImages $productimages)
    {
        $request->validate([
            'product_id'  => 'required',
            'image'         => 'required|image'
        ]);

        if ($request->hasFile('image')) {

            if (Storage::exists($productimages->image)) {
                Storage::delete($productimages->image);
            }

            $path = $request->file('image')->store('product');
            $update = $productimages->update($request->only('product_id') + ['image' => $path]);
        } else {
            $update = $productimages->update($request->only('product_id'));
        }

        return redirect()->route('admin.product.images.edit', $productimages->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProductImages $productimages
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ProductImages $productimages)
    {
        if ($productimages->delete()) {
            return redirect()->route('admin.product.images.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.product.images.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
