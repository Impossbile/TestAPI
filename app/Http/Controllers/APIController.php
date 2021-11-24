<?php

namespace App\Http\Controllers;


use App\Models;
use App\Models\Desk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use PhpParser\Node\Stmt\Return_;
use App\Models\ParseModel;
use App\Imports\UsersImport;


class APIController extends Controller
{
    public function index(Request $request,$id){
        if ($request->accepts(['text/html', 'application/json'])) {
            $user = Models\User::find($id);
            if (!$user) return response('Такой пользователь не найден', 404);
            return $user;
        }
    }



    public function show($id)
    {
        return Desk::find($id);
    }
    public function store(Request $request){

        return Desk::create($request->all());
    }


    public function update(Request $request, $id)
    {
       $desk = Desk::find($id);
        $desk->update($request->all());
        return $desk;
    }


    public function destroy($id)
    {
        return Desk::destroy($id);
    }





    public function search($name){

        Return Desk::where('name',$name)->get();

    }
public function export(Request $request){
    \Maatwebsite\Excel\Facades\Excel::import(new UsersImport(),$request->file('files'));

    return redirect('/')->with('success', 'All good!');

}
}

