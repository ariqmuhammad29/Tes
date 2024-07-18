<?php

namespace App\Http\Controllers\Website\Contact;

use App\Models\Inbox;
use App\Models\Subscribe;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Http\Controllers\Controller;
// use App\Rules\ReCaptcha;

class ContactController extends Controller
{
    /**
     * @var Inbox $inbox
     */
    protected $inbox;

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $data['sosmed'] = SocialMedia::all();
        View()->share('menu', 'Contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contact']   = ContactUs::all();
        return view('website.contact.index', $data);
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
    $this->inbox = new Inbox();
    $request->validate([
        // 'g-recaptcha-response' => ['required', new ReCaptcha],
        'email' => 'required|email',
        'name' => 'required',
        'company' => 'required',
        'message' => 'required'
    ]);

    $created = $this->inbox->create($request->all());

    if ($created) {
        return redirect()->route('contact.index')->with(['status' => 'success', 'message' => '
        your message has been sent']);
    } else {
        return redirect()->route('contact.index')->with(['status' => 'danger', 'message' => 'Gagal, Coba lagi nanti']);
    }
}

    

    public function subscribe(Request $request)
    {

        $this->subscribe = new Subscribe();
        $request->validate([
            // 'g-recaptcha-response' => ['required', new ReCaptcha],
            'email' => 'required|email'
        ]);

        if ($this->subscribe->create($request->all())) {
            return redirect()->route('landing.index')->with(['status' => 'success', 'message' => 'Email Anda Sudah Terkirim']);
        }
        return redirect()->route('landing.index')->with(['status' => 'danger', 'message' => 'Gagal, Coba lagi nanti']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
