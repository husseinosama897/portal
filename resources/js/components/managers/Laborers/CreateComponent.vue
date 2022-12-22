<template>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">Register</div>
               <div class="card-body">
                   <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
                     <div class="form-group row mb-2">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
                        <div class="col-md-4">
                           <input id="name" v-model="name" type="text" class="form-control @error('name') " name="name"   autocomplete="name" autofocus>
                        </div>
                               <label for="email" class="col-md-2 col-form-label text-md-right">fahther_name</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="fahther_name"  >
                        </div>

                     </div>
                         <div class="form-group row mb-2">
                           <label for="email" class="col-md-2 col-form-label text-md-right">E-Mail Address</label>
                        <div class="col-md-4">
                           <input id="email" type="email" class="form-control @error('email') " name="email" v-model="email"  >
                        </div>


     <label for="email" class="col-md-2 col-form-label text-md-right">address</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="address"  >
                        </div>



                        </div>

                        
                        <div class="form-group row mb-2">
                        <label for="vacations" class="col-md-2 col-form-label text-md-right">vacations</label>
                        <div class="col-md-4">
                           <input id="vacations" type="text" v-model="vacations" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>
                           <label for="weekly_vacation" class="col-md-2 col-form-label text-md-right">weekly_vacation</label>
                        <div class="col-md-4">
                           <input id="weekly_vacation" type="text" v-model="weekly_vacation" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>

                     </div>

                       

                       <div class="form-group row mb-2">
                        <label for="working_hours" class="col-md-2 col-form-label text-md-right">working_hours</label>
                        <div class="col-md-4">
                           <input id="working_hours" type="text" v-model="working_hours" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>
                           <label for="contract_date" class="col-md-2 col-form-label text-md-right">contract_date</label>
                        <div class="col-md-4">
                           <input id="contract_date" type="date" v-model="contract_date" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>

                     </div>



<div class="form-group row mb-2">
                        <label for="contract_ex" class="col-md-2 col-form-label text-md-right">contract_ex</label>
                        <div class="col-md-4">
                           <input id="contract_ex" type="date" v-model="contract_ex" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>

                            <label class="col-md-2 col-form-label text-md-right" > Project  :</label>
                          <div class="col-md-4">
                                  <select class="form-select select2" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                              </div>
                     </div>


                         <div class="form-group row mb-2">
                           <label for="email" class="col-md-2 col-form-label text-md-right">type_of_identity</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="type_of_identity"  >
                        </div>


     <label for="email" class="col-md-2 col-form-label text-md-right">identity number</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="identity"  >
                        </div>



                        </div>
                            <div class="form-group row mb-2">
                           <label for="email" class="col-md-2 col-form-label text-md-right">identity_date</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="identity_date"  >
                        </div>


     <label for="email" class="col-md-2 col-form-label text-md-right">identity_source </label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="identity_source"  >
                        </div>



                        </div>

                           <div class="form-group row mb-2">
                           <label for="email" class="col-md-2 col-form-label text-md-right">build_number</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="build_number"  >
                        </div>


     <label for="email" class="col-md-2 col-form-label text-md-right">city </label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="city"  >
                        </div>



                        </div>
                            <div class="form-group row mb-2">
                           <label for="email" class="col-md-2 col-form-label text-md-right">street</label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="street"  >
                        </div>


     <label for="email" class="col-md-2 col-form-label text-md-right">phone </label>
                        <div class="col-md-4">
                           <input id="email" type="text" class="form-control @error('email') " name="email" v-model="phone"  >
                        </div>



                        </div>


                            <div class="form-group row mb-2">
                          <label for="name" class=" col-md-2 col-form-label text-md-right">salary per hour</label>
                        <div class="col-md-4">
                           <input id="name" v-model="salary_per_hour" type="text" class="form-control @error('name') " name="name"   autocomplete="name" autofocus>
                        </div>
                          <label for="name" class="col-2 col-form-label text-md-right">salary per month</label>
                             <div class="col-md-4">
                               
                           <input id="name" v-model="salary_per_month" type="text" class="form-control @error('name') " name="name"   autocomplete="name" autofocus>
                        </div>
                     </div>

                   
                     <div class="form-group row mb-2">
                        <label for="password" class="col-md-2 col-form-label text-md-right">Password</label>
                        <div class="col-md-4">
                           <input id="password" type="password" v-model="password" class="form-control @error('password') " name="password"  autocomplete="new-password">
                        </div>
                              <label for="password-confirm" class="col-md-2 col-form-label text-md-right">Confirm Password</label>
                        <div class="col-md-4">
                           <input id="password-confirm"  v-model="password_confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>

                     </div>
                 
                 
                     <div class="form-group mb-2">
                        <label class="col-sm" > sign  :</label>
                        <div class="col-sm">
                           <input type="file"   v-on:change="onImageChange($event)" >
                        </div>
                     </div>

                     


                     <div class="form-group row mb-0">
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
        mounted() {
this.getrole()
this.projectz()
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

            vacations:'',
   weekly_vacation:'',
   project_id:'',
    contract_date:'',
  contract_ex:'',

working_hours:'',
    
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

      if(this.sign !== undefined && this.sign == null){
	 formData.append('sign', this.sign);
}
if(this.name){
	 formData.append('name', this.name);
}
if(this.password_confirmation){
	 formData.append('password_confirmation', this.password_confirmation);
}

if(this.password){
	 formData.append('password', this.password);
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




if(this.weekly_vacation){
	 formData.append('weekly_vacation', this.weekly_vacation);
}

if(this.vacations){
	 formData.append('vacations', this.vacations);
}

if(this.project_id){
	 formData.append('project_id', this.project_id);
}


if(this.email){
	 formData.append('email', this.email);
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
  

  
    axios.post('/managers/Laborer_add',formData, {
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
