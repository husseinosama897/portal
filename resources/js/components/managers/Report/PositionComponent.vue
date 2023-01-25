<template>
    <div class="row">
        
        <div class="card  mt-3">
                                 <div class="card-body">
                                   <form class=" align-items-center">
                                       <div class="row ">
                                         
                  

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


<div class="card">

 <div class="card-body">

   <chart-timesheet-performance  :data2="this.classificationAndcleaingdata" ></chart-timesheet-performance>

 </div>

</div>


                   <div class="col-lg-12 mt-3" v-for="(role,index) in roles" :key="index" >
           
                    <depending-on-role  :data="role" ></depending-on-role>
                     
                   </div>
 
               
         


                 
               </div>

</template>

<script>
 import moment from 'moment'
import Vue from 'vue'
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
overtimecheck:true,
weekends:'',
datas:{

},
allerros:[],

attending_leaving:'',
attending_time:'',


}

       },


computed:{

    roles(){
   var newData = []
this.customizing.forEach(e=>{

if(e.role){
    var role = e.laborer == 1 ? 'laborer' : e.role.name

         let item  = newData.find(user=>
 role  == user.name
)

var newTime = (Number(e.time ?? 0) + Number(e.over_time ?? 0)) 

if(item == undefined){
if(e.laborer == 1){

    newData.push({
        name:'laborer',
        data:[{time:newTime,amount:e.amount,name:e.name}],
        number:1
    })
}else{
    newData.push({
        name:e.role.name ?? 'unknown',
        data:[{time:newTime,amount:e.amount,name:e.name}],
        number:1
    })
}
    

}else{

    var num = (item.number + 1)

    Vue.set(item,'number',num)
item.data.push({time:newTime,amount:e.amount,name:e.name})

}


/*
if(item == undefined){
newData.push({
 name:e.role.name ,
 data:[
   
 [newTime,e.amount] 

 ]
})

}else{
 item.data.push([  newTime,e.amount ])
}
*/
}
})
 

return newData

 },


 classificationAndcleaingdata(){
   var newData = []
this.customizing.forEach(e=>{

         let item  = newData.find(user=>
 'team' == user.name
)

var newTime = (Number(e.time ?? 0) + Number(e.over_time ?? 0)) 
if(item == undefined){
newData.push({
 name:'team' ,
 data:[
   
 [newTime,e.amount] 

 ]
})

}else{
 item.data.push([  newTime,e.amount ])
}

})
 

return newData

 },


customizing(){
var newData = []
if(this.datas.data && this.datas.data.length > 0){
this.datas.data.forEach(e=>{
 if(e.contract){
  
    var time =(e.timesheet_project_personal_sum_time ?  e.timesheet_project_personal_sum_time : e.personal_overall_sum_time ) / 60
  time = time.toFixed(2)
    this.working_day = (moment(this.from, "YYYY-MM").daysInMonth() -  this.weekends)

var salaryPerDay = (Number(e.contract.salary_per_month ) / Number(this.working_day))
 salaryPerDay = salaryPerDay.toFixed(2)
 
var salaryperHour = (Number(salaryPerDay )  / 9 )

salaryperHour = salaryperHour.toFixed(2)

var overtime =    this.overtimecheck ? 0 :  (  Number(time) -  Number(9) > 0  ?   Number(time) -  Number(9) : 0 )
  overtime = overtime.toFixed(2)
  var Absence = 0
  if(e.Absence > 0){
  Absence = (Number(salaryperHour)  * Number(9) * Number(e.Absence))
  Absence = Absence.toFixed(2)
  }


  var amount = (Number(overtime) * salaryperHour + Number(time  <= 9 ? time : 9 ) *  Number(salaryperHour)  - Absence )
  amount = amount.toFixed(2)

newData.push({ time: time ?? 0 ,laborer:e.laborer, name:e.name,role:e.role ?? null ,id:e.id,Deduction:Absence , contract:e.contract , salaryperHour:salaryperHour ,salaryPerDay:salaryPerDay,overtime:overtime ?? 0 ,amount:amount ?? 0 })

 }


 })
}

 return newData
}

},
       methods:{


   datajson() {
       axios({
 method: 'post',
 url: '/managers/report/jsonpositionReport' ,
 data:{

from:this.from,
to:this.to,

}
})		.then(response => {
                   
             this.datas =  response.data
           this.weekends = response.data.weekends
               })
   },





},
       mounted() {
        this.from = moment().startOf('month').format('YYYY-MM-DD');
 this.to = moment().endOf('month').format('YYYY-MM-DD');
this.working_day = moment.duration(moment(this.to).diff(moment(this.from)));
this.working_day = (parseInt(this.working_day.asDays()) + 1)
    this.datajson()

       },
  
   }
</script>
