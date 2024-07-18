<?php

namespace App\Http\Controllers\Admin\ContactUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:contact read');
        $this->middleware('permission:contact create')->only('create', 'store');
        $this->middleware('permission:contact update')->only('edit', 'update');
        $this->middleware('permission:contact delete')->only('destroy');

        view()->share('menuActive', 'contact-us');
        view()->share('subMenuActive', 'contactUs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = ContactUs::orderBy('id', 'desc')->paginate(10);
        // return view('admin.contact.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'map' => 'required',
        //     'addres' => 'required',
        //     'phone_number' => 'required',
        //     'email' => ['required', 'email', 'regex:/^.+@.+$/i'],
        // ]);

        // $contact = new ContactUs($request->all());
        // $contact->save();

        // return redirect()
        //     ->route('admin.contact.index')
        //     ->with(['status' => 'success', 'message' => 'Save Successfully']);
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
     * @param  ContactUs $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contact)
    {
        $data  = ContactUs::first();
        return view('admin.contact.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ContactUs  $contact
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, ContactUs $contact)
{
    $request->validate([
        'map' => 'required',
        'addres' => 'required',
        'phone_number' => 'required',
        'email' => ['required', 'email', 'regex:/^.+@.+$/i'],
    ]);

    $contact = ContactUs::first();
    if ($contact) {
        $contact->update([
            'map' => $this->modifyMapIframe($request->map),
            'addres' => $request->addres,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
    } else {
        $contact = new ContactUs([
            'map' => $this->modifyMapIframe($request->map),
            'addres' => $request->addres,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        $contact->save();
    }

    return redirect()->route('admin.contactUs.edit')->with(['status' => 'success', 'message' => 'Update Successfully']);
}

    private function modifyMapIframe($map)
    {
        // Use regular expression to find and replace width and height attributes
        $modifiedMap = preg_replace('/width="\d+"/', 'width="100%"', $map);
        $modifiedMap = preg_replace('/height="\d+"/', 'height="100%"', $modifiedMap);

        return $modifiedMap;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ContactUs $contact
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ContactUs $contact)
    {

        // if ($contact->delete()) {
        //     return redirect()->route('admin.contact.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        // }

        // return redirect()->route('admin.contact.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
