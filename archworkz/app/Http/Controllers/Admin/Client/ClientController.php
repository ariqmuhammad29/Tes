<?php

namespace App\Http\Controllers\Admin\Client;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    
    public function __construct() {
        $this->middleware('permission:clients read');
        $this->middleware('permission:clients create')->only('create', 'store');
        $this->middleware('permission:clients update')->only('edit', 'update');
        $this->middleware('permission:clients delete')->only('destroy');

        view()->share('menuActive', 'landing-page');
        view()->share('subMenuActive', 'clients');
    }

    public function index(Request $request)
    {
        $clients = Client::ordered()->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'address' => ['required'],
            'about' => ['required'],
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg']
        ]);

        $client = new Client($request->all());

        $image = $client->uploadImage($request->file('image'), 'ugc/clients');
        
        $client->image = $image->lg;
        $client->save();

        return redirect()->route('admin.clients.index')->with([
            'status' => 'success',
            'message' => 'New client has been stored :)'
        ]);
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'address' => ['required'],
            'about' => ['required'],
            'image' => ['file', 'mimes:png,jpg,jpeg']
        ]);

        $payload = $request->all();

        if ($request->hasFile('image')) {
            $newImage = $client->uploadImage($request->file('image'), 'ugc/clients');
            
            if ($newImage) {
                $client->deleteImage();
            }

            $payload['image'] = $newImage->lg;
        }

        $client->update($payload);

        return redirect()->route('admin.clients.index')->with([
            'status' => 'success',
            'message' => 'Client has been updated :)'
        ]);
    }

    public function destroy(Request $request, Client $client)
    {
        Storage::delete($client->image);
        $client->delete();

        return redirect()->route('admin.clients.index')->with([
            'status' => 'success',
            'message' => 'Client has been deleted'
        ]);
    }
}
