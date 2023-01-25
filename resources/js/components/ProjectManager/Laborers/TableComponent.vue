<template>
  <div class="row">
   <div class="card  mt-3">
                               <div class="card-body">
                                 <form class=" align-items-center">
                                     <div class="row ">
                                       
                                         <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                             <label for="birthday">name </label>
                                             <input @input="datajson"  v-model="employee" type="text" id="birthday" name="birthday" class="form-control">

                                         </div>
                                          <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                              <label for="birthday">projects </label>
<div class="form-group">
                               <select class="form-select select2" @change="datajson" v-model="project_id">
                           <option  value=""></option>
                              <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
 color: #000;">{{project.name}}</option>
                           </select>
                        </div>
                        </div>

                          



                                  
                                    </div>
                                 </form>
                             </div>
                               </div>


                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table datatable-button-print-basic">
                                     <thead>
                                         <tr>
                                          
                                             <th><strong>name</strong></th>
                                          
                                          
                                          
                                             <th></th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr v-for="data in datas.data " :key="data.id">
                                           
                                  
                                             <td data-table="name"><a href="#">{{data.name}}</a></td>
                               
                                                                  <td  data-table="ACTION">

<div class="dropdown">
<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
ACTION
</a>

<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

<a class="dropdown-item" :href="'/project_manager/laborer/edit/'+data.id"  >edit</a>
 
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

 from:'',
 to:'',

datas:{

},


}

        },



        methods:{




    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/project_manager/laborer/json?page=' + page,
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
  url: '/project_manager/laborer/json' ,
  data:{
 project_id: this.project_id,
 from:this.from,
 to:this.to,
 name:this.employee,
}
})		.then(response => {
                    

this.working_day = moment.duration(moment(this.to).diff(moment(this.from)));
this.working_day = (parseInt(this.working_day.asDays()) + 1)

              this.datas =  response.data.data
            
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
