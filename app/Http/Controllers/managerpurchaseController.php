<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\workflow;
use Illuminate\Support\Str;
use App\flowworkStep;
use App\Purchase_order_cycle;
use App\comment_purchase_cycle;
use App\attachment_purchase_cycle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Purchase_order;
use DB;
use App\accountbank;
use App\entry_manual_account;
use App\entry_manual;
use  App\report;
use App\notification;
use App\Jobs\sendcc;
use App\Services\GoogleSheet;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\CustomException;
use App\inv_purchase;
use App\store_history;
use App\Events\NotificationEvent;
class managerpurchaseController extends Controller
{


      public function __construct()
    {
        $this->middleware('auth');
    }

    
public function inv(request $request,Purchase_order $Purchase_order){

$Purchase_order->update([
  
  'closed'=>1,

]);

  if($request->count > 0){
    for($counter = 0;  $counter <= $request->count;  $counter++){
     
        $img = 'files-'.$counter;
        
          if($request->$img){
            $image_tmp = $request->$img;
            $fileName = Str::random(40).'.'.$image_tmp->getClientOriginalExtension();
      
            $extension = $image_tmp->getClientOriginalExtension();
                    
            $image_tmp->move('uploads/purchase_order/inv', $fileName);
   
      $files[] = [
                   'purchase_id'=>$Purchase_order->id,
                   'path'=>$fileName,
                  ];
        ++$counter;
        }else{
          $fileName = null;
        
        }
   
   
      }
   
      $chunkfille = array_chunk($files, 3);
      if(!empty($chunkfille)){
          foreach($chunkfille as $chunk){
            inv_purchase::insert($chunk);
          }
             }
             
   }

}

    public function index(){
        return view('managers.purchase_order.index');
    }
 
    public function returnjsonpurchase(request $request){
     $Purchase_order = auth()->user()->role
     ->Purchase_order_cycle()->orderBy('id','DESC')->WhereHas('Purchase_order',function($q) use( $request){
      if($request->ref){
$q->where('ref', 'LIKE', '%' . $request->ref . '%');

      }

      if($request->project_id && $request->project_id !== ''){

        $q->where('project_id',$request->project_id);
        
              }

              if($request->user_id && $request->user_id !== ''){

                $q->where('user_id',$request->user_id);
                
                      }

                      if($request->supplier_id && $request->supplier_id !== ''){

                        $q->where('supplier_id',$request->supplier_id);
                        
                              }


                      
              if($request->delivery_date){

                $q->where('delivery_date',$request->delivery_date);
                
                      }

                      if($request->date){

                        $q->where('date',$request->date);
                        
                              }



                              return $q;

     })->with(['Purchase_order'=>function($query) {
       return  $query->with('user');
     }])->paginate(10);
 


     return response()->json(['data'=>$Purchase_order]);
    }
 
    
 
    public function purchasereturn( $Purchase_order){
     if (is_numeric($Purchase_order)){
         $data = Purchase_order::where('id',$Purchase_order)->with(['attributes','note'])->with(['Purchase_order_cycle'=>function($q){
            return  $q->with(['comment_purchase_order_cycle'=> function($qu){
                return $qu->with('user');
            }])->with(['role'=> function($q){
               
            }]);
            }])->with('project')
            ->with(['attributes2'=>function($q){
              return $q->where('product_id','=',null);
          }])
            ->first();
         if(!empty($data)){
             return view('managers.purchase_order.preview')->with(['data'=>$data]);
         }
      
     }
 
    }
 
    public function update( $Purchase_order){
     if (is_numeric($Purchase_order)){
     $data = Purchase_order::where('id',$Purchase_order)->with(['purchase_order_cycle'=>function($q){
             return  $q->with(['comment_purchase_order_cycle'=> function($qu){
                 return $qu->with('attachment_purchase_order_cycle');
             }])->with('role');
             }])
             ->with('purchase_order_attachment')
             ->with(['attributes','attributes2'])->with('note')->first();
         if(!empty($data)){
             
         
             return view('managers.purchase_order.update')->with(['data'=>$data]);
         }
      
     }
 
    }
 
