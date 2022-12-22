<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase_order;
use App\petty_cash;
use App\subcontractor;
use App\employee;
use App\rfq;
use App\matrial_request;
use Carbon\Carbon;
use App\invoice;
use Cache;
use App\report;
use App\workflow;
use App\salary;
use App\project;
use App\project_report;
use App\User;
class projectManagerController extends Controller
{
    
// -----------------------  DCC  * * * ------------------------------------------------

     
      
      public function matrial_requestdata(){
        //-------------- matrial_request -----------------------
      
          $matrial_request = auth()->user()->projectmanager->matrial_request();
          
          $matrial_request = $matrial_request->with(['user'=>function($q){
          return $q->select(['id','name']);
                }])->with(['matrial_request_cycle'=>function($q){
                  return $q->with('role');
                   }])->orderBy('created_at','DESC');
          
          
           
              $matrial_request =  $matrial_request->paginate(10);
          
              return response()->json(['matrial_request'=>$matrial_request]);
         
      }
      
      
      
        public function subcontractordata(){
            //-------------- subcontractor -----------------------
      
              $subcontractor = auth()->user()->projectmanager->subcontractor();
              
              $subcontractor = $subcontractor->with(['user'=>function($q){
              return $q->select(['id','name']);
                    }])->with(['subcontractor'=>function($q){
                      return $q->with('role');
                       }])->orderBy('created_at','DESC');
              
              
               
                  $subcontractor =  $subcontractor->paginate(10);
              
                  return response()->json(['subcontractor'=>$subcontractor]);
             
        }
        
        
      public function summary(){
           $report = auth()->user()->projectmanager->project_report()->select(['total_cash_in','total_cash_out','date','project_id'])->orderBy('date','ASC')->get();
      
           return response()->json(['data'=>$report]);
      }
      

      
        public function podata(request $request){
      
      
          //----------------** Purchase_order ---------------------------
      
         
            $Purchase_order =  auth()->user()->projectmanager->Purchase_order();
      
            $Purchase_order =   $Purchase_order->with(['user'=>function($q){
              return $q->select(['id','name']);
                    }])->where('draft','!=',1)->with(['purchase_order_cycle'=>function($q){
                      return $q->with('role');
                       }]);
      
      
                $Purchase_order =  $Purchase_order->orderBy('created_at','DESC')->paginate(10);
      
      
      
      
      return response()->json(['Purchase_order'=>$Purchase_order,
      
      ]);
      
        }
        
        public function petty_cashdata(request $request){
      //------------------------**  petty cash  ---------------------------------
      
      
            $petty_cash =  auth()->user()->projectmanager->petty_cash();
      
  
           $petty_cash = $petty_cash-> with(['user'=>function($q){
              return $q->select(['id','name']);
                    }])->with(['petty_cash_cycle'=>function($q){
                      return $q->with('role');
                       }])->orderBy('created_at','DESC');
                 
      
                 $petty_cash =  $petty_cash->paginate(10);
      
                  
      
      return response()->json([
      'petty_cash'=>$petty_cash,
      
      ]);
      
        }
      
          public function index(){
      
            $purchase_orderworkflow =    workflow::where('name','purchase_order')->with(['flowworkStep'=>function($q){
              return     $q->with('role');
               }])->first();
      
               $petty_cashworkflow =    workflow::where('name','petty_cash')->with(['flowworkStep'=>function($q){
                return     $q->with('role');
                 }])->first();
      
                 $matrial_requestworkflow =    workflow::where('name','matrial_request')->with(['flowworkStep'=>function($q){
                  return     $q->with('role');
                   }])->first();
      
                   $subcontrctorworkflow =    workflow::where('name','subcontractor')->with(['flowworkStep'=>function($q){
                    return     $q->with('role');
                     }])->first();
      
      
            return view('ProjectManager.dcc')->with(['purchase_orderworkflow'=>$purchase_orderworkflow,'subcontrctorworkflow'=>$subcontrctorworkflow,
          'matrial_requestworkflow'=>$matrial_requestworkflow,
          'petty_cashworkflow'=>$petty_cashworkflow,
          
          ]);
          }


          /** ------------------------     end of dcc ------------------------------------------- */

          public function costcenterjson($project){
            if(is_numeric($project)){
                $data = project::where('id',$project)->with(['purchase_order'=>function($q){
            
            
                        return $q->where('status',1);
            
            
                            }])->with('projectmanager')->with(['petty_cash'=>function($q){
            
            
                                return $q->where('status',1);
            
            
                            }])->with(['subcontractor'=>function($q){
            
            
                                return $q->where('status',1);
            
            
                            }])->withsum('subcontractor','total')->with(['contract'=>function($q){
            
                                   $q->with(['user'=>function($query){
            
                                      $query->with(['Attending_and_leaving'=>function($qe) {
                           
                                        
                                                 }])->withsum('Attending_and_leaving','time_difference')->withsum('Attending_and_leaving','min');
            
        
                                                 $query = $query->withCount(['Attending_and_leaving as Absence'=> function ($query) {
                                                    return $query->where('absence','!=',null);
                                                   }]);
        
        
                                                   return $query;
                                   }]);                 
                       
            
            return $q;
            
                              }])->withsum('invoice','total')->with('invoice')
              ->first();
            
            
                
           return response()->json(['data'=>$data]);
            }
               
            
        }
        
        public function costcenter( ){
        
            
        return view('ProjectManager.costcenter');
        
           
        
        }
        



        // ----------------------------- * * * time sheet * * * -----------------------------------------

        public function jsontimesheet(request $request)
        {
          $data = User::query();
       
$data = $data->WhereHas('contract',function($q){

$q->WhereHas('project',function($query){

  return $query->where('id',auth()->user()->projectmanager->id);

});

});

          $data = $data->with(['contract'=>function($q){



      return $q->with('project');


          }])->with('role')
          
        
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
           }]);
          
        $data =   $data->paginate(10);
        
          return response()->json(['data'=>$data]);
        }

        
        public function timesheet(){
          return view('ProjectManager.timesheet');
        }
          
      }
      
    