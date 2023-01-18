<template>
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-md-8">
             <div class="card">
                <div class="card-header">attendance & absence</div>
                <div class="card-body">
                    <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
                

                      
<div class=" row mb-2">
                     
                            <label class="col-md-2 col-form-label text-md-right" > Project  :</label>
                          <div class="col-md-4">
                                  <select class="form-select select2"  @change="getusers()" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                              </div>

                              <label class="col-md-2 col-form-label text-md-right" > attendance & absence  :</label>
                          <div class="col-md-4">
                                  <select class="form-select select2" v-model="type">
                              <option  value="1">attendance</option>
                              <option  value="2">absence</option>
                        
                              </select>
                              </div>

                              <label class="col-md-2 col-form-label text-md-right" v-if="type == 1" >  from  :</label>
                              <label class="col-md-2 col-form-label text-md-right" v-if="type == 2" >  day  :</label>
                          <div class="col-md-4" >
                              <input type="datetime-local" class="form-control"  v-if="type == 1" v-model="from">
                              <input type="date" class="form-control"  v-if="type == 2" v-model="from">
                              </div>

                              


                              
                              <label class="col-md-2 col-form-label text-md-right" v-if="type == 1" >  to  :</label>
                          <div class="col-md-4" v-if="type == 1">
                              <input type="datetime-local" class="form-control" v-model="to">
                              </div>


                     </div>

                     <div class=" row mb-2">
                      
                   <div class="col-6"  v-for="user in users" :key="user.id">
                    
                    <input type="checkbox" v-model="user.user.check" class="form-check-input" id="exampleCheck1">
                    <label class=" col-form-label text-md-right" >  {{user.user.name}} </label>
                  
                       </div>

              </div>
 


 
                      <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            submit
                            </button>
                         </div>
                      </div>
                   </form>
 
                </div>
             </div>
          </div>
       </div>

       <div id="succModal" class="modal fade bd-example-modal-sm" style="overflow:auto;">
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
               <button style="color:black" type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span style="color:black" aria-hidden="true">&times;</span>
               </button>
               <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Done !</h4>
                  <p>Process has been submitted successfully</p>
                  <hr>
                  <input type="button" class="btn btn-dark" data-dismiss="modal" value="close">
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
         mounted() {


         },
        data(){
 return{
    name:'',
           
            
     project_id:'',
type:'',
from:'',
to:'',
users:[],
 }
        },
   methods:{

    getusers(){
        this.users.splice(0)
        axios({
     url:'/managers/sortUsersByProject/'+this.project_id,
     method:'post',
 }).then(res=>{
     
          if(Array.isArray(res.data.data)){
      
 
                     res.data.data.forEach(n=>{
                          n.forEach(z=>{
 this.users.push(z)
                     })
                         })
                  }else{
 
 let vm = []
 
                    Object.keys(res.data.data).map((n)=>{
 
                 this.users.push(res.data.data[n])
                      })
 
                  }
 
 })

    },

            onImageChange(e) {     
 this.sign = e.target.files[0]
             },
 

 submit(){
    
 var data = []

 this.users.forEach(e=>{
    if(e.user.check == true){
        data.push({id:e.user.id,check:e.user.check})
    }
 
 })
 
              const config = {
 
                     headers: { 'content-type': 'multipart/form-data' }
 
                 }
 
                 let formData = new FormData();

                 if(data){
	 formData.append('data', JSON.stringify(data));
}

if(this.type){
	 formData.append('type',this.type);
}

if(this.project_id){
	 formData.append('project_id',this.project_id);
}



if(this.from){
    
	 formData.append('from',moment(this.from).format('YYYY-MM-DD HH:mm:ss'));
}

if(this.to){
	 formData.append('to',moment(this.to).format('YYYY-MM-DD HH:mm:ss'));
}


   
     axios.post('/project_manager/attendance/post',formData, {
                     headers: {
                         'Content-Type': 'multipart/form-data' },
 })
    .then(res=>{
           window.$("#succModal").modal("show"); 
 
     })
 },
 
   }
         
     }
 </script>
 