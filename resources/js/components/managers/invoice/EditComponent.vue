<template>
   <div class="container">



      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
         

            <div class="col">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xl-2 mb-2">
                           <label for="password" class="form-label">code</label>
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>
                    

                        <div class="col-xl-2 mb-2">
                           <label for="password" class="form-label">date</label>
                           <div class="form-group">
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label">subtotal</label>
                              <input type="text" class="form-control input-default "  v-model="subtotal" placeholder="subtotal">
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                        <div class="form-check">
    <input type="checkbox" class="form-check-input"  v-model="no_vat" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1"> included vat</label>
    <input
                                type="text "
                                  class="form-control input-default "
                                required
                                name=""
                                id="tax-value tax-value-num"
                                placeholder="20.000"
                            :value="Vat"
                              />
  </div>
  </div>

                        <div class="col-xl-2 mb-2">
                           <label for="password" class="form-label">total</label>
                           <div class="form-group">
                              <input type="text" class="form-control input-default "  :value="total" placeholder="Vat">
                           </div>
                        </div>


                        <div class="col-xl-3 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label">project</label>
                                <select class="form-select select2" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                    


                     </div>
                   
                 
                     <div class="form-group">
                           <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" >
                     </div>
                     
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" v-model="description" rows="6">
                        </textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       
        
         <div class="container">
        
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           <button class="btn btn-primary"    v-if="sub" type="submit">
                           submit
                           </button>
                      
                        
                        </div>
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
projects:[],
allerros:[],
subtotal:0,
     vat:0,
 
date:'',
ref:'',
description:'',
images:{},
no_vat:false,

}

        },

        methods:{
                  	getCostCenter(){

                        this.projects.forEach(e=>{
if(e.id == this.project_id){
   this.projectselected = e
}

})


},


       onImageChange(e) {    
         this.images = {}
   this.images= e.target.files[0]
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


if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.Vat){
   formData.append('vat', this.Vat);
   }
   if(this.total){
   formData.append('total', this.total);
   }

   if(Object.key(this.images) >= 1){
   formData.append('file', this.images);
   }

   

if(this.description){
	 formData.append('description', this.description);
}
 

axios.post('/managers/invoice/update/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
   window.location.href = ('/managers/invoice/index')
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
         
       
      }
    })
},

 
 },
        mounted() {
           this.project()

this.ref = this.data.code,
   this.subtotal = this.data.subtotal
   this.date = this.data.date
   this.description = this.data.description
   this.project_id = this.data.project_id    

        },
           computed:{
            Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.subtotal) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum

   },


               total: function () {
           
   
   var sum = (Number(this.subtotal) + Number(this.Vat))
   return sum
   },
      
       }
    }
</script>
