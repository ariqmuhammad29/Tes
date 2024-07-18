<?php

namespace App\Http\Controllers\Admin\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeOrderController extends Controller
{
    
    public function update(Client $client, $arrow)
    {
        if ($arrow === 'up') {
            $client->moveOrderUp();
        } else {
            $client->moveOrderDown();
        }

        return redirect()->back();
    }
}
