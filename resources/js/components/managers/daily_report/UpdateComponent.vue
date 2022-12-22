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
                                   <select class="form-select select2"  v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
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

         <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">
                           <div class="col-md-8">
                              <a  :href="'/uploads/daily_report/'+cycle.path" v-for="cycle in data.attachments" :key="cycle.id" download style="color: #222">  <span class="badge bg-danger">
                              {{cycle.path}}
                              </span></a>
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
                                  <input class="form-control" v-model="user.pivot.performance">
                                       </td>

                                       <td >
                                  <input class="form-control" v-model="user.pivot.commitment">
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
                  <div class="card-header d-block">
                     <h4 class="card-title"> </h4>
                     <p class="m-0 subtitle">Add <code>comments</code> and <code>attachments</code></p>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                        <textarea v-model="contentmanager" placeholder="content" class="form-control mb-2"> 
                                    </textarea>
                 
                        <div class="col-xl-4 mb-2 mt-2">
                        <label for="password" class="col-sm">status</label>
                        <div class="form-group">
                           <select class="form-select select2" aria-label=".form-select-sm example" v-model="status">
                              <option value="1">Accept</option>
                              <option value="2">Reject</option>
                           </select>
                        </div>
                     </div>
                    </div>
                  </div>

               </div>
            </div>

               
               </div>
               <div class="row">
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
     
props:['data'],
        data(){
return{

sub:true,
project_id:1,
daily_productivities:[{}],
projects:[],
allerros:[],
date:'',
userz:[],
subject:'',
contentmanager:'',
status:'',
supervisor_id:'',
workplace:'',
number_of_staff:'',
note:'',
ref:this.refdata,
The_scope_of_work:'',
   images:[],

}

        },

        methods:{


       onImageChange(e) {    
         this.images = [] 
   this.images.push(e.target.files[0])
           },


reset(){
     
  this.project_id = '',
  this.daily_productivities = [{}],
  this.allerros = [],
  this.date= '',
  this.subject= '',
  this.The_scope_of_work = '',
  this.note,
  this.supervisor_id = '',
  this.number_of_staff = ''
  this.workplace = ''

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
submit2(){
   var projectname = {}
this.projects.forEach(e=>{
    if(e.id == this.project_id){
        projectname.name = e.name
    }
})



const  data = {
   
   ref:this.ref,
      
 The_scope_of_work:this.The_scope_of_work,

The_scope_of_worktal:this.The_scope_of_worktalAmount,
project:projectname,
content: this.content,
project:projectname,
attributes:this.daily_productivities,
vat:this.Vat,
   date:this.date,

subject: this.subject
      }


this.$cookies.set('daily_report',data);


 window.location.href = ('/daily_report/index')

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


   if(this.contentmanager){
   formData.append('contentmanager', this.contentmanager);
   }

   if(this.status){
   formData.append('status', this.status);
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

     axios.post('/managers/daily_report/updating/'+this.data.id,formData, {
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
 
 addpayment(){
    this.payment.push({})
},
removepayment(index){
this.payment.splice(index,1)
}
 
 },
        mounted() {
           this.project()

          this.ref = this.data.ref
 this.project_id = this.data.project_id
 this.date = this.data.date
 this.The_scope_of_work = this.data.The_scope_of_work
 this.note = this.data.note
this.daily_productivities = this.data.daily_productivity
 this.workplace = this.data.workplace
 this.number_of_staff = this.data.number_of_staff
this.userz = this.data.users

        },
  
    }
</script>
