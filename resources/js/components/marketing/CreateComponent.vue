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
                        <input type="file" multiple v-on:change="onImageChange($event)" >
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

         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header" style="text-transform: capitalize !important;">
                       

                        <button class="btn btn-primary"   v-if="sub"  type="submit">
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
      props:['refdata'],
       data(){
   return{
   allerros:[],
   date:'',
   subject:'',
   sub:true,
   projects:[],
   content:'',
   ref:this.refdata,
   images:[],
 
   }
   
       },
   
       methods:{

   

   
                     onImageChange(e) {     
   this.images.push(e.target.files[0])
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
   
      this.sub = false
     	const config = {
   
                   headers: { 'content-type': 'multipart/form-data' }
   
               }
   
               let formData = new FormData();


   if(this.date){
   formData.append('date', this.date);
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
    

   if(this.delivery_date){
   formData.append('delivery_date', this.delivery_date);
   }

 
   
   if(this.images){
   formData.append('count', this.images.length);
   }
   
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });
   
   axios.post('/marketing/add',formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   })
   .then(res=>{
   this.sub = true
   this.$cookies.remove("marketing");
   
   window.location.href = ('/marketing')
   
   }).catch(error=>{
      this.sub = true
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
       

     var dataa =  this.$cookies.get('marketing');
   

   this.ref = dataa.ref,

   this.content =dataa.content

   this.delivery_date = dataa.delivery_date

   this.date = dataa.date

   this.subject = dataa.subject
   
       },


     
   }
</script>
