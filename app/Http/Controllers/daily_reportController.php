<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Attending_and_leaving;
use Carbon\Carbon;
use App\Attendance_report;
use App\project;
use DB;
use App\Jobs\attendance_report_job;

class daily_reportController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
  $projects = project::WhereHas('Attending_and_leaving',function($q){
        return $q->whereDate('attending_time',\DB::raw('CURDATE()'));
       })->with(['Attending_and_leaving'=>function($q){
       return $q->whereDate('attending_time',\DB::raw('CURDATE()'));
       }])->with('projectmanager')->get();




foreach($projects as $project){

    $data = dailyReport::latest()->first();
    $explode = explode("-",$data->ref ?? 'R-'.''.'0');
  
   $daily_report  = dailyReport::create([
        'ref'=>'R-'.''.$explode[1]+1,
        'project_id'=>$project->id,
      'date'=>Carbon::today()->format('Y-m-d'),
      'status'=>0,
    ]);


$project->Attending_and_leaving()->update([
    'daily_report_id'=>$daily_report->id,
]);


    
    $job = (new attendance_report_job($project,$daily_report))->delay(Carbon::now()->addSeconds(90));
          dispatch($job);
}

      


       

    }
}
