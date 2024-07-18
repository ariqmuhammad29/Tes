<?php

namespace App\Http\Controllers\admin\faq;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->middleware('permission:faqs read');
        $this->middleware('permission:faqs create')->only('create', 'store');
        $this->middleware('permission:faqs update')->only('edit', 'update');
        $this->middleware('permission:faqs delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'faqs');
    }

    public function index()
    {
        $data = Faq::orderBy('id', 'desc')->paginate(10);

        return view('admin.faq.index', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|max:200',
            'answer' => 'required',
        ]);

        $faq = new Faq($request->all());
        $faq ->save();

        return redirect()
            ->route('admin.faq.index')
            ->with([
                'message' => 'Save Successfully'
            ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', ['model' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|max:200',
            'answer' => 'required',
        ]);

        if ($faq->update($request->all())) {
            return redirect()->route('admin.faq.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }

        return redirect()->route('admin.faq.edit', $faq->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            return redirect()->route('admin.faq.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.faq.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
 }
}