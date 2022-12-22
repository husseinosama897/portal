<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HRController extends Controller
{
    //

public function profile( $User){

    if(is_numeric($User)){

    }
    $User = User::where('id',$User)->withCount(['Attending_and_leaving as Absence'=> function ($query) {
 return $query->where('absence','!=',null);
}])->with(['user_daily_report','user_file'])->with('task')->withsum('Attending_and_leaving','time_difference')->withsum('Attending_and_leaving','min')->with('contract')->first();

    return view('managers.report.hr.profile')->with(['data'=>$User]);
}
    


}
