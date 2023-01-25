<template>
   <div >
      
      <div class="col-12">
         <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
               <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
                  <div class=" row mb-2">
                     <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
                     <div class="col-4">
                        <input id="name" v-model="first_name" type="text" class="form-control @error('name') " name="name"   autocomplete="name" autofocus>
                     </div>
                            <label for="email" class="col-md-2 col-form-label text-md-right">fahther_name</label>
                     <div class="col-4">
                        <input id="email" type="text" class="form-control  " name="email" v-model="fahther_name"  >
                     </div>
 
                  
 
                  </div>
                  <div class="row ">
 
                     <label for="email" class="col-md-2 col-form-label text-md-right">user name</label>
                     <div class="col-4">
                        <input id="email" type="text" class="form-control  " name="email" v-model="name"  >
                     </div>
 
                     <label for="email" class="col-md-2 col-form-label text-md-right">E-Mail Address</label>
                     <div class="col-md-4">
                        <input id="email" type="email" class="form-control  " name="email" v-model="email"  >
                     </div>
                  </div>
                     
 
             
 
             
 
 
 <div class=" row mb-2">
               
 
                     <div class=" row mb-2">
                
 
                     <label class="col-md-2 col-form-label text-md-right" > Project  :</label>
                       <div class="col-md-4">
                               <select class="form-select select2" v-model="project_id">
                           <option  value="0"></option>
                              <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
 color: #000;">{{project.name}}</option>
                           </select>
                           </div>
 
 </div>
 
 
 
                     
                  </div>
 
 
 
 
             
              
 
                  <div class=" row mb-2">
                     <label for="password" class="col-md-2 col-form-label text-md-right">Password</label>
                     <div class="col-md-4">
                        <input id="password" type="password" v-model="password" class="form-control @error('password') " name="password"  autocomplete="new-password">
                     </div>
                           <label for="password-confirm" class="col-md-2 col-form-label text-md-right">Confirm Password</label>
                     <div class="col-md-4">
                        <input id="password-confirm"  v-model="password_confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                     </div>
 
                  </div>
           
            
 
               
                  <div class=" mb-2">
                     <label class="col-sm" > sign  :</label>
                     <div class="col-sm">
                        <input type="file"   v-on:change="onImageChange($event)" >
                     </div>
                  </div>
 
                  
                  <div class=" mb-2">
                     <label class="col-sm" > picture  :</label>
                     <div class="col-sm">
                        <input type="file"   v-on:change="onpictureChange($event)" >
                     </div>
                  </div>
 
 
                  <div class=" mb-2">
                     <label class="col-sm" > files  :</label>
                     <div class="col-sm">
                        <input type="file"   v-on:change="onfilesChange($event)"  multiple>
                     </div>
                  </div>
 
 
 
 
                  <div class=" row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        Register
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
  
   <div id="editEmployeeModal" class="modal fade bd-example-modal-sm" style="overflow:auto;">
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
   <div id="deathEmployeeModal" class="modal fade bd-example" style="overflow:auto;">
      <div class="modal-dialog ">
         <div class="modal-content" style="overflow:auto;">
            <div class="alert alert-danger" role="alert">
               <h4 class="alert-heading"> فشلت العمليه  !</h4>
               <p>    :  لقد فشلت العمليه للاسباب التاليه </p>
               <p v-for="(err,index)  in allerros" :key="index"> {{err}}</p>
               <hr>
               <input type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
            </div>
         </div>
      </div>
   </div>
 </div>
 </template>
<script>
    export default {
      props:['data','projects'],
        mounted() {
this.getrole()

  
            this.name = this.data.name,

           
    this.project_id = this.data.contract.project_id ?? '',
     this.contract_date = this.data.contract.contract_date ?? '',
   this.contract_ex = this.data.contract.contract_ex ?? '',
 this.working_hours = this.data.contract.working_hours ?? '',
    this.weekly_vacation = this.data.contract.weekly_vacation ?? '',
      this.vacations = this.data.contract.vacations ?? '',
    
             this.email = this.data.email
             this.salary_per_hour =  this.data.contract.salary_per_hour  ?? '',
            this.salary_per_month = this.data.contract.salary_per_month  ?? '',
            this.fahther_name = this.data.contract.fahther_name  ?? '',
            this.address = this.data.contract.address  ?? '',
            this.type_of_identity = this.data.contract.type_of_identity  ?? '',
            this.identity = this.data.contract.identity  ?? '',
            this.identity_date = this.data.contract.identity_date ?? '',
            this.identity_source= this.data.contract.identity_source ?? '',
            this.build_number = this.data.contract.build_number ?? '',
            this.city= this.data.contract.city ?? '',
            this.street = this.data.contract.street  ?? '',
           this.phone = this.data.contract.phone ?? ''

        },
       data(){
return{
   name:'',
            password_confirmation:'',
            password:'',
            projects:[],
       
            name:'',

salary_per_hour:'',
            salary_per_month:'',
            fahther_name:'',
            address:'',
            type_of_identity:'',
            identity:'',
            identity_date:'',
            identity_source:'',
            build_number:'',
            
            city:'',
            street:'',
            phone:'',


            vacations: '',
   weekly_vacation: '',
   project_id: '',
    contract_date:'',
  contract_ex: '',
working_hours: '',
    
            email:'',
            allerros:[],
            role_idz:'',
            roles:[],
}
       },
  methods:{
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
           onImageChange(e) {     
this.sign = e.target.files[0]
            },

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
submit(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();



if(this.name){
	 formData.append('name', this.name);
}
if(this.password_confirmation){
	 formData.append('password_confirmation', this.password_confirmation);
}

if(this.password){
	 formData.append('password', this.password);
}



if(this.email && this.email !== this.data.email){
	 formData.append('email', this.email);
}


 if(this.working_hours){
	 formData.append('working_hours', this.working_hours);
}


    if(this.contract_ex){
	 formData.append('contract_ex', this.contract_ex);
}


   if(this.contract_date){
	 formData.append('contract_date', this.contract_date);
}


if(this.project_id){
	 formData.append('project_id', this.project_id);
}

if(this.weekly_vacation){
	 formData.append('weekly_vacation', this.weekly_vacation);
}

if(this.vacations){
	 formData.append('vacations', this.vacations);
}



if(this.salary_per_hour){
	 formData.append('salary_per_hour', this.salary_per_hour);
}
    
    if(this.salary_per_month){
	 formData.append('salary_per_month', this.salary_per_month);
}
 if(this.fahther_name){
	 formData.append('fahther_name', this.fahther_name);
}
  
   if(this.address){
	 formData.append('address', this.address);
}
  
         
         
   if(this.type_of_identity){
	 formData.append('type_of_identity', this.type_of_identity);
}
  
           
   if(this.identity){
	 formData.append('identity', this.identity);
}
   if(this.identity_date){
	 formData.append('identity_date', this.identity_date);
}
  if(this.identity_source){
	 formData.append('identity_source', this.identity_source);
}
  
   if(this.build_number){
	 formData.append('build_number', this.build_number);
}
  
  
   if(this.city){
	 formData.append('city', this.city);
}
   if(this.street){
	 formData.append('street', this.street);
}

  if(this.phone){
	 formData.append('phone', this.phone);
}
  


    axios.post('/project_manager/laborer/update/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
          window.$("#editEmployeeModal").modal("show"); 

    })
},

  }
        
    }
</script>
