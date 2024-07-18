<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class BasicInfoController extends Controller
{

    public function __construct() {
        view()->share('menuActive', 'settings');
        view()->share('subMenuActive', 'basic-info');
    }
    
    public function edit()
    {
        $name       = @Setting::key(Setting::NAME)->first()->value;
        $email      = @Setting::key(Setting::EMAIL)->first()->value;
        $phone      = @Setting::key(Setting::PHONE)->first()->value;
        $youtube    = @Setting::key(Setting::YOUTUBE)->first()->value;
        $whatsapp   = @Setting::key(Setting::WHATSAPP)->first()->value;
        $address    = @Setting::key(Setting::ADDRESS)->first()->value;
        $gmaps      = @Setting::key(Setting::GMAPS)->first()->value;
        $pixel      = @Setting::key(Setting::PIXEL)->first()->value;
        $analytics  = @Setting::key(Setting::ANALYTICS)->first()->value;
        $file       = @Setting::key(Setting::FILE)->first()->value;
 
        $setting = (object) compact('name','email','phone','youtube','whatsapp','address','gmaps','pixel', 'analytics','file');
        return view('admin.settings.basic-info.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'whatsapp' => ['required'],
            'address' => ['required'],
            'file' => ['file','mimes:pdf,doc,docx','max:2048']
        ]);

        Setting::updateOrCreate([
            'key' => Setting::NAME,
            ], ['value' => $request->name]);

        Setting::updateOrCreate([
            'key' => Setting::EMAIL,
        ], ['value' => $request->email]);

        Setting::updateOrCreate([
            'key' => Setting::PHONE,
        ], ['value' => $request->phone]);

        Setting::updateOrCreate([
            'key' => Setting::YOUTUBE,
        ], ['value' => $request->youtube]);

        Setting::updateOrCreate([
            'key' => Setting::WHATSAPP,
        ], ['value' => $request->whatsapp]);

        Setting::updateOrCreate([
            'key' => Setting::ADDRESS,
        ], ['value' => $request->address]);

        Setting::updateOrCreate([
            'key' => Setting::GMAPS,
        ], ['value' => $request->gmaps]);

        Setting::updateOrCreate([
            'key' => Setting::PIXEL,
        ], ['value' => $request->pixel]);

        Setting::updateOrCreate([
            'key' => Setting::ANALYTICS,
        ], ['value' => $request->analytics]);

        if ($request->hasFile('file')) {
            $filex = Setting::where('key','file')->first();
            Storage::delete(@$filex->value);
       
            $path = $request->file('file')->store('setting');
            Setting::updateOrCreate([
                'key' => Setting::FILE,
            ], ['value' => 'storage/'.$path]);
        } 

        return redirect()->route('admin.settings.basic-info.edit')->with([
            'success' => 'Basic Info Saved :)'
        ]);
    }
}
