<template>
   <div >


      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> ref</label>
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>

                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> project</label>

                                  <select class="form-select select2" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" 
>{{project.name}}</option>
                              </select>
                           </div>
                        </div>
         
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> date</label>

                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                  
                       
                         <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> Subcontractor</label>

                         
                              <input
                            class="form-control input-default "
                              type="text"
                        
                              placeholder="Subcontractor name auto complete"
                              required
@input="autocomplete()"
                            
v-model="contractor.name"

                            />
                        
                                        	<ul class="list-group" v-if="contractors.length > 0 ">
  <li v-for="pro in contractors" @click="updatecontractor(pro)" :key="pro.id" class="list-group-item">{{pro.comp ? pro.comp : pro.contractor_name}}</li>

</ul>


                           </div>
                        </div>

                        <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" >
                     </div>


                     </div>
                    
               </div>
               </div>
            <div class="card">
               <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th >
                              <a @click="addconditions()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>
                           <th ><strong>No.</strong></th>
                           <th style="width:30%;"><strong>Condition</strong></th>
                 
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(condition,index) in conditions" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="condition.dis" class="form-control">
                              </textarea>
                           </td>
                       
                           <td>
                              <a class="btn btn-danger" @click="removeconditions(index)" >
                              <strong style="color:white;">  Delete</strong>
                              </a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
       
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

                    
                           <th><strong>unit price</strong></th>

                           <th><strong>total</strong></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(product,index) in scaling" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="product.dis" class="form-control">
                              </textarea>
                           </td>
                           <td>     <input v-model="product.unit" class="form-control"></td>
           
                           <td>     <input v-model="product.expctedqty" class="form-control"></td>
                    

                           <td>     <input v-model="product.unit_price" class="form-control"></td>
                           <td>{{ product.total  }}</td>
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
         
      

            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           
                           <button class="btn btn-primary"    type="submit">
                           submit
                           </button>

                           <button class="btn btn-primary" @click="submit2()"  type="button">
                           preview
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

   contractor:{},
   conditions:[{}],
   contractors:[],
date:'',
products:[],
ref:this.refdata,
images:[],
projects:[],
project_id:'',
}

        },


        methods:{
         submit2(){
   var projectname = {}
this.projects.forEach(e=>{
    if(e.id == this.project_id){
        projectname.name = e.name
    }
})


const  data = {ref:this.ref,
      
 to:this.to,
project:projectname,

total:this.totalAmount,
   
condition:this.conditions,

attribute:this.scaling,

contractor_name:this.contractor.name
}


      

this.$cookies.set('cws',data);


 window.location.href = ('/cws/preview')

},

            onImageChange(e) {     
   this.images.push(e.target.files[0])
           },

         updatecontractor(p){
this.contractor.id =  p.id
this.contractor.name = p.comp ? p.comp : p.contractor_name

this.contractors = []
},
                
          	autocomplete(){
this.contractors = []
if( this.contractor.name !== null){
	axios({
		method:'post',
		url:'/contractor_autotComplete',
data:{
	name:this.contractor.name,

}
	}).then(res=>{
		this.contractors = res.data.data
	})
}

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
          	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

                this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });
   
   if(this.images){
   formData.append('count', this.images.length);
   }
   
if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.date){
	 formData.append('date', this.date);
}

if(this.totalAmount){
	 formData.append('total', this.totalAmount);
}



if(this.project_id){
	 formData.append('project_id', this.project_id);
}



if(this.conditions.length > 0){
	 formData.append('condition',JSON.stringify(this.conditions));
}

if(this.scaling.length > 0){
	 formData.append('attribute',JSON.stringify(this.scaling));
}


if(this.contractor.id){
   formData.append('contractor_id', this.contractor.id);
   }

     axios.post('/cws/Insert',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  

  window.location.href = ('/cws/index') 
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


addconditions(){
    this.conditions.push({})
},
removeconditions(index){
this.conditions.splice(index,1)
}
 ,

 addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 

 
 },
        mounted() {

this.project()
        },

        computed:{


scaling(){
   var data = []
  this.products.forEach(e=>{
   e.total = (Number(e.expctedqty) * Number(e.unit_price))
  })
   
  return data = this.products
}
,

totalAmount(){
var sum = 0
this.scaling.forEach(e=>{
   sum = (Number(e.total) + Number(sum))
})

return sum

         },

        }
     

       
    }
</script>
