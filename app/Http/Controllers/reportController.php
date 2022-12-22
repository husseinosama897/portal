<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\project;
use App\User;
class reportController extends Controller
{
    public function stockPage(){
        return view('managers.report.stock');
    }

    public function analysis_HR_page(){
        return view('managers.report.analysis_HR');
    }

    public function analysis_HR_JSON(request $request){



        $date = \Carbon\Carbon::now();

 $salary =  \App\contract::where('salary_per_month',null)->get();

foreach($salary as $sal){
    $sal->update([
        'salary_per_month'=>rand(2000,5000),
    ]);
}

 $data = [];

        foreach(User::get() as $user){

    $totalDuration =  $date->diffInMonths($user->contract->contract_date);

for ($i=0; $i <= 10 ; $i++) { 

$data[]= [ 
    'user_id'=>$user->id,
    'Amount'=>$user->contract->salary_per_month,
'month'=>$date->subMonths($i)->format('M'),
];


}

 }

 $array_chunk = array_chunk($data,100);
   foreach($array_chunk as  $chunk){
    \App\salary::create(
        $chunk
         );
     
   }



/*
        foreach(User::get() as $user){

            $user->update([
                'role_id'=>rand(50,63),
            ]);

        }
        */

/*
        foreach(\App\Attending_and_leaving::get() as $Attending_and_leaving){
            $Attending_and_leaving->delete();
        }

        $users = User::get();
        $scaling = [];
        foreach($users as $user){
            for ($i=0; $i <=30 ; $i++) { 
               $scaling[] = [
                'time_difference'=>rand(5,9),
                'user_id'=>$user->id,
               ];


            }
        }

        \App\Attending_and_leaving::insert($scaling);
*/

       /*
$users = User::get();
$scaling = [];
foreach($users as $user){
    $randomcountry = rand(1,6);
    if(empty($user->contract)){
        

        if($randomcountry == 1){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'netherland',
                'salary_per_month'=>rand(1000,5000)
            ];
        }

        if($randomcountry == 2){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'egypt',
                'salary_per_month'=>rand(1000,5000)
            ];
        }

        if($randomcountry == 3){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'ksa',
                'salary_per_month'=>rand(1000,5000)
            ];
        }

        
        if($randomcountry == 4){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'india',
'salary_per_month'=>rand(1000,5000)
            ];
        }

        if($randomcountry == 5){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'serbia',
                'salary_per_month'=>rand(1000,5000)
            ];
        }

        if($randomcountry == 6){

            $scaling [] = [
                'user_id'=>$user->id,
                'country'=>'iraq',
                'salary_per_month'=>rand(1000,5000)
            ];
        }

    }
}


$chunkdata = array_chunk($scaling,10);


foreach($chunkdata as $chunk){

    \App\contract::insert($chunk);
}
*/

/*
 $data =      \App\contract::where('age',null)->get();
       

      

foreach($data as $dat){
    $randage = rand(20,60);
  $newDateTime = \Carbon\Carbon::today()->subYears($randage);

    $dat->update([
        'age'=>$newDateTime,
    ]);

}
*/

        $data = User::query();

      $data =  $data->withsum('Attending_and_leaving','time_difference')->withsum('Attending_and_leaving','min');
    $data =    $data->with(['role'=>function($q){

        $q->select(['name','id']);

    }]);

    $data = $data->with(['salary'=>function($q)use($request){
if($request->from !== null || $request->to !== null ){
    $q->whereBetween('month',[$request->from,$request->to]);
 
}


    }]);



    $data = $data->with(['contract'=>function($q){

$q->select(['age','country','contract_date','salary_per_month','id','user_id']);

    }]);

    $data = $data->with(['task'=>function($q){
        $q->select(['start_at','expires_in','point','task_id']);
    }]);


    $data = $data->get()->chunk(10);

    return response()->json(['data'=>$data]);

    }


public function stock($project,request $request){
    if(is_numeric($project)){
        $data = project::query();

        $data = $data->with(['purchase_order'=>function($q)use($request){
            if($request->from  || $request->to){
                $q->whereBtween('date',[$request->from,$request->to]);
                
                                }
                                
$q->select('id','date','ref','project_id','delivery_date');

            $q->with(['attributes'=>function($q)use($request){
              




            }]);

            $q->with(['attributes2'=>function($q)use($request){
              

return $q->where('product_id','=',null);


            }]);


        }]);
        
        $data = $data->where('id',$project)->first();


        return response()->json(['data'=>$data]);
    }


}

}
