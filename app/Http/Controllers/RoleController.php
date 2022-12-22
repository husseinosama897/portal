<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\role;
use App\permission;
class RoleController extends Controller
{

    public function rolechunk(){
$data = role::get()->chunk(10);
        return response()->json(['data'=>$data]);
    }

    public function create(){
$permission = permission::get();

return view('managers.role.create')->with(['data'=>$permission]);
    }

    public function update(role $role){
        $permission = permission::get();

$permissionrole = $role->permission;

 return view('managers.role.update')->with(['data'=>$permission,'permissionrole'=>$permissionrole]);

    }

    public function insert(request $request){

        $this->validate($request,[
            'name'=>['required','max:255','string'],

        ]);

     $role =    role::create([

        'name'=>$request->name
        ]);


        $json = json_decode($request->permission,true);

        $role->permission()->attach($json);

    }
}
