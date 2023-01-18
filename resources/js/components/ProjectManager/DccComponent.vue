<template>
<div>


  <div class="card">

<div class="card-body">
<div class="row">
<div class="col-4">

<select  v-model="project_id" class="form-control">
  <option  ></option>
  <option  v-for="project in projects" :value="project.id" :key="project.id" >{{project.name}}</option>
</select>
</div>
</div>
</div>

</div>


  <div class="row mt-3">
         
    <div class="card">

      <div class="card-body">

        <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
      </div>
    </div>


    </div>


     <div class="row mt-3">
                   
                  
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">  purchase order </h5>
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                                 <th><strong>Delivery date</strong></th>      
                                               <th><strong>Delivery feedback</strong></th>
                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                             
    <tr v-for="(data,index) in pos.data "  :key="index">
                                               
                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                <td data-table="USER" v-if=" data.user ">{{data.user.name}}</td>
                              
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>
                                                                      
  
                                                    <td data-table="Delivery date">{{data.delivery_date  ? data.delivery_date  : 'unknown'}}</td>
                                                     <td data-table="Delivery feedback" v-if="data.delivery_date < today && data.closed !== 1  "><span class="badge bg-danger border-0">warning</span></td>
   
                                                                               <td data-table="Delivery feedback" v-if="data.delivery_date >= today  && data.closed !== 1  "><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="Delivery feedback" v-if="data.delivery_date >= today  && data.closed == 1  "><span class="badge bg-success border-0">closed</span></td>

   <td v-if="data.delivery_date == null">
   undefined
   </td>
   <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0"    @click="syc_purchase_order_real(data.purchase_order_cycle)" data-toggle="modal"  data-target="#workflow_purchase_order" >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span    @click="syc_purchase_order_real(data.purchase_order_cycle)"  data-toggle="modal" data-target="#workflow_purchase_order" class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span   @click="syc_purchase_order_real(data.purchase_order_cycle)"  data-toggle="modal" data-target="#workflow_purchase_order" class="badge bg-warning border-0">BENDING</span></td>


                                                <td data-table="VAT">{{data.vat}}</td>
                                                   
                                 
                                                    <td data-table="TOTAL"  >{{data.total}}</td>
                                 
                                          
                   
                                            </tr>
                                        </tbody>
                                    </table>

                                    <pagination :data="pos" @pagination-change-page="posResults"></pagination>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title"> petty cash </h5>
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                      
                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                             
    <tr v-for="(data,index) in petty_cash.data "  :key="index">
                                               
                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                <td data-table="USER" v-if=" data.user ">{{data.user.name}}</td>
                              
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>
                                                     
                                                



                                                <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0"    @click="syc_petty_cash_real(data.petty_cash_cycle)" data-toggle="modal"  data-target="#workflow_petty_cash" >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span    @click="syc_petty_cash_real(data.petty_cash_cycle)"  data-toggle="modal" data-target="#workflow_petty_cash" class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span   @click="syc_petty_cash_real(data.petty_cash_cycle)"  data-toggle="modal" data-target="#workflow_petty_cash" class="badge bg-warning border-0">BENDING</span></td>


                         
                                                <td data-table="VAT">{{data.vat}}</td>
                                                    <td data-table="TOTAL"  @click="edittotal(data)" >{{data.total}}</td>
                                 
                   
                                            </tr>
                                        </tbody>
                                    </table>

                                     
                                      <pagination :data="petty_cash" @pagination-change-page="petty_cashResults"></pagination>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                
     <div class="row mt-3">
      <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title"> subcontractor </h5>
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                      
                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                             
    <tr v-for="(data,index) in subcontractor.data "  :key="index">
                                               
                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                <td data-table="USER" v-if=" data.user ">{{data.user.name}}</td>
                              
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>
                                                                      
  

                                                <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0"     @click="syc_subcontractor_real(data.subcontractor)" data-toggle="modal"   data-target="#workflow_subcontractor"  >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span  @click="syc_subcontractor_real(data.subcontractor)" data-toggle="modal"  data-target="#workflow_subcontractor" class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span    @click="syc_subcontractor_real(data.subcontractor)" data-toggle="modal"  data-target="#workflow_subcontractor" class="badge bg-warning border-0">BENDING</span></td>
                                           
                                                <td data-table="VAT">{{data.vat}}</td>
                                                    <td data-table="TOTAL"  @click="edittotal(data)" >{{data.total}}</td>
                                 
                                           
                                          
                   
                                            </tr>
                                        </tbody>
                                    </table>

                                   
                                      <pagination :data="subcontractor" @pagination-change-page="subcontractorResults"></pagination>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                              <h5 class="card-title"> matrial request </h5>
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                      
                                                <th><strong>STATUS</strong></th>
                                         
                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                             
    <tr v-for="(data,index) in matrial_request.data "  :key="index">
                                               
                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                <td data-table="USER" v-if=" data.user ">{{data.user.name}}</td>
                              
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>
                                                                      
                                                 

                                                <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0"     @click="syc_matrial_request_real(data.subcontractor)"  data-toggle="modal" data-target="#workflow_subcontractor"  >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span  @click="syc_matrial_request_real(data.subcontractor)" data-toggle="modal"  data-target="#workflow_subcontractor" class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span    @click="syc_matrial_request_real(data.subcontractor)" data-toggle="modal"  data-target="#workflow_subcontractor" class="badge bg-warning border-0">BENDING</span></td>
                                           
                                       
                                          
                   
                                            </tr>
                                        </tbody>
                                    </table>

                                   
                                      <pagination :data="matrial_request" @pagination-change-page="matrial_requestResults"></pagination>

                                </div>
                            </div>
                        </div>
                    </div>

   
                </div>

        

                <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="workflow_purchase_order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in purchase_order_real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
            </div>
         </div>
      </div>
      <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="workflow_petty_cash" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in petty_cash_real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
            </div>
         </div>
      </div>
      <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="workflow_subcontractor" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in subcontractor_real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
            </div>
         </div>
      </div>
      <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="workflow_matrial_request" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in matrial_request_real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
            </div>
         </div>
      </div>

                </div>

