<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Jobs\sendcc;
class WorkPermitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:permit';

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
   
        $today = \Carbon\Carbon::today();
        $newDateTime = Carbon::now()->addMonth();
        $contract = \App\contract::whereBetween('permit',[$today,$newDateTime])->get();
        $Hr  = \App\Role::where('name','HR Manger')->select(['name','id'])->first();
foreach($Hr->user as $h){
    foreach($contract as $conten){
        $content = ' WorkPermit' .$conten->user->name.' needs to renew his work permit';
        \App\notification::create([
            'type'=>7,
            'read'=>1,
            'name'=>$content,
          'user_id_to'=>$h->id, 
        ]);
    
        $job = (new sendcc($h->user,$content,''))->delay(Carbon::now()->addSeconds(90));
       dispatch($job);

        

    }


}

info('done');
        return 0;
    }
}
