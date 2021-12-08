<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models;
use App\Models\Desk;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;
use App\Models\ParseModel;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function import(Request $request)
    {

        $file = Excel::import(new UsersImport(),$request->file('files'),null,\Maatwebsite\Excel\Excel::XLSX);


        return ;
    }

}
