<template>
   <div class="container">
      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
      
         <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>


                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> role</label>
                                   <select class="form-select select2" @change="getUser" v-model="role_id">
                              <option  value="0"></option>
                                 <option  v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                              </select>
                           </div>
                        </div>


                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> users</label>
                                   <select class="form-select select2"  v-model="user_id">
                              <option  value="0"></option>
                                 <option  v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                              </select>
                           </div>
                        </div>

                 
                

                     </div>
       
                     <div class="row">

                        <div class="col-xl-6 mb-2">
                           <div class="form-group">
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                   
                     
                   
                          <div class="col-xl-6 mb-2">
                           <div class="form-group">
                                   <select class="form-select select2"  v-model="subject">
                              <option  value="0"></option>
                                 <option  value="Renew ID">Renew ID</option>
                                 <option  value="Exit and entry">Exit and entry</option>
                                 <option  value="Final Exit">Final Exit</option>
                                 <option  value="Transfer to CP">Transfer to CP</option>
                                 <option  value="Transfer from CP">Transfer from CP</option>
                                 <option  value="Clearence">Clearence</option>
                              </select>
                           </div>
                        </div>
                        
                     </div>
                     <div class="form-group">
                           <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" multiple >
                     </div>
                     
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" v-model="content" rows="6">
                        </textarea>
                     </div>
                  </div>
               </div>

               <div class="row justify-content-center">
         <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">

                          <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
<th>file</th>
<th>preview</th>
<th>download</th>
                          </tr>
                          </thead>

                          <tbody>
                            <tr v-for="cycle in data.files" :key="cycle.id" >
                              <td>{{cycle.path}}</td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/service/'+cycle.path"   download >download</a></td>

                            </tr>
                          </tbody>
                          </table>

                        
                        </div>
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
                              <a @click="addservice()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>


                           <th ><strong>No.</strong></th>
                           <th style="width:30%;"><strong>Item description</strong></th>
                           <th><strong>amount</strong></th>
                           <th><strong>percentage</strong></th>
                           <th><strong>employee_cost </strong></th>
                         
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(service,index) in scailing" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="service.item" class="form-control">
                              </textarea>
                           </td>
                           <td>     <input v-model="service.amount" class="form-control"></td>
                           <td>     <input v-model="service.percentage" class="form-control"></td>
                           <td>     <input v-model="service.employee_cost" class="form-control"></td>
                    
                           <td>


                              <a class="btn btn-danger" @click="removeservice(index)" >
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
                        <h4 class="card-title">total_amount : {{totalAmount}}</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
                      <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title"> managers Comments</h4>
                           
                            </div>
                           <div class="card-body">
                                <div id="accordion-twelve" class="accordion accordion-rounded-stylish accordion-gradient">
                                    <div class="accordion__item" :key="data.id"  v-for="data in data.service_cycle">
                                        <template v-if="data.service_comment_cycle">
                                        <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">{{data.role.name}}</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                            <div class="accordion__body--text" >
                                               {{data.service_comment_cycle.content}}
                                            </div>
                                            
                                            <a  :href="'/uploads/service/cycle/'+cycle.path" v-for="cycle in data.service_comment_cycle.files" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
                                                file
                                                </span></a>
                                        </div>
                                        </template>
                                    </div>
                              
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="col">
               <div class="card">
                  <div class="card-header d-block">
                     <h4 class="card-title">  </h4>
                     <p class="m-0 subtitle">Add <code>comments</code> and <code>attachments</code></p>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                        <textarea v-model="contentmanager" placeholder="content" class="form-control mb-2"> 
                                    </textarea>
                        <label class="col-sm" > files  :</label>
                        <div class="col-sm">
                            <input type="file"   v-on:change="onImageChange($event)" >
                        </div>
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
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           <button class="btn btn-primary"  type="submit">
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
         </div>
      </form>
      <div class="modal fade bd-example-modal-xl"  id="preview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
  <div class="modal-dialog modal-xl" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
    <div class="modal-content" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
      <iframe :src="'/uploads/service/'+path" style="width: 100%; height: 100%"  class="embed-responsive-item" title="Iframe Example"></iframe> 
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
props:['data'],
data(){
return{

sub:true,
project_id:1,
serivces:[{}],
date:'',
no_vat:false,
subject:'',
roles:[],
role_id:'',
users:[],
employee_id:'',
path:'',
content:'',
allerros:[],
contentmanager:'',
user_id:'',
ref:this.refdata,
subject:'',
images:[],
status:''
}

        },

        methods:{

         preview(path){
  this.path = path
  window.$("#preview").modal("show");
},

         getUser(){
            axios({
  method: 'get',
  url: '/employee_by_role/'+this.role_id ,

})		.then(res => {
          
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

        rolejson() {
		axios({
  method: 'get',
  url: '/rolechunk' ,

})		.then(res => {
          

   res.data.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
this.roles.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

                this.roles.push(n[e])
                     })

                 }
                        })
   

                })
    },

              onImageChange(e) {     
this.images.push(e.target.files[0])
            },

submit(){

      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();




                if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.status){
	 formData.append('status', this.status);
}


if(this.date){
	 formData.append('date', this.date);
}
 if(this.totalAmount){
   formData.append('total', this.totalAmount);
   }
if(this.subject){
	 formData.append('subject', this.subject);
}

if(this.user_id){
	 formData.append('employee_id', this.user_id);
}

if(this.role_id){
	 formData.append('role_id', this.role_id);
}


if(this.content){
	 formData.append('content', this.content);
}

if(this.serivces.length > 0){
	 formData.append('attr', JSON.stringify(this.serivces));
}

if(this.contentmanager !== null){
	 formData.append('contentmanager', JSON.stringify(this.contentmanager));
}


 if(this.images){
   formData.append('count', this.images.length);
   }
   

this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });




    axios.post('/managers/service/updating/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
    window.$("#editEmployeeModal").modal("show");
this.quotation = '',
this.project_id = '',
this.products = [{}],
this.allerros = [],
this.condition = [{}],
this.date = '',
this.contentmanager='',
this.subject = '',
this.content = '',
this.cc = '',
this.ref = '',
this.userz = [],

this.choice = [],
this.to = '',
this.transportation= '',
this.delivery_date = '',
this.material_avalibility = '',
this.subject = ''
 window.location.href = ('/managers/service/index')


}).catch(error=>{
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

addservice(){
    this.serivces.unshift({})
},
removeservice(index){
this.serivces.splice(index,1)
}
 ,

 
 },
        mounted() {
       
this.project_id = this.data.project_id,
this.serivces = this.data.attributes,
this.date =this.data.date,
this.subject = this.data.subject,
this.content = this.data.content,
this.ref = this.data.ref,
this.role_id = this.data.role_id,
this.user_id = this.data.employee_id
this.rolejson()

        },
        computed:{


totalAmount: function () {
  var sum = 0;
if(this.serivces.length > 0){
this.serivces.forEach(e=>{
if( ( Number(sum) + Number(e.amount)  ) > 0){
sum =  ( Number(sum) + Number(e.amount)   ) 
}else{
sum = (Number(0) + Number(sum))
}


 
 })

}

sum = Math.round(sum)
return sum
},



scailing : function(){
if(this.serivces.length > 0){
this.serivces.forEach(e=>{
e.employee_cost = (e.amount * e.percentage / 100)

})


}
return this.serivces
}
}

    }
</script>
