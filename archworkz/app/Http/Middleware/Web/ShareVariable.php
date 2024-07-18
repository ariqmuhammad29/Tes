<?php

namespace App\Http\Middleware\Web;

use App\Models\Blog\Category;
use App\Models\Setting;
use App\Models\SocialMedia;
use App\Models\footer;
use Closure;

class ShareVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $categoryArticles   = Category::all();
        $setting            = Setting::whereIn('key', ['name', 'email', 'phone', 'whatsapp', 'address', 'gmaps', 'logo', 'logo_gray', 'icon', 'ogimage', 'pixel', 'analytics', 'file'])->get();
        $footer             = footer::first();
        $SocialMedia        = SocialMedia::all();
        // $about              = Setting::key(Setting::ABOUT)->locale('id')->first()->json_value;

        view()->share(compact('categoryArticles'));
        view()->share(compact('setting'));
        view()->share('footer', $footer);
        view()->share(compact('SocialMedia'));
        // view()->share(compact('about'));

        return $next($request);
    }
}
