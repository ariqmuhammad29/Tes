<?php

namespace App\Http\Controllers\Api\V1\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    
    public function index()
    {
        $clients = Client::ordered()->get();

        return response()->json(compact('clients'));
    }
}
