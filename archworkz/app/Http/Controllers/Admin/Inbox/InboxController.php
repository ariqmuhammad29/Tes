<?php

namespace App\Http\Controllers\Admin\Inbox;

use App\Models\Inbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{

    public function __construct() {
        $this->middleware('permission:inboxes read');
        $this->middleware('permission:inboxes create')->only('create', 'store');
        $this->middleware('permission:inboxes edit')->only('edit', 'update');
        $this->middleware('permission:inboxes delete')->only('destroy');

        view()->share('menuActive', 'contact-us');
        view()->share('subMenuActive', 'inboxes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = Inbox::orderBy('is_viewed', 'asc')->paginate(10);
        return view('admin.inboxes.index', $data);
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
     * @param  Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        $inbox->is_viewed = 1;
        $inbox->save();

        return view('admin.inboxes.edit', ['model' => $inbox]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        $request->validate([
            'respond' => 'required'
        ]);

        $inbox->respond = $request->respond;

        if ($inbox->save()) {
            Mail::raw($request->respond, function ($message) use ($request) {
                $message->to($request->email);
                $message->from('email@compro.test');
                $message->subject('Inbox Reply');
            });

            return redirect()->route('admin.inboxes.index')->with(['status' => 'success', 'message' => 'Reply Successfully']);
        }
        return redirect()->route('admin.inboxes.index')->with(['status' => 'danger', 'message' => 'Reply Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Inbox $inbox
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Inbox $inbox)
    {
        if ($inbox->delete()) {
            return redirect()->route('admin.inboxes.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.inboxes.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
