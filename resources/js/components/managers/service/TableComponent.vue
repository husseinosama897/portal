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

                              <a href="/managers/workflowservice" class="btn btn-primary" >

Setting

</a>

                              <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                      <th><strong>employee</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                               
                                                <th><strong>STATUS</strong></th>
                                        
                                                <th><strong>TOTAL</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.service">  
                                                    <td data-table="CODE">  


{{data.service.ref}}</td>
<td data-table="DATE"> {{data.service.date}}</td>
                                                <td data-table="USER" v-if=" data.service.user ">{{data.service.user.name}}</td>
                              
                                                <td data-table="EMPLOYEE" v-if=" data.service.employee ">{{data.service.employee.name}}</td>
                              

                                                <td data-table="DESCRIPTION">{{data.service.subject}}</td>
                                          
                    


                                                 <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0" >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="VAT">{{data.service.vat}}</td>
                                                    <td data-table="TOTAL">{{data.service.total}}</td>
                                                 <td  data-table="ACTION">
												
  
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/service/preview/'+data.service.id">preview</a>
      <a class="dropdown-item" :href="'/managers/service/update/'+data.service.id">update</a>
    
  
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
import moment from 'moment'

    export default {
  
      data(){
return{

datas:{},
allerros:[],
users:[],
date:'',
user_id:'',
ref:'',
real_cycle:[

],

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

                      }else{
                        Object.keys(n).map((z)=>{
    
    this.users.push(n[z])
         })
                      }
                        
                            })
                   
    
    })
    },


    dele(data,index){

if(confirm("Do you really want to delete?")){

axios({
url:'/managers/service/delete/'+data.id,
method:'post',
}).then(res=>{
this.datas.data.splice(index,1)

})

}
},
getResults(page = 1) {
axios({
method: 'post',
url: '/managers/service/json?page=' + page,

})		.then(response => {
              
        this.datas =  response.data.data
      
          })
},

datajson() {
axios({
method: 'post',
url: '/managers/service/json' ,

})		.then(response => {
              
        this.datas =  response.data.data
      
          })
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

'user_id':function(){
            this.datajson()
          } ,

        }
    }
</script>
