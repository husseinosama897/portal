<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                   <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>The_scope_of_work</strong></th>
                                                <th><strong>supervisor</strong></th>
                                                <th><strong>project</strong></th>
                                              
                                                <th><strong>STATUS</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data" :key="data.id">
                                              
                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                <td data-table="DESCRIPTION">{{data.The_scope_of_work}}</td>
                                                <td data-table="supervisor" v-if="data.supervisor">{{data.supervisor.name}}</td>
                                                <td data-table="supervisor" v-else>unknown</td>
                                                <td data-table="project" v-if="data.project">{{data.project.name}}</td>
                                                <td data-table="project" v-else>unknown</td>
                                                 <td data-table="STATUS" v-if="data.status == 2"><button type="button"   class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh"> REJECTED</button></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><button type="button"   class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">ACCEPTED</button></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><button type="button"     class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">BENDING</button></td>

                                                <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" @click="dele(data,index)"  href="#">delete</a>
    <a class="dropdown-item" :href="'/managers/daily_report/edit/'+data.id">edit</a>
    <a class="dropdown-item" :href="'/managers/daily_report/preview/'+data.id">preview</a>
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
    export default {
    
    
        data(){
return{

datas:{},


}

        },

        methods:{




dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/managers/daily_report/delete/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/daily_report/json_daily_Report?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson() {
		axios({
  method: 'post',
  url: '/managers/daily_report/json_daily_Report' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


 },
        mounted() {
     this.datajson()
       
    
    
    },
   
    }
</script>
