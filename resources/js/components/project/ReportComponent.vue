<template>
  <div >
    <button   class="btn btn-light" v-print="'#printMe'">Print </button>

    <div class="card">
      <div class="card-body">
        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                   <select class="form-select select2"  @change="changeproject" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                   
        </div>
    </div>
    <div class="card">

<div class="card-body">

<div class="row">

  <div class="col-6">
    <ul class="list-group">
  <li class="list-group-item">Date :  {{currentTime}} </li>
  <li class="list-group-item">Project Name : {{data.name}} </li>
  <li class="list-group-item">location :    {{data.log}}  - {{data.lat}}</li>
  <li class="list-group-item">Bid Amount : {{data.bid_value}}</li>
  <li class="list-group-item">Project manger : </li>
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
       
      
        data(){
return{

data:{},
allerros:[],
projects:[],
project_id:'',
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
   url:'/managers/report/projectJson/'+this.project_id,
   method:'post',
   }).then(res=>{

    this.data = res.data.data

          })
          },

          project(){
   
   axios({
   url:'/selectproject',
   method:'get',
   }).then(res=>{
   
    
    res.data.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
this.projects.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

                this.projects.push(n[e])
                     })

                 }
                        })
   
   
   })
   },

          print () {
     
     this.$htmlToPaper('printMe');
   console.log( this.$htmlToPaper('printMe'))
   },

create(){
  window.$("#adz").modal("show"); 
},

open(data){
this.updating = data

      window.$("#deathEmployeeModal").modal("show"); 

},
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/admin/delete_project/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/admin/project_json?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
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


submit(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.name){
	 formData.append('name', this.name);
}

if(this.lat){
	 formData.append('lat', this.lat);
}

if(this.log){
	 formData.append('log', this.log);
}

  
    axios.post('/admin/post_project',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
      
       this.datas.data.push(res.data.data)
     
 window.$("#adz").modal("hide"); 
    })
},
submit1(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.updating.name){
	 formData.append('name', this.updating.name);
}

if(this.updating.lat){
	 formData.append('lat', this.updating.lat);
}


  
if(this.updating.log){
	 formData.append('log', this.updating.log);
}

axios.post('/admin/update_project/'+this.updating.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
       this.name = ''
             window.$("#deathEmployeeModal").modal("hide"); 

    })
},

addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 
 addpayment(){
    this.payment.push({})
},
removepayment(index){
this.payment.splice(index,1)
},
 

 },
        mounted() {
          this.currentTime = moment().format('DD/MM/YYYY');
          var future = moment(this.data.receive_date,'DD/MM/YYYY')
          
var start = moment(this.data.final_delivery_date,'DD/MM/YYYY')
 this.Remaing   =  moment.duration(start.diff(future)).asDays();

 this.to = moment().format('YYYY-MM-DD');
this.working_day = moment(this.data.receive_date, "YYYY-MM").daysInMonth()

this.project()
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
