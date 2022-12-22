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
                              <input type="text" class="form-control input-default " v-model="ref" placeholder="Ref">
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="date" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                         <div class="col-xl-3 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="subject" placeholder="subject">
                           </div>
                        </div>
                        <div class="col-xl-3 mb-2">
                           <div class="form-group">
                                <select class="form-select select2" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" 
>{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="to" placeholder="to">
                           </div>
                        </div>
                        <div class="col-xl-6 mb-2" >
                      
                      <div class="form-group"  >
                         <label for="password" v-if="loan_option" class="form-label">loan value</label>
                         <input type="text" v-if="loan_option" class="form-control"  v-model="loan_value" id="exampleCheck1">
                      
                         <input type="checkbox" class="form-check-input"  v-model="loan_option" id="exampleCheck1">
                         <label class="form-check-label">loan</label>
                         
                      </div>
                 
                   </div>

                     </div>
                    <div class="form-group">
                     <label for="password" class="form-label">conent</label>
                     <textarea class="form-control"   v-model="content" rows="4">
                     </textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="card" v-if="loan_option">
               <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th >
                              <a @click="addinstallments()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>
                           <th ><strong>No.</strong></th>
                           <th style="width:30%;"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>

                    
                           <th><strong>unit price</strong></th>

                           <th><strong>total</strong></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(installment,index) in installments" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="installment.item" class="form-control">
                              </textarea>
                           </td>
                           <td>     <input v-model="installment.value" class="form-control"></td>
           
                           <td>
                              <a class="btn btn-danger" @click="removeinstallments(index)" >
                              <strong style="color:white;">  Delete</strong>
                              </a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
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
                                    <div class="accordion__item" :key="data.id"  v-for="data in data.employee_cycle">
                                        <template v-if="data.comment_employee_cycle">
                                        <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">{{data.role.name}}</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                            <div class="accordion__body--text" >
                                               {{data.comment_employee_cycle.content}}
                                            </div>
                                            
                                            <a  :href="'/uploads/employee/'+cycle.path" v-for="cycle in data.comment_employee_cycle.attachment_employee_cycle" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
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
                     <h4 class="card-title"> {{role.name}} </h4>
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
props:['data', 'role'],
        data(){
return{

loan_value:'',

project_id:'',
installments:[{}],
projects:[],
allerros:[],
status:'',
condition:[{}],
date:'',
loan_option:false,
subject:'',
content:'',
images:[],
cc:'',
ref:'',
userz:[],

choice:[],
to:'',
contentmanager:'',

}

        },

        methods:{

         addinstallments(){
    this.installments.push({})
},
removeinstallments(index){
this.installments.splice(index,1)
}
 ,
 

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

              onImageChange(e) {     
this.images.push(e.target.files[0])
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
reset(){
    
this.quotation = '',
this.project_id = 1,
this.installments = [{}],
this.allerros = [],
this.condition = [{}],
this.date = '',
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
},

submit(){

      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.quotation){
	 formData.append('quotation', this.quotation);
}
if(this.images){
	 formData.append('count', this.images.length);
}


this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });

if(this.contentmanager !== null){
	 formData.append('contentmanager', JSON.stringify(this.contentmanager));
}



if(this.date){
	 formData.append('date', this.date);
}

if(this.installments){
	 formData.append('installments', JSON.stringify(this.installments));
}


if(this.subject){
	 formData.append('subject', this.subject);
}
if(this.content){
	 formData.append('content', this.content);
}

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.status){
	 formData.append('status', this.status);
}

if(this.to){
	 formData.append('to', this.to);
}


if(this.userz.length > 0){
	 formData.append('users', JSON.stringify(this.userz));
}
    axios.post('/managers/action_employee/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
    window.$("#editEmployeeModal").modal("show");
this.quotation = '',
this.project_id = '',
this.installments = [{}],
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

 window.location.href = ('/managers/index_employee')

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

addinstallments(){
    this.installments.push({})
},
removeinstallments(index){
this.installments.splice(index,1)
}
 ,
 
 addcondition(){
    this.condition.push({})
},
removecondition(index){
this.condition.splice(index,1)
}
 
 },
        mounted() {
       
this.project_id = this.data.project_id,
this.installments = this.data.attributes,
this.condition = this.data.note,
this.date =this.data.date,
this.subject = this.data.subject,
this.content = this.data.content,
this.ref = this.data.ref,
this.matrial_request_cycle = this.data.matrial_request_cycle ?? []
this.to = this.data.to
this.installments = this.data.employee_loan ?? []
this.loan_value = this.data.loan_value
this.loan_option = this.data.loan_option == 1 ? true : false
this.project()

        },

        computed:{

       

        }
     
    }
</script>
