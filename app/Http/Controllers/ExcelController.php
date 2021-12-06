<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models;
use App\Models\Desk;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;
use PhpParser\Node\Stmt\Return_;
use App\Models\ParseModel;


class ExcelController extends Controller
{
    public function import(Request $request)
    {

        \Maatwebsite\Excel\Facades\Excel::import(new UsersImport(),$request->file('files'));


        return redirect('/')->with('success', 'All good!');

    }

}
