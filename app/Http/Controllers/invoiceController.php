<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoice;
use App\report;
use Illuminate\Support\Str;
class invoiceController extends Controller
{
    
    public function insert_invoice(request $request){
$this->validate($request,[

]);
if($request->file){
    $image_tmp = $request->file;
    $fileName = 'inv'.''.Str::random(40);
    
    $extension = $image_tmp->getClientOriginalExtension();
            
    $image_tmp->move('uploads/customer/invoice', $fileName);
    
}else{
    $fileName = null;
}


$inv = invoice::create([
    'code'=>$request->code,
    'project_id'=>$request->project_id,
    'customer_id'=>$request->customer_id,
    'subtotal'=>$request->subtotal,
     'vat'=>$request->vat,
     'total'=>$request->total,
      'path'=>$fileName,
     'date'=>$request->date,
    'description'=>$request->description
]);
        

$report =   report::where('date',$inv->date)->increment('total_cash_out',$inv->total);

if(empty($report)){
 report::create([
   'date'=>$inv->date,
   'total_cash_out'=>$inv->total,
 ]);
}  


    }


    public function create(){
        $data = invoice::latest()->first();
        if($data){
            $explode = explode("-",$data->code);
            $code = $explode[1] + 1;
        }else{
            $code = 1;
        }
    

        return view('managers.invoice.create')->with(['code'=>'INV-'.''.$code]);
    }

    public function edit(invoice $invoice){

        return view('managers.invoice.edit')->with('data',$invoice);
    }

    public function update(invoice $invoice,request $request){

        $image_tmp = $request->file;
        if($image_tmp){
            $fileName = 'inv'.''.Str::random(40);
        
            $extension = $image_tmp->getClientOriginalExtension();
                    
            $image_tmp->move('uploads/customer/invoice', $fileName);
            
        }
    
        $invoice->update([
            'project_id'=>$request->project_id,
            'subtotal'=>$request->subtotal,
             'vat'=>$request->vat,
             'total'=>$request->total,
              'path'=>$fileName,
             'date'=>$request->date,
            'description'=>$request->description  
        ]);

    }


    public function jsonInvoice(request $request){
        $invoice = invoice::query();
        
        if($request->code){
            $invoice = $invoice->where('code', 'LIKE', '%' . $request->code . '%');
        }

        if($request->project_id){
            $invoice = $invoice->where('project_id',$request->project_id);
        }
       
        if($request->date){
$invoice = $invoice->where('date',$request->date);
        }
        
         
        
        $invoice = $invoice->with('project');
        $invoice = $invoice->paginate(10);
        return response()->json(['data'=>$invoice]);
    }


    public function table(){
        return view('managers.invoice.index');
    }
}
