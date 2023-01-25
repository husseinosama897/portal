<template>
  <div class="container">


     <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
        <div class="row justify-content-center">
     

           <div class="col-12">
              <div class="card">
                 <div class="card-body">
                    <div class="row">
                       <div class="col-xl-3 mb-2">
                          <div class="form-group">
                             <label for="password" class="form-label"> ref</label>
                             <input type="text" class="form-control input-default " readonly :value="ref"  placeholder="Ref">
                          </div>
                       </div>

                       <div class="col-xl-5 mb-2">
                          <div class="form-group">
                             <label for="password" class="form-label"> subject</label>
                             <input type="text" class="form-control input-default "  @change="updating_data" v-model="subject" placeholder="subject">
                          </div>
                       </div>

                    

                       <div class="col-xl-3 mb-2">
                          <div class="form-group">
                             <label for="password" class="form-label"> date</label>
                             <input type="date" lang="en-US"  @change="updating_data" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                          </div>
                       </div>
                   
             
                    </div>
                    <div class="row">
         

       
             <div class="col-xl-2 mb-2">
                <div class="form-group">
                   <label for="password" class="form-label">delivery date</label>

                   <input type="date" @change="updating_data"  lang="en-US" class="form-control input-rounded" v-model="delivery_date" placeholder="input-rounded">
                </div>
             </div>

          </div>
          
                  
                 
                    <label class="form-label" > files  :</label>
                    <div class="col-sm mb-2">
                       <input type="file" v-on:change="onImageChange($event)" >
                    </div>
                    <div class="form-group">
                       <label for="password" class="form-label">conent</label>
                       <textarea class="form-control" @change="updating_data" v-model="content" rows="6">
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
                            <tr v-for="cycle in files" :key="cycle.id" >
                              <td>
                                
                                
                
                           {{cycle.path}}
                           <i class="fas fa-trash-alt"  style="color:red;" v-if="cycle.deleted" ></i>
                              </td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/marketing/'+data.ref+'/'+cycle.path"   download >download</a></td>

                      

                              

                            </tr>
                          </tbody>
                          </table>

                        
                        </div>
                     </div>
                     </div>
</div>


<h4 class="page-title">tender </h4>

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
<th>delete</th>

                          </tr>
                          </thead>

                          <tbody>
                            <tr v-for="cycle in tender_comment" :key="cycle.id" >
                              <td>
                                
                                
                
                           {{cycle.path}}
                           <i class="fas fa-trash-alt"  style="color:red;" v-if="cycle.deleted" ></i>
                              </td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/tender/'+data.ref+'/'+cycle.path"   download >download</a></td>

                                 <td>
                                
                                <a class="btn btn-danger" v-if="!cycle.deleted"  @click="deletefile(cycle)"   href="#"    >delete</a>
                              
                              
                                  
                                <a class="btn btn-primary" v-else  @click="restorefile(cycle)"   href="#"    >Restore</a>
                              
                              
                              </td>

                              

                            </tr>
                          </tbody>
                          </table>

                        
                        </div>
                     </div>
                     </div>
</div>

<div class="col">
               <div class="card">
                  <div class="card-header d-block">
                     <h4 class="card-title"> </h4>
                     <p class="m-0 subtitle">Add <code>comments</code> and <code>attachments</code></p>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                        <textarea v-model="response" placeholder="content" class="form-control mb-2"> 
                                    </textarea>
                        <label class="col-sm" > files  :</label>
                        <div class="col-sm">
                            <input type="file"   multiple  v-on:change="onImageChange($event)" >
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

        <div class="row justify-content-center">

        </div>
        <div class="container">
           <div class="row justify-content-center">
              <div class="col-12">
                 <div class="card">
                    <div class="card-header" style="text-transform: capitalize !important;">
                      

                       <button class="btn btn-primary"    type="submit">
                       submit
                       </button>
                       <button class="btn btn-primary"   @click="submit2()" type="button" >
                       perview
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
 
     

     <div class="modal fade bd-example-modal-lg"  id="LowBudgetModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="overflow-y: auto;"
>
 <div class="modal-dialog modal-lg">
   <div class="modal-content"  
     
  >

  <img src="/img/2086.jpg" class="img-fluid" alt="Responsive image">

  <div class="alert alert-danger" role="alert">
                 <h4 class="alert-heading">  the current budget less than your order </h4>
        
              
                 <hr>
                 <input type="button" class="btn btn-dark" data-dismiss="modal" value="close">
              </div>
   </div>
 </div>
</div>


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
      <iframe :src="'/uploads/marketing/'+data.ref+'/'+path" style="width: 100%; height: 100%"  class="embed-responsive-item" title="Iframe Example"></iframe> 
    </div>
  </div>
</div>


     <div class="modal fade bd-example-modal-lg"  id="deathEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="overflow-y: auto;"
>
 <div class="modal-dialog modal-lg">
   <div class="modal-content"  
     
  >

  <img src="/img/18915851.jpg" class="img-fluid" alt="Responsive image">

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

allerros:[],
status:'',
condition:[{}],
date:'',
subject:'',
images:[],
ref:'',
tender_comment:{},
delivery_date:'',
subject:'',
path:'',
response:'',
status:'',
files:[],

}

        },

        methods:{


      

          restorefile(file){

            Vue.set(file,'deleted',false)

          },

          preview(path){
  this.path = path
  window.$("#preview").modal("show");
},


          deletefile(file){

Vue.set(file,'deleted',true)

          },

        

          preview(path){
  this.path = path
  window.$("#preview").modal("show");
},


              onImageChange(e) {     
this.images.push(e.target.files[0])
            },


reset(){
    
this.quotation = '',
this.project_id = 1,
this.products = [{}],
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

updating_data(){
   
   const  data = {ref:this.ref,   
     note:this.payment,
    supplier_id: this.supplier_id,
     date:this.date,
     content: this.content,
     delivery_date:this.delivery_date,
     subject: this.subject
       }
     
     this.$cookies.set('marketing',data);
     

},

submit(){

      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


           
                if(this.status){
   formData.append('status', this.status);
   }
   
                
                if(this.response){
   formData.append('response', this.response);
   }
   


   var deletedfiles = []
   if(this.tender_comment && this.tender_comment.length > 0){
      this.tender_comment.forEach(e=>{

if(e.deleted){
  deletedfiles.push(e.id)
}

})

formData.append('deletedfiles',deletedfiles);

   }



                if(this.images){
   formData.append('count', this.images.length);
   }
   
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });




    axios.post('/tender/response/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
    window.$("#editEmployeeModal").modal("show");

 window.location.href = ('/tender')

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

this.content = this.data.content
this.date =this.data.date,
this.subject = this.data.subject,
this.ref = this.data.ref,
this.delivery_date = this.data.delivery_date
this.files = this.data.attachment
this.tender_comment = this.data.tender_comment.attachment
        },



    }
    
</script>
