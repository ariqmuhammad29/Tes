<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{

    public function __construct()
    {
        view()->share('menuActive', 'settings');
        view()->share('subMenuActive', 'logo');
    }

    public function edit()
    {
        $logo       = @Setting::key(Setting::LOGO)->first()->value;
        $logo_gray  = @Setting::key(Setting::LOGO_GRAY)->first()->value;
        $icon       = @Setting::key(Setting::ICON)->first()->value;
        $ogimage    = @Setting::key(Setting::OGIMAGE)->first()->value;

        $setting    = (object) compact('logo', 'logo_gray', 'icon', 'ogimage');

        return view('admin.settings.logo.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo'      => ['image'],
            'logo_gray' => ['image'],
            'icon'      => ['image'],
            'ogimage'   => ['image']
        ]);

        if ($request->hasFile('logo')) {
            $logo = Setting::where('key', 'logo')->first();
            if ($logo && Storage::exists($logo->value)) {

                Storage::delete(@$logo->value);
            }

            $path = $request->file('logo')->store('setting');

            Setting::updateOrCreate([
                'key' => Setting::LOGO,
            ], ['value' => $path]);
        }
        if ($request->hasFile('logo_gray')) {
            $logo = Setting::where('key', 'logo_gray')->first();
            Storage::delete(@$logo->value);

            $path = $request->file('logo_gray')->store('setting');

            Setting::updateOrCreate([
                'key' => Setting::LOGO_GRAY,
            ], ['value' => $path]);
        }
        if ($request->hasFile('icon')) {
            $logo = Setting::where('key', 'icon')->first();
            Storage::delete(@$logo->value);

            $path = $request->file('icon')->store('setting');

            Setting::updateOrCreate([
                'key' => Setting::ICON,
            ], ['value' => $path]);
        }
        if ($request->hasFile('ogimage')) {
            $logo = Setting::where('key', 'ogimage')->first();
            Storage::delete(@$logo->value);

            $path = $request->file('ogimage')->store('setting');

            Setting::updateOrCreate([
                'key' => Setting::OGIMAGE,
            ], ['value' => $path]);
        }

        return redirect()->route('admin.settings.logo.edit')->with([
            'success' => 'Assets Setting Saved :)'
        ]);
    }
}
