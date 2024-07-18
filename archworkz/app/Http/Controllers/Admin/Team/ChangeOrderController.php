<?php

namespace App\Http\Controllers\Admin\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;

class ChangeOrderController extends Controller
{

    public function __construct() {
        $this->middleware('permission:clients read');
        $this->middleware('permission:clients update')->only('update');
    }
    
    public function update(Team $team, $arrow)
    {
        if ($arrow === 'up') {
            $team->moveOrderUp();
        } else {
            $team->moveOrderDown();
        }

        return redirect()->back();
    }
}
