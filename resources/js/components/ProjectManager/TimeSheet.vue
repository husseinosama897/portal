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
