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
                                           
                                             
                                                <th><strong>STATUS</strong></th>
                                            
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr v-for="(data) in datas.data" :key="data.id">
                                            <td data-table="CODE">{{data.ref}}</td>
                                          
                                            <td data-table="DATE">{{data.date}}</td>
                                          
                                            <td data-table="contractor" v-if="data.contractor">{{data.contractor.contractor_name ? data.contractor.contractor_name : data.contractor.comp }}</td>
                                       
                                            <td data-table="contractor" v-else>undefined</td>
                                    <td  data-table="user"  v-if="data.user" >{{data.user.name}}</td>
                                   
                                    <td  data-table="user"  v-else >undefined</td>

                                            <td data-table="total" >{{data.total}}</td>

                                            <td data-table="STATUS" v-if="data.status == 2">
                                              <button type="button"  @click="syc(data.contract_withsubcontractor_cycle)"  class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh"> REJECTED</button>
                                            </td>
                                            <td data-table="STATUS"  v-if="data.status == 1">
                                              <button type="button"  @click="syc(data.contract_withsubcontractor_cycle)" class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">ACCEPTED</button>
                                            </td>
                                            <td data-table="STATUS" v-if="data.status == 0">
                                              <button type="button"   @click="syc(data.contract_withsubcontractor_cycle)"  class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">BENDING</button>
                                            </td>
                                     
                                            <td  data-table="ACTION">
                                                <div class="dropdown">
                                                  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  ACTION
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    
    
                                                    <a class="dropdown-item" :href="'/cws/preview/'+data.id">preview </a>
    
                                                    

                                                    <a class="dropdown-item" :href="'/user/index_subcontractor_inv/'+data.id"> invoices</a>
    
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
				
				

                    <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="hhh" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
    </div>
  </div>
</div>

                </div>

</template>

<script>
export default {
props:['workflow'],
data(){
return{
datas:{},
allerros:[],
real_cycle:[],
}
},

methods:{

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

  updatedata(){
     this.workflow.flowwork_step.forEach(e=>{
      this.real_cycle.push({id:e.role.id,name:e.role.name})
     })
    
	},
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/cws/delete/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/cws/returnasjson?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson() {
		axios({
  method: 'get',
  url: '/cws/returnasjson/' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


 
 
 },
        mounted() {
     this.datajson()
     this.updatedata()       
        },
   
    }
</script>
