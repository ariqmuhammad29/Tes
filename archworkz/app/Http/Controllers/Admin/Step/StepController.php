<?php

namespace App\Http\Controllers\Admin\Step;

use App\Http\Controllers\Controller;
use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:steps read');
        $this->middleware('permission:steps create')->only('create', 'store');
        $this->middleware('permission:steps update')->only('edit', 'update');
        $this->middleware('permission:steps delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'steps');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Step::orderBy('id')->paginate(4);
        return view('admin.step.index', compact('data'));
        // return 'vieriiii';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.step.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Menu::create([
        //     'title'     => $request->title,
        //     'link'     => $request->link,
        //     'status'     => $request->status
        // ]);

        Step::create($request->all());
        return redirect()
            ->route('admin.step.index')
            ->with(['status' => 'success', 'message' => 'Save Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        return view('admin.step.edit', compact('step'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Step $step)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);


        Step::where('id', (string)$step->id)
            ->update([
                'title'     =>  $request->title,
                'description' => $request->description
            ]);

        return redirect()
            ->route('admin.step.index')
            ->with(['status' => 'success', 'message' => 'Update Successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Step $step)
    {
        Step::destroy($step->id);
        return redirect()
            ->route('admin.step.index')
            ->with(['status' => 'danger', 'message' => 'Your data has been deleted!']);
    }
}
