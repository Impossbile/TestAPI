<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

class ParseController extends Controller
{
    public function Upload(Request $request){

        $file = $request->xlsx->storeAs('xlsx','xlsx.xlsx')

    }
}
