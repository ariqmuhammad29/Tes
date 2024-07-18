<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class AboutController extends Controller
{

    public function __construct() {
        view()->share('menuActive', 'settings');
        view()->share('subMenuActive', 'about');
    }

    public function index()
    {
        $about = (object) [
            'id' => @Setting::key(Setting::ABOUT)->locale(Setting::ID)->first()->json_value,
            'en' => @Setting::key(Setting::ABOUT)->locale(Setting::EN)->first()->json_value, 
        ];


        return view('admin.settings.about.index', compact('about'));
    }
    
    public function edit(Request $request)
    {
        $lang  = $request->input('lang', 'id');
        $about = @Setting::key(Setting::ABOUT)->locale($lang)->first()->json_value;

        return view('admin.settings.about.edit', compact('lang', 'about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         => ['required'],
            'meta_keywords' => ['required'],
            'meta_description' => ['required'],
            'description'   => ['required'],
            'lang'          => ['required', 'in:id,en']
        ]);

        Setting::updateOrCreate([
            'key'       => Setting::ABOUT,
            'locale'    => $request->lang
        ], [
            'json_value' => json_encode($request->only(
                'title',
                'meta_keywords',
                'meta_description',
                'description'
            ))
        ]);

        return redirect()->route('admin.settings.about.index')->with([
            'success' => 'About has been updated :)'
        ]);
    }
}
