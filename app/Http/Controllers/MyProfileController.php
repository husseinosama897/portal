<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class MyProfileController extends Controller
{
public function mytimesheet(){

    return view('user.timesheet');

}

    public function jsontimesheet(request $request)
    {
      $data = User::with(['contract'=>function($q){
  return $q->with('project');
      }])
      ->withSum(
        ['Attending_and_leaving' => function($q) use($request){
  
          if($request->from){
  
            $q->whereDate('attending_time','>=',$request->from);
             }
     
             if($request->to){
     
                $q->whereDate('attending_time','<=',$request->to);
                 }
     
              return $q;   
              
  
      }],
      'time_difference'
    )
  
    ->withSum(
      ['Attending_and_leaving' => function($q) use($request){
  
        if($request->from){
  
          $q->whereDate('attending_time','>=',$request->from);
           }
   
           if($request->to){
   
              $q->whereDate('attending_time','<=',$request->to);
               }
   
            return $q;   
            
  
    }],
    'min'
  )
  ;
      $data = $data->withCount(['Attending_and_leaving as Absence'=> function ($query) {
        return $query->where('absence','!=',null);
       }])->with('role')->find(Auth::id()) ;
      
     


      return response()->json(['data'=>$data]);
    }
}
