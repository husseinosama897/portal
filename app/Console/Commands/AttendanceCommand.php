<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Attending_and_leaving;
use Illuminate\Support\Str;
use App\Jobs\qremail;
use Carbon\Carbon;
use App\project;
class AttendanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Attendance:leaving';

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

        $projects = project::select(['id','projectmanager_id','name','qr'])->with('projectmanager')->get();



        foreach($projects as $project){
        
            $project->update([
            'qr'=>Str::random(40),
        ]);
        
            $job = (new qremail($project->projectmanager,$project->qr))->delay(Carbon::now()->addSeconds(90));
          dispatch($job);
        }
         
        
       
    }
}
