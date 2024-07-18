<?php

namespace App\Http\Controllers\Website\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\about;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Subscribe;
use App\Models\footer;
use App\Models\Setting;
use App\Models\Info;


class HomeController extends Controller
{

    public function __construct(){
        View()->share('menu', 'Home');
    } 

    public function index(){
        
        $data['sliders']       	= Slider::all();
        $data['setting']        =Setting::all();
        $data['about']          = about::first();
        $data['info']           =Info::first();
        $data['service']        =Service::first();    
        $data['clients']        = Client::orderby('id','desc')->take('9')->get();
        $data['subscribes']     = Subscribe::all();
        $data['footer']         = footer::first();
        $data['sosmed']         = SocialMedia::all();
       

        return view('website.home.index', $data);
    }
}
