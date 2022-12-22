<template>
   <div class="container">
 

      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
        
            <div class="col">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>


                          <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                   <select class="form-select select2" @change="getsupervisor" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
                              </select>
                           </div>
                        </div>

                        <div class="col-xl-4 mb-2" v-if="users.length > 0">
                           <div class="form-group">
                                   <select class="form-select select2"  v-model="supervisor_id">
                              <option  value="0"></option>
                                 <option  v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                              </select>
                           </div>
                        </div>


                     </div>
                     <div class="row">
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="The_scope_of_work" placeholder="The_scope_of_work">
                           </div>
                        </div>

                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="workplace" placeholder="workplace">
                           </div>
                        </div>

                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="number_of_staff" placeholder="number_of_staff">
                           </div>
                        </div>
                       
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default "
                                 @input="users()"
                                 v-model="cc" placeholder="cc">
                              <ul  v-if="choice.length > 0" class="list-group">
                                 <li class="list-group-item" @click="takethischoice(cho)" v-for="cho in choice"  :key="cho.id" >{{cho.name}}</li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-xl-4">
                           <button class="btn btn-primary"   type="button" @click="addcc()">
                           add
                           </button>
                        </div>

                     </div>
                    
                     <div class="form-group">
                           <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" multiple >
                     </div>

                     
                        <label for="password" class="form-label">note</label>
                        <textarea class="form-control" v-model="note" rows="6">
                        </textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
                        <div class="card" v-if="userz.length > 0">
                           <div class="table-responsive">
                              <table    class="table table-responsive-md">
                                 <thead >
                                    <tr>
                                       <th ><strong>No.</strong></th>
                                       <th style="width:30%;"><strong>name</strong></th>
                                       <th style="width:30%;"><strong>performance</strong></th>
                                       <th style="width:30%;"><strong>commitment</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr v-for="(user,index) in userz" :key="index">
                                       <td><strong>{{index}}</strong></td>
                                       <td style="width:30%;">
                                          {{user.name}}
                                       </td>
                                       <td >
                                  <input class="form-control" v-model="user.performance">
                                       </td>

                                       <td >
                                  <input class="form-control" v-model="user.commitment">
                                       </td>

                                       <td>
                                          <a class="btn btn-danger" @click="deleteuser(index)" >
                                          <strong style="color:white;">  Delete</strong>
                                          </a>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>

         <div class="row justify-content-center">
            <div class="card">
               <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th >
                              <a @click="addproduct()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>
                           <th ><strong>No.</strong></th>
                           <th style="width:30%;"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>
                        
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(product,index) in daily_productivities" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">

                              <textarea v-model="product.item" class="form-control">
                              </textarea>


                           </td>
                           <td>   
                           <input v-model="product.unit" class="form-control">
                           </td>
                           <td>   
                                <input v-model="product.quantity" class="form-control">
                           
                           </td>
                           <td>
                              <a class="btn btn-danger" @click="removeproduct(index)" >
                              <strong style="color:white;">  Delete</strong>
                              </a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
    
         <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           
                           <button class="btn btn-primary"    type="submit">
                           submit
                           </button>
                        
                           <button   @click="reset()" class="btn btn-danger"  type="button">
                           reset
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

      </form>

   </div>
</template>
<script>
    export default {
        props:['refdata'],

        data(){
return{

sub:true,
project_id:1,
daily_productivities:[{}],
projects:[],
allerros:[],
date:'',

subject:'',
supervisor_id:'',
workplace:'',
number_of_staff:'',
note:'',
ref:this.refdata,
cc:'',
choice:[],
userz:[],
The_scope_of_work:'',
   images:[],

}

        },

        methods:{

                                  addcc(){
   
   
   this.userz.push({name:this.cc, email:this.cc})
   this.cc = ''
           },
           deleteuser(index){
               this.userz.splice(index,1)
           }
   ,
   takethischoice(user){
   this.userz.push(user)
   this.choice.splice(0)
   },
   
   users(){
   this.choice.splice(0)
   axios({
       url:'/user/userautocomplete',
       method:'post',
       data:{
           name:this.cc
       }
   }).then(res=>{
       this.choice = res.data.data
   })
   },
   

         getsupervisor(){

axios({
   method:'post',

   url:'/daily_report/supervisor/'+this.project_id,

}).then(res=>{
   
    res.data.data.forEach(n=>{
     if(Array.isArray(n)){
         n.forEach(z=>{
this.users.push(z)
    })
  }else{

let vm = []

   Object.keys(n).map((e)=>{

this.users.push(n[e])
     })

 }
        })


})
         },


       onImageChange(e) {    
         this.images = [] 
   this.images.push(e.target.files[0])
           },



project(){
    
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


submit(){
   this.sub =false
          	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

if(this.ref){
	 formData.append('ref', this.ref);
}

   
if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.date){
	 formData.append('date', this.date);
}

   if(this.The_scope_of_work){
   formData.append('The_scope_of_work', this.The_scope_of_work);
   }



if(this.note){
	 formData.append('note', this.note);
}

if(this.daily_productivities.length > 0){
	 formData.append('daily_productivities', JSON.stringify(this.daily_productivities));
}

if(this.supervisor_id){
	 formData.append('supervisor_id', this.supervisor_id);
}


if(this.userz){
	 formData.append('users', JSON.stringify(this.userz));
}


if(this.workplace){
	 formData.append('workplace', this.workplace);
}


if(this.number_of_staff){
	 formData.append('number_of_staff', this.number_of_staff);
}



 if(this.images){
   formData.append('count', this.images.length);
   }
   
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });

     axios.post('/daily_report/inserting',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
   this.$cookies.remove('daily_report')
   window.location.href = ('/daily_report/index') 
})
.catch(error=>{
 if (error.response.status == 422){

     if(Array.isArray(error.response.data.errors)){
         this.allerros = error.response.data.errors;
     }else{
         try {
  this.allerros = JSON.parse(error.response.data.message);
         }
         catch{
                this.allerros = error.response.data.errors;
         }
     }
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
},

addproduct(){
    this.daily_productivities.push({})
},
removeproduct(index){
this.daily_productivities.splice(index,1)
}
 ,
 

 
 },
        mounted() {
           this.project()

        },
  
    }
</script>
