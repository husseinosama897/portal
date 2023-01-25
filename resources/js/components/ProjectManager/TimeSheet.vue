<template>
     <div class="row">


                  <div class="card  mt-3">
                                  <div class="card-body">
                                    <form class=" align-items-center">
                                        <div class="row ">
                                          <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday"> project</label>
                                          <select  v-model="project_id" class="form-control">
  <option  ></option>
  <option  v-for="project in projects" :value="project.id" :key="project.id" >{{project.name}}</option>
</select></div>

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday"> user</label>
                                                <input @input="datajson"  v-model="employee" type="text" id="birthday" name="birthday" class="form-control">

                                            </div>
                              

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">from</label>
                                                <input  v-model="from" @input="datajson" type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label>to</label>
                                                <input v-model="to" @input="datajson" type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                       
                                       
                              
                                     
                                       </div>
                                    </form>
                                </div>
                                  </div>


                                  <div class="col-lg-12">
            
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
                                    <th><strong>CheckBoxOver Time</strong></th> 
                                    <th><strong>Over Time</strong></th> 
                                    <th><strong>Deduction</strong></th> 
                                   
                                    <th><strong>Amount</strong></th>   
                              
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in updated " :key="data.id">
                                  
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


<td data-table="CheckBoxOverTime" >   <input   v-model="data.overtimecheck" class="form-check-input" type="checkbox"> 
</td>
<td data-table="OverTime" >{{ data.overtime}}</td>
                                 

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
                          <pagination :data="datas" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>

				
       

                  


                  
                </div>

</template>

<script>
  import moment from 'moment'
    export default {
      props:['projects'],
        data(){
return{

 project_id:'',
 employee:'',
 working_day:'',
 from:'',
 to:'',
 userapprovel:{},
 divide:'',
 newData2:[],
datas:{

},
allerros:[],

attending_leaving:'',
attending_time:'',


}

        },


computed:{

  updated(){


this.newData2.forEach(e=>{

var overtime = 0


if(e.overtimecheck  == false && e.time > 0 ){
overtime =(Number(e.time) - (e.personal_overall_sum_num_of_attendance * 9)   > 0  ?  Number(e.time) -  (e.personal_overall_sum_num_of_attendance * 9)   : 0 )
} 

overtime = overtime.toFixed(2)

Vue.set(e,'overtime',overtime)

if( e.time > 0 ){
var defaultt = ( Number(e.time) - Number(e.personal_overall_sum_num_of_attendance) * 9   )  > 0  ? ( Number(e.time) - Number(e.personal_overall_sum_num_of_attendance) * 9   ) : 0

var overall =  Number(e.time ) - Number(defaultt) > 0 ? Number(e.time ) - Number(defaultt) : 0

var amount = (Number(overtime) * e.salaryperHour + Number(overall  )   *  Number(e.salaryperHour)  - e.Deduction )
amount = amount.toFixed(2)




Vue.set(e,'amount',amount)
}


})

return this.newData2


},



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
  method: 'post',
  url: '/project_manager/timesheet/jsontimesheet?page=' + page,
data:{
   project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            this.working_day = response.data.weekends
            this.customizing()
                })
    },







    datajson() {
		axios({
  method: 'post',
  url: '/project_manager/timesheet/jsontimesheet' ,
  data:{
 project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
              this.working_day  = response.data.weekends
              this.customizing()
                })
    },


 
 
  
    customizing(){
this.newData2 = []
 if(  this.datas.data && this.datas.data.length > 0){
 
 this.datas.data.forEach(e=>{
  if(e.contract){
   
     var time =(e.timesheet_project_personal_sum_time  ?  (e.timesheet_project_personal_sum_time  / 60) : (e.personal_overall_sum_time / 60) )
     
time = time.toFixed(2)

var days = (Number(this.working_day)  - Number(this.weekends))

 var salaryPerDay = (Number(e.contract.salary_per_month ) / days )
  salaryPerDay = salaryPerDay.toFixed(2)
  
 var salaryperHour = (Number(salaryPerDay )  / 9 )

 salaryperHour = salaryperHour.toFixed(2)
 var overtime = 0


if(e.overtimecheck  == false){
   overtime =( Number(time) - Number(e.personal_overall_sum_num_of_attendance) * 9   )  > 0  ? ( Number(time) - Number(e.personal_overall_sum_num_of_attendance) * 9   ) : 0
} 

  overtime = overtime.toFixed(2)

  var Absence = 0
  if(e.Absence > 0){
  Absence = (Number(salaryperHour)  * Number(9) * Number(e.Absence))
  Absence = Absence.toFixed(2)
  }


  var defaultt = ( Number(time) - Number(e.personal_overall_sum_num_of_attendance) * 9   )  > 0  ? ( Number(time) - Number(e.personal_overall_sum_num_of_attendance) * 9   ) : 0
  
var overall =  Number(time ) - Number(defaultt) > 0 ? Number(time ) - Number(defaultt) : 0
  var amount = (Number(overtime) * salaryperHour +   overall   *  Number(salaryperHour)  - Absence )
  amount = amount.toFixed(2)

  this.newData2.push({ time: time ?? 0,overtimecheck:true ,personal_overall_sum_num_of_attendance :e.personal_overall_sum_num_of_attendance , name:e.name,role:e.role ,id:e.id,Deduction:Absence , contract:e.contract , salaryperHour:salaryperHour ,salaryPerDay:salaryPerDay,overtime:overtime ?? 0 ,amount:amount ?? 0 })

  }


  })
 }



},

 },
        mounted() {

          this.from = moment().startOf('month').format('YYYY-MM-DD');
 this.to = moment().endOf('month').format('YYYY-MM-DD');


     this.datajson()
  
        },
   

        watch:{
        'project_id':function(){
          this.datajson()

        }
       }

    }
</script>
