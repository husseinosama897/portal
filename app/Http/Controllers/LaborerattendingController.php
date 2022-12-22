<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use \Carbon\Carbon;
use Storage;
use App\Attending_and_leaving;
use DB;
use App\project;
class laborerattendingController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  
public function sortUsersByProject(project $project){
  
  $User = $project->contract()->select(['user_id','id','project_id'])->with(['user'=>function($q){

    return $q->select(['name','id']);

  }])->get()->chunk(10);

  return response()->json(['data'=>$User]);

}


public function attendance_absence(request $request){

$this->validate($request,[
  'from'=>['required'],
  'type'=>['required','numeric','digits_between:1,2'],
  'project_id'=>['required','numeric']
]);

if($request->type== 1){
  $this->validate($request,[
    'to'=>['required'],
  ]);
}


  $data = json_decode($request->data, true);

  $startTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->from);

  $endTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->to);

  $totalDuration =  $startTime->diffInHours($endTime);

  $totalMin =  $startTime->diffInMinutes($endTime)  - 60 * $totalDuration;


if($totalMin >= 55){
$totalDuration += 1;
$totalMin = 0;
}


$attendance = [];

  foreach($data as $da){
    
    $attendance[] = [
'user_id'=>$da['id'],
'attending_time'=> $request->type == 1 ? $request->from : null,
'attending_leaving'=> $request->type == 1 ? $request->to : null,
'absence' => $request->type == 2 ? Carbon::parse($request->from)->format('d/m/Y') : null   ,
'time_difference'=> $request->type == 1 ? $totalDuration : null,
'min'=> $request->type == 1 ? $totalMin : null,
'project_id'=>$request['project_id']
    ];
  }


  $chunkfille = array_chunk($attendance, 3);

foreach($chunkfille as $chunk){
  Attending_and_leaving::insert($chunk);

}
 


}



public function attendance_Manule(){
return view('laborer.attendance');
}

public function attendance(request $request,User $User){
  
  $startTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->attending_time);

  $endTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->attending_leaving);
 
  $endTime = Carbon::createFromFormat('Y-m-d H:i:s',$endTime)->timezone('Asia/Riyadh');
  $totalDuration =  $startTime->diffInHours($endTime);

  $totalMin =  $startTime->diffInMinutes($endTime)  - 60 * $totalDuration;


if($totalMin >= 55){
$totalDuration += 1;
$totalMin = 0;
}

  Attending_and_leaving::create([
      'attending_leaving'=> $request->attending_leaving,
      'time_difference'=> $totalDuration,
   'attending_time'=>$request->attending_time,
  'min'=>$totalMin,
  'user_id'=>$User->id,
  ]);

}

    public function start_day(){
if(!empty(auth()->user()->contract)){
  $data = auth()->user()->contract;

  $project =  $data->project;
  
          return view('laborer.homepage')->with('data',$data);
  
}else{
  return redirect()->back();
}


    }


    public function Attending_and_leaving(request $request,$project){
        
  if(is_string($project)){

  $check = auth()->user()->contract;


  if($project == $check->project->qr || !empty( auth()->user()->projectmanager()) &&  auth()->user()->projectmanager()->where('qr',$project)->count() ){

  

        $Attending_and_leaving = auth()->user()->Attending_and_leaving()->whereDate('attending_time', DB::raw('CURDATE()'))->first();
    //    $image = $request->v;
     //   $image = str_replace('data:image/jpeg;base64,', '', $image);
     //   $image = str_replace(' ', '+', $image);
      //  $imageName = Str::random(20).'.'.'jpeg';
      
      
        
   //     Storage::disk('public')->put($imageName, base64_decode($image));

  

        

      if(!empty($Attending_and_leaving)){
       
 
        $startTime = Carbon::createFromFormat('Y-m-d H:i:s',$Attending_and_leaving->attending_time);

        $endTime = Carbon::now()->timezone('Asia/Riyadh');
       
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s',$endTime)->timezone('Asia/Riyadh');
        $totalDuration =  $startTime->diffInHours($endTime);
      
        $totalMin =  $startTime->diffInMinutes($endTime)  - 60 * $totalDuration;
    
     
if($totalMin >= 55){
$totalDuration += 1;
$totalMin = 0;
}

        $Attending_and_leaving->update([
            'attending_leaving'=>Carbon::now()->timezone('Asia/Riyadh'),
            'time_difference'=> $totalDuration,
       //     'leaving_image'=>$imageName,
        'min'=>$totalMin
        ]);
      }else{
       
        Attending_and_leaving::create([
         'user_id'=>auth()->user()->id,
        'project_id'=>$check->project->id,
        'attending_time'=>Carbon::now()->timezone('Asia/Riyadh'),
  //        'out_of_place'=>$request->out_of_place,
           'status'=>1,
         //  'attending_image'=>$imageName,
        ]);

      }

      return view('succes');
    }
     
    }
    }
}