</template>

<script>
import moment from 'moment'

    export default {
   props:['purchase_orderworkflow','projects','petty_cashworkflow','subcontrctorworkflow','matrial_requestworkflow'],
   data(){
return{
  purchase_order_real_cycle: [
         
			],

      petty_cash_real_cycle: [
         
         ],

project_id:'',

         matrial_request_real_cycle: [
         
         ],

         
         subcontractor_real_cycle: [
         
         ],

 series: [
            {
              name: "High - 2013",
              data: [28, 29, 33, 36, 32, 32, 33]
            },
            {
              name: "Low - 2013",
              data: [12, 11, 14, 18, 17, 13, 13]
            }
          ],
     
          chartOptions: {
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              width: [5, 7, 5],
              curve: 'straight',
              dashArray: [0, 8, 5]
            },
            title: {
              text: 'Page Statistics',
              align: 'left'
            },
            legend: {
              tooltipHoverFormatter: function(val, opts) {
                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
              }
            },
            markers: {
              size: 0,
              hover: {
                sizeOffset: 6
              }
            },
            xaxis: {
              categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                '10 Jan', '11 Jan', '12 Jan'
              ],
            },
            tooltip: {
              y: [
                {
                  title: {
                    formatter: function (val) {
                      return val + " (mins)"
                    }
                  }
                },
                {
                  title: {
                    formatter: function (val) {
                      return val + " per session"
                    }
                  }
                },
                {
                  title: {
                    formatter: function (val) {
                      return val;
                    }
                  }
                }
              ]
            },
            grid: {
              borderColor: '#f1f1f1',
            }
          },
          
          
        
data:{
  data:[]
},
edittotalvat:{},
salary:{},
no_vat:false,
images:[],
 oldestFirst: true,
allerros:[],
petty_cash:{},
pos:{},
matrial_request:[],
subcontractor:{},
employee:[],

date:'',

ref:'',

today:'',
}

        },


        methods:{

          updatedata_petty_cash(){
     this.petty_cashworkflow.flowwork_step.forEach(e=>{
      this.petty_cash_real_cycle.push({id:e.role.id,name:e.role.name})
     })
    },
          syc_petty_cash_real(cycle) {
			this.petty_cash_real_cycle.forEach(e => {
				cycle.forEach(z => {
					if (z.role.name == e.name) {
					
						if (z.status == 1) {
                    
							Vue.set(e, "status", 1);
						}
						if (z.status == 2) {
							Vue.set(e, "status", 2);
						}
						if (z.status == 0) {
							Vue.set(e, "status", 0);
						}
					}
				});
			});
		},

          
          updatedata_matrial_request(){
     this.matrial_requestworkflow.flowwork_step.forEach(e=>{
      this.matrial_request_real_cycle.push({id:e.role.id,name:e.role.name})
     })
    },
          syc_matrial_request_real(cycle) {
			this.matrial_request_real_cycle.forEach(e => {
				cycle.forEach(z => {
					if (z.role.name == e.name) {
					
						if (z.status == 1) {
                    
							Vue.set(e, "status", 1);
						}
						if (z.status == 2) {
							Vue.set(e, "status", 2);
						}
						if (z.status == 0) {
							Vue.set(e, "status", 0);
						}
					}
				});
			});
		},


          updatedata_subcontractor(){
     this.subcontrctorworkflow.flowwork_step.forEach(e=>{
      this.subcontractor_real_cycle.push({id:e.role.id,name:e.role.name})
     })
    },
          syc_subcontractor_real(cycle) {
			this.subcontractor_real_cycle.forEach(e => {
				cycle.forEach(z => {
					if (z.role.name == e.name) {
					
						if (z.status == 1) {
                    
							Vue.set(e, "status", 1);
						}
						if (z.status == 2) {
							Vue.set(e, "status", 2);
						}
						if (z.status == 0) {
							Vue.set(e, "status", 0);
						}
					}
				});
			});
		},


          updatedata_purchase_order(){
     this.purchase_orderworkflow.flowwork_step.forEach(e=>{
      this.purchase_order_real_cycle.push({id:e.role.id,name:e.role.name})
     })
    },
          syc_purchase_order_real(cycle) {
			this.purchase_order_real_cycle.forEach(e => {
				cycle.forEach(z => {
					if (z.role.name == e.name) {
					
						if (z.status == 1) {
                    
							Vue.set(e, "status", 1);
						}
						if (z.status == 2) {
							Vue.set(e, "status", 2);
						}
						if (z.status == 0) {
							Vue.set(e, "status", 0);
						}
					}
				});
			});
		},

    matrial_requestResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcmatrial_request?page=' + page,
  data:{
 
date:this.date,

project_id:this.project_id,


}
})		.then(response => {
                    
              this.matrial_request =  response.data.matrial_request
            
                })
    },

    matrial_requestjson(){
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcmatrial_request' ,
  data:{
 
 date:this.date,
 
 project_id:this.project_id,
 
 
 }
})		.then(response => {
                    
              this.matrial_request =  response.data.matrial_request
            
                })
    },

    
         subcontractorResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcsubcontractor?page=' + page,
  data:{
 
date:this.date,

project_id:this.project_id,


}
})		.then(response => {
                    
              this.subcontractor =  response.data.subcontractor
            
                })
    },

   subcontractorjson(){
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcsubcontractor' ,
  data:{
 
 date:this.date,
 
 project_id:this.project_id,
 
 
 }
})		.then(response => {
                    
              this.subcontractor =  response.data.subcontractor
            
                })
    },

          
          petty_cashResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcpetty_cash?page=' + page,
  data:{
  
date:this.date,

project_id:this.project_id,


}
})		.then(response => {
                    
              this.petty_cash =  response.data.petty_cash
            
                })
    },


    salaryResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsonSalaries?page=' + page,
 
})		.then(response => {
                    
              this.salary =  response.data.data
            
                })
    },

    


    
