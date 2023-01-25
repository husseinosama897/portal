<template>
     <div class="row">
               
                    <div class="col-8">
            
                        <div class="card">
                            <div class="card-body">

                              

   

                                <div class="table-responsive">
                                  <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>name</strong></th>
                                                   
                                                <th><strong>project </strong></th> 
                                                <th><strong>Role</strong></th>
                                                <th><strong>Basic Salary</strong></th>   
                                                <th><strong>Salary / Day</strong></th>   
                                                <th><strong>Salary / Hour</strong></th>  
                                                <th><strong>Transportation Allowance</strong></th>
                                                <th><strong>Communication Allowance</strong></th>   
                                                <th><strong>Food Allowance</strong></th>
                                                <th><strong>Other Allowance</strong></th>   
                                                <th><strong>Working Hour on contract</strong></th>
                                                <th><strong>Working Hour</strong></th> 
                                                <th><strong>Over Time</strong></th> 
                                                <th><strong>Deduction</strong></th> 
                                               
                                                <th><strong>Amount</strong></th>   
                                          
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in customizing " :key="data.id">
                                              
                                                <td data-table="name">{{data.name}}</td>
                                                 <td data-table="project" v-if="data.contract && data.contract.project" >{{data.contract ? data.contract.project.name  : 'unknown'}}</td>
                                                 <td data-table="project" v-else> unknown</td>
                                                 <td data-table="Role" v-if="data.role" >{{data.role.name}}</td>
                                                 <td data-table="Role" v-else >unknown</td>
                                                 <td data-table="Basic Salary" v-if="data.contract">{{data.contract.salary_per_month}}</td>
                                                 <td data-table="Basic Salary" v-else>unknown</td>
                                                 <td data-table="Salary / Day" v-if="data.contract">{{data.salaryPerDay}}</td>
                                                 <td data-table="Salary / Day" v-else>unknown</td>

                                                 <td data-table="Salary / Hour" v-if="data.contract">{{data.salaryperHour}}</td>
                                                 <td data-table="Salary / Hour" v-else>unknown</td>

                                                 <td data-table="Transportation Allowance" v-if="data.contract">{{data.contract.Transportation_Allowance}}</td>
                                                 <td data-table="Transportation Allowance" v-else>unknown</td>


                                                 <td data-table="Communication Allowance" v-if="data.contract">{{data.contract.Communication_Allowance}}</td>
                                                 <td data-table="Communication Allowance" v-else>unknown</td>


                                                 <td data-table="Food Allowance" v-if="data.contract">{{data.contract.Food_Allowance}}</td>
                                                 <td data-table="Food Allowance" v-else>unknown</td>


                                                 <td data-table="Other Allowance" v-if="data.contract">{{data.contract.Other_Allowance}}</td>
                                                 <td data-table="Other Allowance" v-else>unknown</td>


                                                 <td data-table="Working Hour on contract" v-if="data.contract">{{data.contract.working_hours}}</td>
                                                 <td data-table="Working Hour on contract" v-else>unknown</td>


                                                <td data-table="Working Hour"   
                                            

                                                >{{

                                     data.time 
                                                }}</td>

<td data-table="OverTime" v-if="data.contract && data.time >= data.contract.working_hours">{{ data.overtime}}</td>
                                                 <td data-table="OverTime" v-else>0</td>

                                                 <td data-table="Deduction" v-if="data.Deduction > 0">{{data.Deduction}}</td>
                                                 <td data-table="Deduction" v-else>0</td>

                                                 <td data-table="Amount" v-if="data.contract">{{data.amount}}</td>
                                                 <td data-table="Amount" v-else>{{data.amount}}</td>
        
                                         
                                                 <td  data-table="ACTION">
		          
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    

    

        <a class="dropdown-item"  :href="'/managers/Laborer_edit/'+data.id">update</a>

     <a class="dropdown-item"  :href="'/managers/performance/'+data.id">report</a>

     

     <a class="dropdown-item" @click="attending(data)" href="#" data-toggle="modal" data-target="#exampleModal">  attendance : {{data.name}} </a>


     <a class="dropdown-item" @click="Salary_Approval(data)" href="#" data-toggle="modal" data-target="#exampleModal">  attendance : {{data.name}} </a>


   
  </div>
</div>
												</td>
                                            </tr>
								
								
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
				   
        <div class="col-4">
         <div class="card">

   <div class="card-body" >
     
    
        
        
           <apexchart type="bar" height="250" :options="chartOptions" :series="series"></apexchart>
       
     

        
         </div>
         </div>
       </div>


			

       

                  <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">total  : {{netSalaries }}</h4>
                     </div>
                  </div>
               </div>
            </div> 
                </div>

</template>

<script>
  import moment from 'moment'
    export default {
        props:['staff','netSalaries','budget_expenses','date'],
        data(){
return{
 projects:[],
 project_id:'',
 SearchLaborer:'',
 total:this.netSalaries,
 to:'',
 working_day:'',
 
           series: [
                    {  name: 'budget',
            data: [this.budget_expenses.budget]
          }, {
            name: 'expenses',
            data: [this.netSalaries]
          }, 

           ],

 
        chartOptions: {
            chart: {
              type: 'bar',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: ['staff', 'expenses'],
            },
            yaxis: {
              title: {
                text: '$ (thousands)'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return "$ " + val + " thousands"
                }
              }
            }
          },
          

datas:this.staff,
allerros:[],

real_cycle:[
  {step:1,name:'Procurement Manger' ,class:2},
  {step:2,name:"Projects Manger",class:3},
  {step:3,name:'Financial manager',class:4},
  
],

}

        },


computed:{

  customizing(){
 var newData = []
 if(this.staff ){
 this.staff.forEach(e=>{
  if(e.user){
   
     var time =(e.user.timesheet_project_personal_sum_time   / 60 ) 
 time = time.toFixed(2)

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


  var amount = (Number(overtime) * salaryperHour + Number(time) *  Number(salaryperHour)  - Absence )
  amount = amount.toFixed(2)


  newData.push({ time: time , name:e.user.name ,id:e.id,Deduction:Absence , contract:e , salaryperHour:salaryperHour ,salaryPerDay:salaryPerDay,overtime:overtime ,amount:amount })

  }
    




  })
 }
 
  return newData
}
},
        methods:{
                                                    projectz(){
    
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

          syc(cycle){

this.real_cycle.forEach(e=>{
cycle.forEach(z=>{

if(z.role.name == e.name){
  console.log(z)
  if(z.status == 1){
 Vue.set(e,'status',1)
  }
   if(z.status == 2){
 Vue.set(e,'status',2)
  }
   if(z.status == 0){
 Vue.set(e,'status',0)
  }
 
}

})


})

},

dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/Laborer_delete/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/jsonlaborer?page=' + page,
data:{
   project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.SearchLaborer,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

   data_laborer_search() {
		axios({
  method: 'post',
  url: '/managers/SearchLaborer' ,
data:{
 project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.SearchLaborer,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


    datajson() {
		axios({
  method: 'get',
  url: '/managers/jsonlaborer' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
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
}
 
 },
        mounted() {
  //   this.datajson()
   //  this.projectz()

   var from = moment(this.date).format('YYYY-MM-DD');

this.working_day = moment(from, "YYYY-MM").daysInMonth()

        },
   
    }
</script>
