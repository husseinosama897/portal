<template>
  <div >
    <button   class="btn btn-light" v-print="'#printMe'">Print </button>

    <div class="card">

<div class="card-body">

<div class="row">

  <div class="col-6">
    <ul class="list-group">
  <li class="list-group-item">Date :  {{currentTime}} </li>
  <li class="list-group-item">Project Name : {{data.name}} </li>
  <li class="list-group-item">location :    {{data.log}}  - {{data.lat}}</li>
  <li class="list-group-item">Bid Amount : {{data.bid_value}}</li>
  <li class="list-group-item">Project manger :{{data.projectmanager ? data.projectmanager.name : 'unknown' }} </li>
</ul>
    </div>

    <div class="col-6">
      <ul class="list-group">
  <li class="list-group-item">Start Date :  {{data.receive_date}} </li>
  <li class="list-group-item">Expected Handover Date : {{data.final_delivery_date}}</li>
  <li class="list-group-item">Remaing Days  : {{Remaing}}</li>
</ul>
    </div>

</div>

</div>

    </div>

    <div class="card">

      <div class="card-body">

        <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> CashOut   </h4>
        </div>
    </div>
</div>

        <table class="table datatable-button-print-basic">
                     <thead>
                        <tr>
                            <th><strong>No</strong></th>
                                                <th><strong>Description</strong></th>
                                                <th><strong>Amount Budget VAT</strong></th>
                                                <th><strong>Amount Expenses VAT</strong></th>
                                               
                                            

                        </tr>
                     </thead>
                     <tbody>
                      <tr>
                        <td>1</td>
                        <td>PO</td>
                        <td>{{data.po_budget}}</td>
                        <td>{{sum_po}}</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>PC</td>
                        <td>{{data.petty_cash_budget}}</td>
                        <td>{{sum_petty_cash}}</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>SI</td>
                        <td>{{data.subcontractor_budget}}</td>
                        <td>{{sum_subcontractor}}</td>
                      </tr>

                      <tr>
                        <td>4</td>
                        <td>Staff</td>
                        <td>{{data.employee_budget}}</td>
                        <td>{{netSalaries}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">total</td>
                        <td  >
                          {{Amount_Budget}}
                        </td>

                        <td >
                        {{total_cash_out}}
                      </td>
                      </tr>
                      </tbody>
                      </table>



      </div>
    </div>

    <div class="card">

<div class="card-body">

  <div class="row">
<div class="col-12">
  <div class="page-title-box">
      <h4 class="page-title"> CashIn   </h4>
  </div>
</div>
</div>

  <table class="table datatable-button-print-basic">
               <thead>
                  <tr>
                      
                                          <th><strong>code</strong></th>
                                          <th><strong>total</strong></th>
                                  
                                         
                                      

                  </tr>
               </thead>
               <tbody>
    <tr  v-for="inv in data.invoice" :key="inv.id">
<td>{{inv.code}}</td>
<td>{{inv.total}}</td>

    </tr>
<tfoot>
  <tr>
    <td>total</td>

    <td>{{calculateIvoice}}</td>
  </tr>
</tfoot>
                </tbody>
                </table>



</div>
</div>

            <div class="row" id="printMe" >
           
            <tamplete v-if=" data.purchase_order  && data.purchase_order.length > 0">
              <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> purchase order  </h4>
        </div>
    </div>
</div>

<po-component :data=" data.purchase_order" :expenses="sum_po" :budget_expenses="data"></po-component>
           </tamplete>

           <tamplete v-if=" data.petty_cash && data.petty_cash.length > 0">
            <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> Petty Cash </h4>
        </div>
    </div>
</div>
<petty-cash :data="data.petty_cash" :expenses="sum_petty_cash" :budget_expenses="data"></petty-cash>
        
        </tamplete>

            <tamplete v-if=" data.subcontractor">
              <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> SubContractor  </h4>
        </div>
    </div>
</div>

<subcontractor-component :data="data.subcontractor" :expenses="sum_subcontractor" :budget_expenses="data"></subcontractor-component>
           </tamplete>
         <tamplete v-if=" data.contract   && data.contract.length > 0">
          <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">  staff </h4>
        </div>
    </div>
</div>
<staff-component :staff="data.contract"  :date="data.receive_date" :netSalaries="netSalaries"  :budget_expenses="data"></staff-component>
       </tamplete>


         </div>
       
</div>


</template>
<script>
  import moment from 'moment'
    export default {
   props:['project'],
      
        data(){
return{

data:{},
allerros:[],
projects:[],
project_id:this.project,
currentTime:'',
Remaing:'',
name:'',
lat:'',
to:'',
working_day:'',
log:'',
updating:{},
cost_center:{
           series: [
                    
           ],
},
 
      chartOptions: {
            legend: {
              show: false
            },
            chart: {
              height: 350,
              type: 'treemap'
            },
            title: {
              text: 'spending value'
            }
          },
          
          
}

        },

        methods:{
          changeproject(){
   
            axios({
   url:'/project_manager/costcenter/json/'+this.project_id,
   method:'post',
   }).then(res=>{

    this.data = res.data.data

          })
          },





    datajson(){
		axios({
  method: 'get',
  url: '/admin/project_json/' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },





 

 },
        mounted() {
          this.currentTime = moment().format('DD/MM/YYYY');
          var future = moment(this.data.receive_date,'DD/MM/YYYY')
          
var start = moment(this.data.final_delivery_date,'DD/MM/YYYY')
 this.Remaing   =  moment.duration(start.diff(future)).asDays();

 this.to = moment().format('YYYY-MM-DD');
this.working_day = moment(this.data.receive_date, "YYYY-MM").daysInMonth()
this.changeproject()
//this.project()
        },
      
        computed:{


          Amount_Budget(){

            var total = (Number(this.data.po_budget ?? 0) + Number(this.data.subcontractor_budget ?? 0) + Number(this.data.petty_cash_budget ?? 0) + Number(this.employee_budget ?? 0))
          
          return total.toFixed(2)

          },
          total_cash_out(){

            var total = (Number(this.sum_petty_cash) + Number(this.sum_subcontractor) + Number(this.sum_po) + Number(this.netSalaries))

            return total.toFixed(2)
          },

calculateIvoice(){
  var sum = 0
  if(this.data.length > 0){
    this.data.invoice.forEach(e=>{
sum = (Number(e.total) + Number(sum) )
})
  }

return sum
},

                    netSalaries(){
 var time = 0
  var min = 0
  var salary_per_hour = 0
var Net = 0
 if(  this.data.contract && this.data.contract.length > 0){
 this.data.contract.forEach(e=>{
  if(e.user ){
   min = (e.user.attending_and_leaving_sum_min )  ?? 0 / 60 
      time = Number(e.user.attending_and_leaving_sum_time_difference  ) ?? 0  + Number(min)  
      time = Math.round(time)
    
      var salaryPerDay = (Number(e.salary_per_month ) / Number(this.working_day))
  salaryPerDay = salaryPerDay.toFixed(2)

  
 var salaryperHour = (Number(salaryPerDay )  / 9 )

 salaryperHour = salaryperHour.toFixed(2)


 var overtime = ( Number(time)  - Number(e.working_hours))
  overtime = overtime.toFixed(2)
  var Absence = 0
  if(e.Absence > 0){
  Absence = (Number(salaryperHour)  * Number(e.working_hours) * Number(e.Absence))
  Absence = Absence.toFixed(2)
  }


  var Net = (Number(overtime) * salaryperHour + Number(time) *  Number(salaryperHour)  - Absence  + Number(Net))
  
Net =  Net.toFixed(2); 
  }


  })
 }
 
 
  return Net
},

          working_hours(){
 var time = 0
  var min = 0
 if( this.data.contract && this.data.contract.length > 0){
 this.data.contract.forEach(e=>{
  if(e.user){
   min = Number(e.user.attending_and_leaving_sum_min )/ 60
      time =Number(e.user.attending_and_leaving_sum_time_difference  )  + Number(min)
      time =time.toFixed(2)
  }


  })
 }
 
 
  return time
},
salary_per_hour(){
 var salary_per_hour = 0
 if(this.data.contract && this.data.contract.length > 0){
 this.data.contract.forEach(e=>{
 
  var salaryPerDay = (Number(e.salary_per_month ) / Number(this.working_day))
  salaryPerDay = salaryPerDay.toFixed(2)
  
 var salaryperHour = (Number(salaryPerDay )  / 9 )

 salaryperHour = salaryperHour.toFixed(2)

 
  })
 }
 
 return salary_per_hour

}
,
          sum_subcontractor(){
 var  total = 0
 if(this.data.subcontractor  )
{
  this.data.subcontractor.forEach(e=>{
total = Number(e.total) + Number(total)
total =  total.toFixed(2); 
  })
}  
  return total
}
,
sum_po(){
 var  total = 0
if(this.data.purchase_order){
  this.data.purchase_order.forEach(e=>{
total = Number(e.total) + Number(total)
total =  total.toFixed(2); 
  })
 
  
  return total
}
 
},

sum_petty_cash(){
 var  total = 0
 if(this.data.petty_cash){
  this.data.petty_cash.forEach(e=>{
total = Number(e.total) + Number(total)
total =  total.toFixed(2); 
  })
 
}

  return total
}

      }

    }
</script>
