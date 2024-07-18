<?php

namespace App\Http\Controllers\Admin\Portofolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portofolio\CategoryPortofolio;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:portofolio categories read');
        $this->middleware('permission:portofolio categories create')->only('create', 'store');
        $this->middleware('permission:portofolio categories update')->only('edit', 'update');
        $this->middleware('permission:portofolio categories delete')->only('destroy');

        view()->share('menuActive', 'portofolio');
        view()->share('subMenuActive', 'portofolio-categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = CategoryPortofolio::orderBy('id', 'desc')->paginate(10);

        return view('admin.portofolio.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portofolio.categories.create');
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

        $category = new CategoryPortofolio($request->all());
        $category->save();

        return redirect()
            ->route('admin.portofolio.categories.index')
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
    public function edit(CategoryPortofolio $category)
    {
        return view('admin.portofolio.categories.edit', ['model' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryPortofolio $category)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
        ]);

        if ($category->update($request->all())) {
            return redirect()->route('admin.portofolio.categories.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.portofolio.categories.edit', $category->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CategoryPortofolio $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.portofolio.categories.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.portofolio.categories.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
