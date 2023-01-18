<template>


    <div >
<div class="row mt-4">
        <div class="card">
            <h6 class="card-header"> filter </h6>
     <div class="card-body">
        <div class="row">
               <div class="col-4">
                <label for="password" class="form-label"> project</label>
                <select  v-model="project_id" class="form-control">
  <option  ></option>
  <option  v-for="project in projects" :value="project.id" :key="project.id" >{{project.name}}</option>
</select>

               </div>
               <div class="col-4">
                <label for="password" class="form-label"> from</label>
                <input  type="date" v-model="from" class="form-control">
  

               </div>
               <div class="col-4">
                <label for="password" class="form-label"> to</label>
                <input type="date"  v-model="to" class="form-control">
  

               </div>
            </div>
        </div>
    </div>
</div>
        


<div class="row">

<div class="col-12" v-if="datas.project_overall.length > 0">
    <div class="card">
        <div class="card-body">
        <chart-project-overall  :data2="datas.project_overall"  ></chart-project-overall>
    </div>
</div>
    </div>
    
    <div class="col-12" v-if="datas.project_overall.length > 0">
    <div class="card">
        <div class="card-body">
        <chart-out-in  :data2="datas.project_overall"  ></chart-out-in>
    </div>
</div>
    </div>

    
    </div>

    <div class="row">

<div class="col-6" v-if="datas.project_overall.length > 0">
    <div class="card">
        <div class="card-body">
        <attendace-project-hours  :data2="datas.project_overall"  ></attendace-project-hours>
    </div>
</div>
    </div>
    <div class="col-6" v-if="datas.project_overall.length > 0">
        <div class="card">
        <div class="card-body">
        <charts-percentage-attendance  :data2="datas.project_overall" ></charts-percentage-attendance>
    </div>
</div>
    </div>

    </div>

    <div class="row">

        <div class="col-6" v-if="datas.project_overall.length > 0">
        <div class="card">
        <div class="card-body">
    <chart-percentage-performance  :data2="datas.project_overall"  ></chart-percentage-performance>

    </div>
</div>
</div>


<div class="col-6" v-if="datas.project_overall.length > 0">
        <div class="card">
        <div class="card-body">
    <chart-point-performance  :data2="datas.project_overall"   ></chart-point-performance>

    </div>
</div>
</div>
   

    </div>

         <!--- <project-months  :data="data" ></project-months > -->

   


                 
               </div>

</template>

<script>
 import moment from 'moment'

   export default {
     props:['projects'],
       data(){
return{
 
projects:[],
project_id:'',
to:'',
from:'',
datas:{
    project_overall:[]
},



}

       },


       methods:{

        

        project_search() {
       axios({
 method: 'post',
 url: '/managers/report/project_search' ,
 data:{

project_name:this.project_name,

}
})		.then(response => {
                   
             this.projects =  response.data.data
           
               })
   },

   datajson() {
       axios({
 method: 'post',
 url: '/project_manager/report/jsonprojectReport' ,
 data:{
from:this.from,
to:this.to,
project_id:this.project_id
}
})		.then(response => {
          
             this.datas =  response.data.data
        
          
              this.$eventbus.$emit('event',{data:this.datas.project_overall})
               })
   },





},
       mounted() {
        this.from = moment().startOf('month').format('YYYY-MM-DD');
 this.to = moment().endOf('month').format('YYYY-MM-DD');
this.working_day = moment.duration(moment(this.to).diff(moment(this.from)));
this.working_day = (parseInt(this.working_day.asDays()) + 1)
 
       },
  
    watch:{
        'project_id':function(){
            this.datajson()
        }
    }

   }
</script>
