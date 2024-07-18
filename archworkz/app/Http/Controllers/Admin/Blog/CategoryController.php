<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:blog categories read');
        $this->middleware('permission:blog categories create')->only('create', 'store');
        $this->middleware('permission:blog categories update')->only('edit', 'update');
        $this->middleware('permission:blog categories delete')->only('destroy');

        view()->share('menuActive', 'blog');
        view()->share('subMenuActive', 'blog-categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if ($request->has('category') != "") {
            $data['models'] = category::where('name', 'like', $request->get('category'))->paginate(5);
        } else {
            $data['models'] = Category::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.blog.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.categories.create');
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
            'name' => 'required|max:200',
            'description' => 'required',
        ]);

        $category = new Category($request->all());
        $category->save();

        return redirect()
            ->route('admin.blog.categories.index')
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.blog.categories.edit', ['model' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
        ]);

        if ($category->update($request->all())) {
            return redirect()->route('admin.blog.categories.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.blog.categories.edit', $category->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.blog.categories.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.blog.categories.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
