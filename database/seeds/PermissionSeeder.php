<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           $data = [
            /*
            
          ['name'=>'preview_po',]  ,
          ['name'=>'edit_po',]  ,
          ['name'=>'create_po',]  ,
          // petty cash
      
          ['name'=>'preview_petty_cash',]  ,
          ['name'=>'edit_petty_cash',]  ,
          ['name'=>'create_petty_cash',]  ,
    // subcontractor 
    
    ['name'=>'preview_subcontractor',]  ,
    ['name'=>'edit_subcontractor',]  ,
    ['name'=>'create_subcontractor',]  ,
    
    
    //daily_report
    ['name'=>'preview_daily_report',]  ,
    ['name'=>'edit_daily_report',]  ,
    ['name'=>'create_daily_report',]  ,
    
    
    
    //joboffer
    ['name'=>'preview_joboffer',]  ,
    ['name'=>'edit_joboffer',]  ,
    ['name'=>'create_joboffer',]  ,
    
    
    //service
    ['name'=>'preview_service',]  ,
    ['name'=>'edit_service',]  ,
    ['name'=>'create_service',]  ,
    
    
    //matrial request
    ['name'=>'preview_matrial_request',]  ,
    ['name'=>'edit_matrial_request',]  ,
    ['name'=>'create_matrial_request',]  ,
    
    
    //cws
    ['name'=>'preview_cws',]  ,
    ['name'=>'edit_cws',]  ,
    ['name'=>'create_cws',]  ,
    
    
    ['name'=>'preview_Site_Request',]  ,
    ['name'=>'edit_Site_Request',]  ,
    ['name'=>'create_Site_Request',]  ,
    
    
    ['name'=>'preview_contractor',]  ,
    ['name'=>'edit_contractor',]  ,
    ['name'=>'create_contractor',]  ,
    
    
    
    ['name'=>'preview_task',]  ,
    ['name'=>'edit_task',]  ,
    ['name'=>'create_task',]  ,
    
    */
#manager



['name'=>'preview_po_manager',]  ,
['name'=>'edit_po_manager',]  ,
['name'=>'create_po_manager',]  ,
['name'=>'export_po',]  ,
['name'=>'workflow_po',],
// petty cash

['name'=>'preview_petty_cash_manager',]  ,
['name'=>'edit_petty_cash_manager',]  ,
['name'=>'create_petty_cash_manager',] ,
['name'=>'export_petty_cash_manager',]  ,
['name'=>'workflow_petty_cash_manager',],
// subcontractor 

['name'=>'preview_subcontractor_manager',]  ,
['name'=>'edit_subcontractor_manager',]  ,
['name'=>'create_subcontractor_manager',]  ,
['name'=>'export_subcontractor_manager',]  ,
['name'=>'workflow_subcontractor_manager',],


//daily_report
['name'=>'preview_daily_report_manager',]  ,
['name'=>'edit_daily_report_manager',]  ,
['name'=>'create_daily_report_manager',]  ,
['name'=>'export_daily_report_manager',]  ,
['name'=>'workflow_daily_report_manager',],


//joboffer
['name'=>'preview_joboffer_manager',]  ,
['name'=>'edit_joboffer_manager',]  ,
['name'=>'create_joboffer_manager',]  ,
['name'=>'export_joboffer_manager',]  ,
['name'=>'workflow_joboffer_manager',],

//service
['name'=>'preview_service_manager',]  ,
['name'=>'edit_service_manager',]  ,
['name'=>'create_service_manager',]  ,
['name'=>'export_service_manager',]  ,
['name'=>'workflow_service_manager',],

//matrial request
['name'=>'preview_matrial_request_manager',]  ,
['name'=>'edit_matrial_request_manager',]  ,
['name'=>'create_matrial_request_manager',]  ,
['name'=>'export_matrial_request_manager',]  ,
['name'=>'workflow_matrial_request_manager',],


//cws
['name'=>'preview_cws_manager',]  ,
['name'=>'edit_cws_manager',]  ,
['name'=>'create_cws_manager',]  ,
['name'=>'export_cws_manager',]  ,
['name'=>'workflow_cws_manager',],

['name'=>'preview_Site_Request_manager',]  ,
['name'=>'edit_Site_Request_manager',]  ,
['name'=>'create_Site_Request_manager',]  ,
['name'=>'export_Site_Request_manager',]  ,
['name'=>'workflow_Site_Request_manager',],

['name'=>'preview_contractor_manager',]  ,
['name'=>'edit_contractor_manager',]  ,
['name'=>'create_contractor_manager',]  ,
['name'=>'export_contractor_manager',]  ,
['name'=>'workflow_contractor_manager',],


['name'=>'preview_task_manager',]  ,
['name'=>'edit_task_manager',]  ,
['name'=>'create_task_manager',]  ,
['name'=>'export_task_manager',]  ,
['name'=>'workflow_task_manager',],

  




    
    
           ];
    
           permission::insert($data);
    
        }
 
    }
  