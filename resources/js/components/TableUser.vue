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
                                                 <label for="birthday">المشروع </label>
   <div class="form-group">
                                  <select class="form-select select2" @change="datajson" v-model="project_id">
                              <option  value=""></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                           </div>
                           </div>

                             
  
  <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">contract_date </label>
                                                <input @input="datajson"   type="date"  v-model="contract_date" id="birthday" name="birthday" class="form-control">

                                            </div>

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">contract_ex </label>
                                                <input @input="datajson"   type="date"  v-model="contract_date"  id="birthday" name="birthday" class="form-control">

                                            </div>

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">identity_date </label>
                                                <input @input="datajson"   type="date"  v-model="identity_date"  id="birthday" name="birthday" class="form-control">

                                            </div>





                        <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                          <label for="password-confirm" class="col-md-2 col-form-label text-md-right">role </label>
                           <select  class="form-control select2" @change="datajson" v-model="role_idz">
                              <option    v-for="role in roles"   :key="role.id" :value="role.id">{{role.name}}</option>
                           </select>
                        </div>
                   

                    
                        
                        <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                          <label for="password-confirm" class="col-md-2 col-form-label text-md-right">type </label>
                           <select  class="form-control select2" @change="datajson" v-model="laborer">
                              <option    value="1">laborer</option>
                              <option    value="0">employee</option>
                           </select>
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
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>name</strong></th>
                                             
                                               <th><strong>role</strong></th>
                                             
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data " :key="data.id">
                                              
                                                <td data-table="role">{{data.id}}</td>
                                                <td data-table="name"><a :href="'/managers/HR/profile/'+data.id">{{data.name}}</a></td>
                                                <td data-table="role" v-if="data.role">{{data.role.name}}</td>
                                                <td data-table="role" v-else></td>
                                                                     <td  data-table="ACTION">

<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

      <a class="dropdown-item" @click="admin(data)"  v-if="data.admin == 1" >make  user</a>
    
          <a class="dropdown-item" @click="admin(data)"  v-if="data.admin == 0" >make  admin</a>
      <a class="dropdown-item"  :href="'/managers/performance/'+data.id"> attendance report</a>
      
      <a class="dropdown-item" :href="'/managers/HR/profile/'+data.id"> profile </a>

      <a class="dropdown-item" @click="attending(data)" href="#" data-toggle="modal" data-target="#exampleModal">  attendance : {{data.name}} </a>

  <a class="dropdown-item" :href="'/admin/user/edit/'+data.id"  >edit</a>
    
      <a class="dropdown-item" @click="manager(data)"  v-if="data.manager == 1" >make  user</a>
          <a class="dropdown-item" @click="manager(data)"  v-if="data.manager == 0" >make  manager</a>
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
				
				
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form method="POST"  v-on:submit.prevent="attendance_user()" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div class="modal-body">
      
        <div class="row">


          <div class="col">
            <label for="name" class="col-md-2 col-form-label text-md-right">attending_time</label>
            <input  type="datetime-local" class="form-control  " v-model="attending_time"  >
          </div>
          <div class="col">
            <label for="name" class="col-md-2 col-form-label text-md-right">attending_leaving</label>
            <input  type="datetime-local" class="form-control  " v-model="attending_leaving"  >

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
     
      </div>

  
    </div>
</form>
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
attending_leaving:'',
projects:[],
project_id:'',
employee:'',
attending_time:'',
specific_user:{},
role_idz:'',
roles:[],
laborer:'',

contract_date:'' ,
  contract_ex:''  ,
  identity_date:
  '',
}

        },

        methods:{
          getrole(){

axios({
      url:'/admin/user/role',
      method:'get',
      data:{

      }
  }).then(res=>{
       this.roles = res.data.data

  })
},

          attending(data){
            this.specific_user = {}    
            this.specific_user = data
          },
admin(data,index){

   

axios({
    url:'/admin/user/adminornot/'+data.id,
    method:'post',
}).then(res=>{

})

      
},


manager(data,index){

     

axios({
    url:'/admin/user/managerornot/'+data.id,
    method:'post',
}).then(res=>{

})

      
},

dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_matrial_request_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/user/jsonUser?page=' + page,
  data:{
   project_id: this.project_id,
   laborer:this.laborer,
   role_id:this.role_idz,
  contract_date:this.contract_date ,
  contract_ex:this.contract_ex,
  identity_date:this.identity_date,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson() {
		axios({
  method: 'post',
  url: '/managers/user/jsonUser' ,
  data:{
   project_id: this.project_id,
   laborer:this.laborer,
   role_id:this.role_idz,
 name:this.employee,
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


  
attendance_user(){
  axios({
  method: 'post',
  url: '/managers/attendance/'+this.specific_user.id ,
  data:{
    attending_leaving: moment(this.attending_leaving).format('YYYY-MM-DD HH:mm:ss') ,
attending_time:moment(this.attending_time).format('YYYY-MM-DD HH:mm:ss')
,

  }

})		.then(response => {
                  
  window.$("#exampleModal").modal("hide"); 
            
                })
},

addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 
 addpayment(){
    this.payment.push({})
},
removepayment(index){
this.payment.splice(index,1)
},
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
 
 },
 
 mounted() {
     this.datajson()
     this.projectz()
     this.getrole()
        },
    
    }
</script>
