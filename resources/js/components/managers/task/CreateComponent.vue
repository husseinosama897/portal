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
                              <input type="name" lang="en-US" class="form-control input-rounded" v-model="name" placeholder="Task 1">
                           </div>
                        </div>

     <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                   <label class="form-label" > points   :</label>
                              <input type="name" lang="en-US" class="form-control input-rounded" v-model="point" placeholder="5">
                           </div>
                        </div>

                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                   <label class="form-label" > start At   :</label>
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="start_at" placeholder="input-rounded">
                           </div>
                        </div>
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                <label class="form-label" > Expires    :</label>
                              <input type="date" class="form-control input-default " v-model="expires_at" placeholder="subject">
                           </div>
                        </div>
                    
                     </div>
                     <div class="row">
                   
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
                     <div class="row justify-content-center">
                        <div class="card" v-if="userz.length > 0">
                           <div class="table-responsive">
                              <table    class="table table-responsive-md">
                                 <thead >
                                    <tr>
                                       <th ><strong>No.</strong></th>
                                       <th style="width:30%;"><strong>name</strong></th>
                                            <th ><strong>delete</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr v-for="(user,index) in userz" :key="index">
                                       <td><strong>{{index + 1}}</strong></td>
                                       <td style="width:30%;">
                                          {{user.name}}
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

                            <div class="form-group">
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" v-model="dis" rows="6">
                        </textarea>
                     </div>

                     <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" >
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
      props:['refdata'],
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


 
   

   if(this.userz.length > 0){
   formData.append('users', JSON.stringify(this.userz));
   }
   
   if(this.images){
   formData.append('count', this.images.length);
   }
   
      if(this.name){
   formData.append('name', this.name);
   }
   
         if(this.point){
   formData.append('point', this.point);
   }
         if(this.dis){
   formData.append('dis', this.dis);
   }

      if(this.start_at){
   formData.append('start_at', this.start_at);
   }

     if(this.expires_at){
   formData.append('expires_in', this.expires_at);
   }
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });
   
   axios.post('/managers/task/PostTask',formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   })
   .then(res=>{
   
 window.location.href = ('/managers/task/index')

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
  
 

       },
       computed:{
               totalAmount: function () {
                 var sum = 0;
   if(this.products.length > 0){
   this.products.forEach(e=>{
   if( ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) > 0){
   sum =  ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) 
   }else{
   sum = (Number(0) + Number(sum))
   }
   
   
                
                })
   
   }
   
   sum = Math.round(sum)
   return sum
   },
                   Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.totalAmount) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum
   
   },
       }
   }
</script>
