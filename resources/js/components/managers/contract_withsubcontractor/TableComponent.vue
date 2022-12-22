<template>
  <div >
    <div class="card">
<div class="card-body">
  <div class="row">
<div class="col-4">
  <label for="password" class="form-label">
    PO
  </label>
  <input type="text" class="form-control input-default " v-model="ref" placeholder="to">
</div>

<div class="col-4">
  <label for="password" class="form-label">
   date 
  </label>
  <input type="date" class="form-control input-default " v-model="date" placeholder="to">
</div>



<div class="col-4">
  <label for="password" class="form-label">
    project  
  </label>
  <select  class="form-select select2" v-model="project_id">
    <option ></option>
  <option v-for="proj in projects"  :value="proj.id" :key="proj.id">{{proj.name}}</option>
  </select>
</div>

<div class="col-4">
  <label for="password" class="form-label">
    user  
  </label>
  <select  class="form-select select2" v-model="user_id">
    <option ></option>
  <option v-for="user in users" :value="user.id" :key="user.id">{{user.name}}</option>
  </select>
</div>



</div>

</div>

    </div>

     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                    <a href="/managers/workflowcws" class="btn btn-primary" >

                      Setting

                    </a>
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                 <th><strong>User</strong></th>
                                                 <th><strong>contractor</strong></th>
                                                 <th><strong>total</strong></th>
                                    
                                                <th><strong>STATUS</strong></th>
                                        
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.contract_withsubcontractor">  
                                                <td data-table="CODE">{{data.contract_withsubcontractor.ref}}</td>
                                                <td data-table="DATE">{{data.contract_withsubcontractor.date}}</td>
                                                                <td data-table="USER" v-if=" data.contract_withsubcontractor.user ">{{data.contract_withsubcontractor.user.name}}</td>
                                   
                                                              <td data-table="contractor" v-if="data.contract_withsubcontractor.contractor">{{data.contract_withsubcontractor.contractor.contractor_name ? data.contract_withsubcontractor.contractor.contractor_name : data.contract_withsubcontractor.contractor.comp }}</td>
                                       
                                       <td data-table="contractor" v-else>undefined</td>
                  
                                       <td data-table="total" >{{data.contract_withsubcontractor.total}}</td>

                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>

                                                 <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    
      <a class="dropdown-item" :href="'/managers/update_CWS/'+data.contract_withsubcontractor.id">update</a>
    

      <a class="dropdown-item" :href="'/managers/preview_CWS/'+data.contract_withsubcontractor.id">preview</a>
    

      


  </div>
</div>
												</td>
                        </template>
                                            </tr>
								
					

                                        </tbody>
                                    </table>
                                    <pagination :data="datas" @pagination-change-page="getResults"></pagination>
                                </div>
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
allerros:[],
images:[],
projects:[],
date:'',
users:[],
project_id:'',
user_id:'',
ref:'',
}

        },

        methods:{
          user(){
    
    axios({
        url:'/CHunking_user',
        method:'get',
    }).then(res=>{
        
         
         
    
                        res.data.data.forEach(n=>{
                          if(Array.isArray(n)){
                             n.forEach(z=>{
    this.users.push(z)
                        })
                      }    else{
    
    let vm = []
    
                       Object.keys(n).map((z)=>{
    
                    this.users.push(n[z])
                         })
    
                     }
                            })
                 
    
    })
    },




          getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/returnjsonCWS?page=' + page,
  data:{
  ref:this.ref,
date:this.date,

project_id:this.project_id,
user_id:this.user_id,

}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/managers/returnjsonCWS' ,
  data:{
  ref:this.ref,
date:this.date,
project_id:this.project_id,
user_id:this.user_id,

}

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },




dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_subcontractor_data/'+data.id,
    method:'post',
}).then(res=>{
this.data.data.splice(index,1)
this.$delete(this.data.data,index)
 
})

      }
},




 

 
 },
        mounted() {
     this.datajson()
     this.user()
   
        },

        watch:{
          'ref':function(){
            this.datajson()
          } ,
'date':function(){
            this.datajson()
          } ,

'project_id':function(){
            this.datajson()
          } ,
'user_id':function(){
            this.datajson()
          } ,

        }
      
    }
</script>