 public function action(request $request,Purchase_order $Purchase_order){
 
 
     $data =  $this->validate($request,[
         'quotation'=>['string','max:255'],
        'project_id'=>['required','numeric','max:255'],
        'date'=>['required','date','max:255'],
    'subject'=>['required','string','max:255'],
   
    'status'=>['required','numeric','between:1,2'],
        'ref'=>['string','max:255'],
        'to'=>['string','max:255'],
       
  
         ]);
  
  try{
  
      DB::transaction(function () use ($request,$Purchase_order,$data) {
        $cash = $request->cash == true ? 1 :0;
    $on_vat = $request->no_vat == true ? 1 :0;

  $Purchase_order->update([
     
      'project_id'=>$request['project_id'],
      'date'=>$request['date'],
  'subject'=>$request['subject'],
  'supplier_id'=>$request->supplier_id,
     'ref'=>$request['ref'],
    'order_for'=>$request->order_for,
      'to'=>$request['to'],
      
  
  ]);

  
  $Purchase_order_cycle =  $Purchase_order->purchase_order_cycle()->orderBy('id', 'DESC')->first();
  if($Purchase_order_cycle->status == 0){

    $Purchase_order_cycle->status = $request->status;
    $Purchase_order_cycle ->save();
    $perv = workflow::where(['name'=>'purchase_order'])->first()->flowworkStep()->where(['step'=> $Purchase_order_cycle->step])
    ->first();

       $workflow = workflow::where(['name'=>'purchase_order'])->first()->flowworkStep()->where(['step'=> $Purchase_order_cycle->step+1])
       ->first();
   if($request->status == 1){
 
       $content   = 'Your PO' .$Purchase_order->ref.'has been approved by'.$perv->role->name ?? ''.' and Under Review from '.$workflow->role->name ?? 'no one';

       if(!empty($workflow->role->user)){
        foreach($workflow->role->user as $user){
            
            $job = (new sendcc($user,$content,$request->contentmanager))->delay(Carbon::now()->addSeconds(90));
            $this->dispatch($job);
    
            NotificationEvent::dispatch($user->id,$content);


           }
       }
      



       $job = (new sendcc($Purchase_order->user,$content,$request->contentmanager))->delay(Carbon::now()->addSeconds(90));
       $this->dispatch($job);
       NotificationEvent::dispatch($Purchase_order->user->id,$content);

       notification::create([
        'type'=>4,
        'read'=>1,
        'name'=>'Your PO' .$Purchase_order->ref.'has been approved ',
      'user_id_to'=>$Purchase_order->user_id,
         'user_id_from'=>auth()->user()->id,  
    ]);



       if(!empty($workflow)  ){
   Purchase_order_cycle::insert([
               'step'=>$Purchase_order_cycle->step + 1,
               'status'=>0,
               'flowwork_step_id'=>$workflow->id,
               'role_id'=>$workflow->role_id,
               'Purchase_order_id'=>$Purchase_order->id
           ]);
   
       }else  {
        $Purchase_order->update([
'status'=>1,
     ]);


 

    $Purchase_order->project->increment('po_expenses',$Purchase_order->total);

    $report =   report::where('date',$Purchase_order->date)->increment('total_cash_out',$Purchase_order->total);

    if(empty($report)){
     report::create([
       'date'=>$Purchase_order->date,
       'total_cash_out'=>$Purchase_order->total,
     ]);
    }  


/*


//---------------------** entry manule hearing **--------------------------


$code = entry_manual::count() + 1;
        $entry_manual = entry_manual::create([

     'date'=>\Carbon\Carbon::now()->format('Y-m-d'),
           'creditor_id'=> null, 
            'value'=>$Purchase_order->total,
        'dis'=>'فاتورة شراء '.''.$Purchase_order->ref,
        'line'=>1,
'type'=>20,
      'code'=>$code,
      'hide'=>1
        ]);




if( $entry_manual->sub_account3()->count() > 0){
    $entry_manual->sub_account3()->decrement('initial_balance',$Purchase_order->total);
    
    $entry_manual->sub_account3->subaccount1()->decrement('initial_balance',$Purchase_order->total);
    $entry_manual->sub_account3->subaccount1->accountbank->decrement('initial_balance',$Purchase_order->total);
}


$callingAccountNumber_2_branch_21_branch2101 =  accountbank::where('code',2)->with(['subaccount1'=>
function($d){
    $d->where('code',21)->with(['sub_account3'=> function($r) {
 return   

 $r->where('code',2101);
   }]);
}]);
$callingAccountNumber_2_branch_21_branch2101 = $callingAccountNumber_2_branch_21_branch2101->first();
$updateBranch = $callingAccountNumber_2_branch_21_branch2101['subaccount1'][0]['sub_account3'][0]['id'];




$entry =  entry_manual_account::create([
    'debtor_account3_id'=>null,
     'debtor_sub_account4_id'=>null,
     'creditor_sub_account3_id'=>$updateBranch,
  'entry_manual_id'=>$entry_manual->id,
  'value'=>$Purchase_order->total,
  'date'=>$entry_manual->date,
  ]);
  
  $entry->creditor_sub_account3()->decrement('initial_balance',$Purchase_order->total);
  $entry->creditor_sub_account3->subaccount1()->decrement('initial_balance',$Purchase_order->total);
  $entry->creditor_sub_account3->subaccount1->accountbank->decrement('initial_balance',$Purchase_order->total);
  

//------------hearing debtor accounts -------------

foreach($Purchase_order->attributes as $v){

    $total = $v['pivot']['total'];

  $e =  entry_manual_account::create([
     'debtor_sub_account4_id'=>$v['p_account4_id'],
     'debtor_account3_id'=>$v['p_account3_id'],
  'entry_manual_id'=>$entry_manual->id,
  'value'=>$total,
  'date'=>$entry_manual->date,
  ]);


if($e->sub_account4()->count() > 0){
  $e->sub_account4()->increment('initial_balance',$total);
  
    $e->sub_account4->sub_account3()->increment('initial_balance',$total);
    $e->sub_account4->sub_account3->subaccount1()->increment('initial_balance',$total);
    $e->sub_account4->sub_account3->subaccount1->accountbank->increment('initial_balance',$total);
}

if($e->sub_account3()->count() > 0){
  $e->sub_account3()->increment('initial_balance',$total);
       
  $e->sub_account3->subaccount1()->increment('initial_balance',$total);
  $e->sub_account3->subaccount1->accountbank->increment('initial_balance',$total);
}

}

//------------------------- hearing tax account ---------------------------------------

foreach($Purchase_order->attributes as $v){

    $total = $v['pivot']['total'] ;
    $da = accountbank::where('code',2)->with(['subaccount1'=>
    function($d){
        $d->where('code',21)->with(['sub_account3'=> function($r) {
     return   
    
     $r->where('code',2105);
       }]);
    }]);

    $da = $da->first();
    $d = $da['subaccount1'][0]['sub_account3'][0]['id'];
   
    $tax = 15;

    
    $e =  entry_manual_account::create([
        'debtor_account3_id'=>null,
         'debtor_sub_account4_id'=>null,
         'debtor_account3_id'=>$d,
      'entry_manual_id'=>$entry_manual->id,
      'value'=>  $v['pivot']['total']  * $tax / 100,
    
      'date'=>$entry_manual->date,
      ]);
      if($e->sub_account4()->count() > 0){
        $e->sub_account4()->increment('initial_balance',$total);
        
          $e->sub_account4->sub_account3()->increment('initial_balance',$total);
          $e->sub_account4->sub_account3->subaccount1()->increment('initial_balance',$total);
          $e->sub_account4->sub_account3->subaccount1->accountbank->increment('initial_balance',$total);
      }
      
      if($e->sub_account3()->count() > 0){
        $e->sub_account3()->increment('initial_balance',$total);
             
        $e->sub_account3->subaccount1()->increment('initial_balance',$total);
        $e->sub_account3->subaccount1->accountbank->increment('initial_balance',$total);
      }

}

//--------------------------------------------------------------------------

*/


 }
   }elseif($request->status == 2){
    $content   = 'Your' .$Purchase_order->ref.'has been rejected by'.$perv->role->name ;

  
    $job = (new sendcc($Purchase_order->user,$content,$request->contentmanager))->delay(Carbon::now()->addSeconds(90));
    $this->dispatch($job);
    NotificationEvent::dispatch($Purchase_order->user->id,$content);


    $Purchase_order->update([
        'status'=>2,
                        ]);


                        notification::create([

                            'type'=>4,
                            'read'=>1,
                            'name'=>'Your' .$Purchase_order->ref.'has been rejected by',
                          'user_id_to'=>$Purchase_order->user_id,
                             'user_id_from'=>auth()->user()->id,  
                        ]);
  
                        
                        
} 
   
      
       $comment_purchase_cycle = comment_purchase_cycle::create([
           'purchase_order_cycle_id'=>$Purchase_order_cycle->id,
           'content'=>$request->contentmanager ?? 'No Comment',
           'user_id'=>auth()->user()->id,
       ]);
       

       
          $files = [];
         if($request->count > 0){
          for($counter = 0;  $counter <= $request->count;  $counter++){
            $img = 'files-'.$counter;

     


       
                if($request->$img){

                  $image_tmp = $request->$img;
                  
               $fileName = 'Purchase_order_'.'_'.'code_'.'' .$Purchase_order->id. Carbon::now().'_step_'.$Purchase_order_cycle->step;
          Storage::disk('google')->put($fileName
          ,file_get_contents($image_tmp));

            ++$counter;
           
          
              ++$counter;
              }else{
              
              
              }

            
 
         
        }


        }
          

  }

      });
  

  }
  catch (Exception $e) {
      return $e;
  }
  
 }
    
 
 }
 