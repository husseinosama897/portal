<template>
   <div class="container">
      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                     <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                   <label class="form-label" > Subject   :</label>
                              <input readonly type="name" lang="en-US" class="form-control input-rounded" v-model="name" placeholder="Task 1">
                           </div>
                        </div>

     <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                   <label class="form-label" > points   :</label>
                              <input readonly type="name" lang="en-US" class="form-control input-rounded" v-model="point" placeholder="5">
                           </div>
                        </div>

                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                   <label class="form-label" > start At   :</label>
                              <input readonly type="date" lang="en-US" class="form-control input-rounded" v-model="start_at" placeholder="input-rounded">
                           </div>
                        </div>
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                <label class="form-label" > Expires    :</label>
                              <input readonly type="date" class="form-control input-default " v-model="expires_at" placeholder="subject">
                           </div>
                        </div>
                    
                     </div>
                
              

                            <div class="form-group">
                        <label for="password" class="form-label">conent</label>
                        <textarea readonly class="form-control" v-model="dis" rows="6">
                        </textarea>
                     </div>

            
                
                  </div>
             
               </div>
                 
            </div>
         </div>

          <div class="row justify-content-center">
         <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">
                           <div class="col-md-8">
                              <a  :href="'/uploads/attachment_task_manager/'+cycle.path" v-for="cycle in data.attachment_task_manager" :key="cycle.id" download style="color: #222">  <span class="badge bg-danger">
                              {{cycle.path}}
                              </span></a>
                           </div>
                        </div>
                     </div>
                     </div>

 

                      <div class="row justify-content-center">
                            <div class="col-4">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title"> managers Comments</h4>
                           
                            </div>
                           <div class="card-body">
                                <div id="accordion-twelve" class="accordion accordion-rounded-stylish accordion-gradient">
                                    <div class="accordion__item">
                                        <template >
                                        <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text"></span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                            <div class="accordion__body--text" >
                                              {{data.noteManager}}
                                            </div>
                                            
                                    
                                        </div>
                                        </template>
                                    </div>
                              
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="col-6">
               <div class="card">
                  <div class="card-body">
                            <div class="form-group">
                        <label for="password" class="form-label">conent</label>
                        <textarea  class="form-control" v-model="note" rows="6">
                        </textarea>
                     </div>

                     <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input  type="file" v-on:change="onImageChange($event)" >
                     </div>
                     </div>
                     </div>
                     </div>

                     </div>
         
      
         <div class="row justify-content-center">

         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header" style="text-transform: capitalize !important;">
                        <button class="btn btn-primary"  type="submit">
                        submit
                        </button>
                  
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
                  <input readonly type="button" class="btn btn-dark" data-dismiss="modal" value="close">
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
                  <input readonly type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
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
   project_id:1,

   allerros:[],
   start_at:'',
   expires_at:'', 
   cc:'',
   choice:[],
   name:'',
   dis:'',
   note:'',
   point:'',
   userz:[],
   images:[],
   }
   
       },
   
       methods:{

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
   this.project_id = '',
   this.products = [{}],
   this.allerros = [],
   this.payment = [{}],
   this.date = '',
   this.subject = '',
   this.order_for = '',
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

   if(this.images){
   formData.append('count', this.images.length);
   }
  
         if(this.dis){
   formData.append('note', this.note);
   }

   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });
   
   axios.post('/task/mission_completed/'+this.data.id,formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   })
   .then(res=>{
    window.location.href = ('/task/index')

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
   


   
   },
       mounted() {
  
  this.start_at = this.data.start_at,
  this.expires_at = this.data.expires_in, 
 
   
   this.name = this.data.name,
   this.dis= this.data.dis,
   this.point= this.data.point,
   this.userz = this.data.user ?? []

       },
    
   }
</script>
