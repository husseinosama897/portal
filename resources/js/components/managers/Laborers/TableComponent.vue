<template>
     <div class="row">
                  <div class="card  mt-3">
                                  <div class="card-body">
                                    <form class=" align-items-center">
                                        <div class="row ">
                                          
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">اسم العامل</label>
                                                <input @input="datajson"  v-model="employee" type="text" id="birthday" name="birthday" class="form-control">

                                            </div>
                                             <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                 <label for="birthday">المشروع </label>
   <div class="form-group">
                                  <select class="form-select select2" @change="datajson" v-model="project_id">
                              <option  value=""></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                           </div>
                           </div>

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">من</label>
                                                <input  v-model="from" @input="datajson" type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label>إلي</label>
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
                                      <pagination :data="datas" @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
				
                    	
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">salary apprval for {{userapprovel.name}}   </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST"  v-on:submit.prevent="Salary_Approval_step2()" enctype="multipart/form-data">
      
      <div class="modal-body">
      
        

        <div class="row">


          <span>{{ this.from | moment("MMMM Do YYYY") }}</span>
          <div class="form-group row mb-2">
<input v-model="userapprovel.salaryPerDay"   readonly class="form-control">
            </div>

            <div class="form-group row mb-2">
<input v-model="userapprovel.salaryperHour"  readonly class="form-control">
            </div>
            <div class="form-group row mb-2">
<input v-model="working_day"  readonly class="form-control">
            </div>
            <div class="form-group row mb-2">
<input v-model="userapprovel.time" readonly class="form-control">
            </div>
       
            <div class="form-group row mb-2">
<input v-model="userapprovel.Deduction" readonly class="form-control">
            </div>
       
            <div class="form-group row mb-2">
<input v-model="userapprovel.Amount" class="form-control">
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
     
      </div>

    </form>
    </div>

  </div>
</div>
                  

				
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form method="POST"  v-on:submit.prevent="attendance_user()" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">attendance </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div class="modal-body">
      
        <div class="row">


          <div class="col">
            <label for="name" class="col-md-2 col-form-label text-md-right">attending_time</label>
            <input  type="datetime-local" class="form-control  " v-model="attending_time"  >
          </div>
          <div class="col">
            <label for="name" class="col-md-2 col-form-label text-md-right">attending_leaving</label>
            <input  type="datetime-local" class="form-control  " v-model="attending_leaving"  >

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
     
      </div>

  
    </div>
</form>
  </div>
</div>
                  


                  
                </div>

</template>

<script>
  import moment from 'moment'
    export default {
      
        data(){
return{
 projects:[],
 project_id:'',
 employee:'',
 working_day:'',
 from:'',
 to:'',
 userapprovel:{},
 divide:'',

datas:{

},
allerros:[],

attending_leaving:'',
attending_time:'',


}

        },


computed:{



customizing(){
 var newData = []
 if(this.datas.data && this.datas.data.length > 0){
 this.datas.data.forEach(e=>{
  if(e.contract){
    var min = (e.attending_and_leaving_sum_min ) / 60
     var time =(e.attending_and_leaving_sum_time_difference  )  + (min)
 time = Math.round(time)

 var salaryPerDay = (Number(e.contract.salary_per_month ) / Number(this.working_day))
  salaryPerDay = salaryPerDay.toFixed(2)
  
 var salaryperHour = (Number(salaryPerDay )  / 9 )

 salaryperHour = salaryperHour.toFixed(2)

  var overtime = ( Number(time)  - Number(e.contract.working_hours))
  overtime = overtime.toFixed(2)
  var Absence = 0
  if(e.Absence > 0){
  Absence = (Number(salaryperHour)  * Number(e.contract.working_hours) * Number(e.Absence))
  Absence = Absence.toFixed(2)
  }


  var amount = (Number(overtime) * salaryperHour + Number(time) *  Number(salaryperHour)  - Absence )
  amount = amount.toFixed(2)

newData.push({ time: time , name:e.name ,id:e.id,Deduction:Absence , contract:e.contract , salaryperHour:salaryperHour ,salaryPerDay:salaryPerDay,overtime:overtime ,amount:amount })

  }


  })
 }
 
  return newData
}

},
        methods:{

          
          attendance_user(){
  axios({
  method: 'post',
  url: '/managers/attendance/'+this.specific_user.id ,
  data:{
    attending_leaving: moment(this.attending_leaving).format('YYYY-MM-DD HH:mm:ss') ,
attending_time:moment(this.attending_time).format('YYYY-MM-DD HH:mm:ss')
,

  }

})		.then(response => {
                   window.$("#exampleModal").modal("hide"); 
              
            
                })
},

          attending(data){
            this.specific_user = {}    
            this.specific_user = data
          },


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
  url: '/managers/jsonlaborer?page=' + page,
data:{
   project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

   data_laborer_search() {
		axios({
  method: 'post',
  url: '/managers/employee' ,
data:{
 project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


    Salary_Approval(data)
{

  this.userapprovel = {}

  this.userapprovel = data
  window.$("#salaryModal").modal("show"); 
},
    Salary_Approval_step2(){

axios({
  url:'/managers/salaries/salary_approval',
  method:'post',
  data:{
    user_id:this.userapprovel.id,
            month:moment(this.from).format('YYYY-MM-DD'),
          salary_day:this.userapprovel.salaryPerDay,
      salary_Hour:this.userapprovel.salaryperHour,
      working_days:this.working_day,
      working_hour:this.userapprovel.time,
     over_time:this.userapprovel.overtime,
   Deduction:this.userapprovel.Deduction,
     Amount:this.userapprovel.Amount,
  }
})

    },
 



    datajson() {
		axios({
  method: 'post',
  url: '/managers/jsonlaborer' ,
  data:{
 project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


 
 
 
 },
        mounted() {

          this.from = moment().startOf('month').format('YYYY-MM-DD');
 this.to = moment().endOf('month').format('YYYY-MM-DD');
this.working_day = moment(this.from, "YYYY-MM").daysInMonth()

     this.datajson()
     this.projectz()
        },
   
    }
</script>
