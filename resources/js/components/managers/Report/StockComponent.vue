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

   

  

            <div class="row" id="printMe" >
   
            
              <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">

                  



                    <div class="table-responsive">
                        <table  CELLPADDING="0" CELLSPACING="0" id="basic-datatable" class="table table-bordered  dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                  <th rowspan="0" >Po</th>
                                  <th rowspan="0" >delivery_date</th>
                                  <th rowspan="0" >date</th>
                                 
                            
                                  <th>name</th>
                                
                                  </tr>
                                  </thead>
                                  <tbody>
<tr v-for="dat in data" :key="dat.id" >
  <td :ROWSPAN="dat.rowspan" v-if="dat.po">{{dat.po}}</td>
  <td :ROWSPAN="dat.rowspan" v-if="dat.delivery_date">{{dat.delivery_date}}</td>

  <td :ROWSPAN="dat.rowspan" v-if="dat.date">{{dat.date}}</td>
 

<td>{{dat.name}}</td>

</tr>
                               
                                  </tbody>
                                  </table>
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
   url:'/managers/report/stockJson/'+this.project_id,
   method:'post',
   }).then(res=>{

    this.data = []

  res.data.data.purchase_order.forEach(e=>{

    e.attributes.forEach(attributes=>{
      var name = attributes.name ?? attributes.dis
this.data.push({name:name , delivery_date:e.delivery_date,date:e.date,po:e.ref,rowspan:e.attributes.length + e.attributes2.length})
    })
var start = 0

    e.attributes2.forEach(attributes=>{
      var name = attributes.name ?? attributes.dis
      if(e.attributes.length == 0){
    

if(start == 0){
  this.data.push({name:name , delivery_date:e.delivery_date,date:e.date,po:e.ref,rowspan:e.attributes.length + e.attributes2.length})
    start = 1  
}else{
  this.data.push({name:name})
}
       
      
      }else{
        this.data.push({name:name , delivery_date:e.delivery_date,date:e.date,po:e.ref})
      }

    })


  })

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
      
     

    }
</script>
