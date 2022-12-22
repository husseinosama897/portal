<template>
  <div >
    <button   class="btn btn-light" v-print="'#printMe'">Print </button>



            <div class="row" id="printMe" >
   
            <div class="row">
              <div class="col-lg-6">
            
            <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                              <th>country</th>
                                              <th>salary</th>
                                             
                                              <th>number</th>
                                              <th>time</th>
                                              <th>per hour(s)</th>
                                              </tr>
                                              </thead>

                 <tr  v-for="country in contries"  :key="country.salary_per_month" >
                  
                 <td>{{country.country}}</td> 

                 <td>{{country.salary_per_month}}</td>
                  
                

                  <td>{{country.number}}</td>

                  <td>{{country.time}}</td>

                  <td>{{country.perhour}}</td>


                      </tr> 
                </table>
                </div>

              </div>

         </div>
       
</div>
</div>

<div class="row">
              <div class="col-lg-6">
            
            <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                              <th>age</th>
                                              <th>salary</th>
                                         
                                              <th>number</th>
                                              <th>hours</th>

                                              <th>per hour(s)</th>

                                              </tr>
                                              </thead>

                 <tr  v-for="age in ages"  :key="age.salary_per_month" >
                  
                 <td>{{age.age}}</td> 
                 <td>{{age.salary_per_month}}</td>
                  
                 
                  <td>{{age.number}}</td>
                  <td>{{age.time}}</td>

                  <td>{{age.perhour}}</td>

                      </tr> 
                </table>
                </div>

              </div>

         </div>
       
</div>
</div>

<div class="row">
              <div class="col-lg-6">
            
            <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                              <th>age</th>
                                              <th>salary</th>
                                         
                                              <th>number</th>
                                              <th>time</th>
                                              <th>per hour(s)</th>
                                              </tr>
                                              </thead>

                 <tr  v-for="rol in role"  :key="rol.salary_per_month" >
                  
                 <td>{{rol.role}}</td> 
                 <td>{{rol.salary_per_month}}</td>
                  
                 
                  <td>{{rol.number}}</td>
                  <td>{{rol.time}}</td>

                  <td>{{rol.perhour}}</td>

                      </tr> 
                </table>
                </div>

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
       
      
        data(){
return{

data:[],
allerros:[],
projects:[],
project_id:'',
currentTime:'',
Remaing:'',
name:'',
lat:'',
role:[],
to:'',
working_day:'',
contries:[],
ages:[],
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
     
          scalingData()
{
var contern = 0




  this.data.forEach(e=>{

// ------------------ counties average ------------------------------
    if(e.contract){
      var current = moment();//now
var contract_date = moment(e.contract.contract_date).format("YYYY-MM-DD")
var diff = current.diff(contract_date, 'months')

let item  = this.contries.find(country=>
  e.contract.country == country.country
)


if(item == undefined){
  var min = (e.attending_and_leaving_sum_min ) / 60 
     var time =   (e.attending_and_leaving_sum_time_difference  )  + (min) 
 time = Math.round(time)

var salary_per_month = (Number(e.contract.salary_per_month) * Number(diff))

var perhour = (Number(salary_per_month) / Number(time))
  this.contries.push({time:time,country:e.contract.country,salary_per_month:salary_per_month,number:1,perhour:perhour})
}else{

  var min =  (e.attending_and_leaving_sum_min ) / 60  
     var time =  (e.attending_and_leaving_sum_time_difference  )  + (min)  
 time = Math.round(time)




 time = Math.round(Number(item.time) + time / item.number)



  Vue.set(item,'number',(Number(item.number) + 1))


 var  salary_per_month = Number(e.contract.salary_per_month) * Number(diff)

  Vue.set(item,'salary_per_month',(Number(item.salary_per_month) + salary_per_month))
 var perhour = ( Number(item.salary_per_month)  / item.time)
perhour = perhour.toFixed(2)

Vue.set(item,'perhour',(Number(perhour)))


  Vue.set(item,'time',time )


  
}



// ----------------------------- end countries ----------------------------------

var current = moment();//now
var birthday = moment(e.contract.age);
var diff2 = current.diff(birthday, 'years')
 diff2 = (Math.round(diff2 / 10) * 10)


let age  = this.ages.find(age=>
  diff2 == age.age 
)


if(age == undefined){


  var min = (e.attending_and_leaving_sum_min ) / 60 
     var time =   (e.attending_and_leaving_sum_time_difference  )  + (min) 
 time = Math.round(time)
var perhour = (Number(time) / Number(e.contract.salary_per_month)  *  Number(diff))
var  salary_per_month = Number(e.contract.salary_per_month) * Number(diff)
  this.ages.push({ time:time,age:diff2,salary_per_month:salary_per_month ,number:1,perhour:perhour})
}else{



  var min = ( e.attending_and_leaving_sum_min ) / 60 
     var time =   (e.attending_and_leaving_sum_time_difference  )  + (min)  
 time = Math.round(time)



time = Math.round(Number(age.time) + time / age.number)


 Vue.set(age,'time',time)


  Vue.set(age,'number',(Number(age.number) + 1))
  var  salary_per_month = Number(e.contract.salary_per_month) * Number(diff)

  Vue.set(age,'salary_per_month',(Number(age.salary_per_month) + Number(salary_per_month) * diff))

  var average =  (Number(age.salary_per_month) / Number(age.number))
var perhour = (Number(age.salary_per_month) / Number(age.time) )
perhour = perhour.toFixed(2)
Vue.set(age,'perhour',(Number(perhour)))





 
}

//---------------------- * * *  role * * * -------------------------


let role  = this.role.find(role=>
  e.role.name == role.role
)


if(role == undefined){
  var min = (e.attending_and_leaving_sum_min ) / 60 
     var time =   (e.attending_and_leaving_sum_time_difference  )  + (min) 
 time = Math.round(time)

var perhour = ( Number(time) / Number(e.contract.salary_per_month) * diff)
  this.role.push({time:time,role:e.role.name,salary_per_month:e.contract.salary_per_month * diff,number:1,perhour:perhour})
}else{

  var min =  (e.attending_and_leaving_sum_min ) / 60  
     var time =  (e.attending_and_leaving_sum_time_difference  )  + (min)  
 time = Math.round(time)



 time = Math.round(Number(role.time) + time / role.number)



  Vue.set(role,'number',(Number(role.number) + 1))


  var  salary_per_month = Number(e.contract.salary_per_month) * Number(diff)

  Vue.set(role,'salary_per_month',(Number(role.salary_per_month) + Number(salary_per_month) * diff))


  Vue.set(role,'time',time )

  var perhour = (Number(role.salary_per_month) / Number(role.time))
perhour = perhour.toFixed(2)
  Vue.set(role,'perhour',(Number(perhour) ))



  
}





   }

  

  })


 
  this.ages.sort(function(a, b){return a.perhour - b.perhour});
  this.contries.sort(function(a, b){return a.perhour - b.perhour});

  this.role.sort(function(a, b){return a.perhour - b.perhour});
},
      
          project(){
   axios({
   url:'/managers/report/analysis_HR_JSON',
   method:'get',
   }).then(res=>{


    res.data.data.forEach(n=>{
      if(Array.isArray(n)){
         n.forEach(z=>{
          
          if(Array.isArray(z)){
        z.forEach(h=>{
          this.data.push(h)
        })

          }else{

            this.data.push(z)
          }

    })
        
  }else{
   Object.keys(n).map((e)=>{

this.data.push(n[e])

     })

 }


  })

  this.scalingData()
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
  

        }

    }
</script>
