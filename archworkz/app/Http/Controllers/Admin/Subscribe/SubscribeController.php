<?php

namespace App\Http\Controllers\Admin\Subscribe;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{

    public function __construct() {
        $this->middleware('permission:subscribes read');
        $this->middleware('permission:subscribes create')->only('create', 'store');
        $this->middleware('permission:subscribes update')->only('edit', 'update');
        $this->middleware('permission:subscribes delete')->only('destroy');

        view()->share('menuActive', 'subscribes');
        view()->share('subMenuActive', 'subscribes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Subscribe::orderBy('id', 'desc')->paginate(10);
        return view('admin.subscribes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
* @param  Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        return view('admin.subscribes.edit', ['subscribe' => $subscribe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subscribe  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        $request->validate([
            'respond' => 'required'
        ]);

        $subscribe->respond = $request->respond;

        if ($subscribe->save()) {
            Mail::raw($request->respond, function ($message) use ($request) {
                $message->to($request->email);
                $message->from('email@compro.test');
                $message->subject('Subscribe Reply');
            });

            return redirect()->route('admin.subscribes.index')->with(['status' => 'success', 'message' => 'Reply Successfully']);
        }
        return redirect()->route('admin.subscribes.index')->with(['status' => 'danger', 'message' => 'Reply Failed, Contact Developer']);
}
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscribe $inbox
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subscribe $inbox)
    {
        if ($inbox->delete()) {
            return redirect()->route('admin.subscribes.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.subscribes.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