updatecharts(data){
  this.series.push({ name:'cash_out',data:[
    
  ]})

this.series.push({ name:'cash_in',data:[]})


  data.forEach(e=>{
   
        if(e.total_cash_out !== null && e.total_cash_out >= 0 ){
         
        this.series[0].data.push(e.total_cash_out)
        console.log(this.series[0].data)
      }else{
        this.series[0].data.push(0)
      }
      if(e.total_cash_in !== null && e.total_cash_in >= 0 ){
        this.series[1].data.push(e.total_cash_in)
      }else{
        this.series[1].data.push(0)
      }
     

     
      this.chartOptions.xaxis.categories.push(moment(e.date).format('MMMM Do'))
      


  

})
  
              
            
          
},

    dcsummary(){
		axios({
  method: 'post',
  url: '/project_manager/DCC/summary' ,
  data:{

project_id:this.project_id,

}

})		.then(response => {
  var date = new Date();
          var data = []   
          this.series.splice(0)
             this.series.splice(0)
             this.chartOptions.xaxis.categories.splice(0)
   data = response.data.data 

   this.updatecharts(data)     

})

    },

    petty_cashjson(){
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcpetty_cash' ,

  data:{
  ref:this.ref,
date:this.date,
delivery_date:this.delivery_date, 
project_id:this.project_id,
user_id:this.user_id,

}

})		.then(response => {
                    
              this.petty_cash =  response.data.petty_cash
            
                })
    },


     onImageinput(e,data) {     
this.images.push(e.target.files[0])

   let formData = new FormData();

if(this.images){
	 formData.append('count', this.images.length);
}

this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });

 axios.post('/project_manager/DCC/action_inv/'+data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
Vue.set(data,'closed',1)
     })


            },

dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_subcontractor_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},



posResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcpo?page=' + page,
  data:{
  ref:this.ref,
date:this.date,
delivery_date:this.delivery_date, 
project_id:this.project_id,
user_id:this.user_id,
supplier_id:this.supplier_id
}
})		.then(response => {
                    
              this.pos =  response.data.Purchase_order
            
                })
    },

    posjson(){
		axios({
  method: 'post',
  url: '/project_manager/DCC/jsondcpo' ,
data:{
  ref:this.ref,
date:this.date,
delivery_date:this.delivery_date, 
project_id:this.project_id,
user_id:this.user_id,
supplier_id:this.supplier_id
}
})		.then(response => {
                    
              this.pos =  response.data.Purchase_order
            
                })
    },



    edittotal(data){
      this.edittotalvat = {}
      window.$("#exampleModal").modal("show"); 

      this.edittotalvat = data
    },



 
 },
        mounted() {
          this.today = moment().format('DD/MM/YYYY');
     this.posjson()
     this.petty_cashjson()
     this.subcontractorjson()
     this.matrial_requestjson()
this.dcsummary()
     this.updatedata_purchase_order()
     this.updatedata_petty_cash()
     this.updatedata_subcontractor()
     this.updatedata_matrial_request()

        },
      
        computed:{
       totalamount:function(){
        var sum = 0
    return    sum = (Number(this.edittotalvat.total) + Number(this.Vat))
       },

          Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.edittotalvat.total) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum
   
   },

   


       },
       watch:{
        'project_id':function(){
          this.posjson()
     this.petty_cashjson()
     this.subcontractorjson()
     this.matrial_requestjson()
this.dcsummary()
        }
       }

    }
</script>
