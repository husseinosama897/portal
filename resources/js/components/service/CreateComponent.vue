<template>
   <div class="container">
  

      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
        

            <div class="col">
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


                        <div class="col-xl-4 mb-2" v-if="users.length > 0">
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
                           <label for="password" class="form-label"> date</label>
                           <div class="form-group">
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                   
                     
                   
                          <div class="col-xl-6 mb-2">
                           <label for="password" class="form-label"> service</label>
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
                        <tr v-for="(service,index) in scailing2" :key="index">
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
         <div class="container">
           
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           <button class="btn btn-primary"    v-if="sub" type="submit">
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

sub:true,
project_id:1,
serivces:[{employee_cost:0,percentage:0}],
date:'',
no_vat:false,
subject:'',
roles:[],
role_id:'',
users:[],
employee_id:'',
content:'',
allerros:[],
user_id:'',
ref:this.refdata,
subject:'',
   images:[],

}

        },

        methods:{

         getUser(){
            this.users.splice(0)
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
         this.images = [] 
   this.images.push(e.target.files[0])
           },


submit2(){


   var user_name = {}
this.users.forEach(e=>{
    if(e.id == this.user_id){
      user_name.name = e.name
    }
})




const  data = {
   
   ref:this.ref,
total:this.totalAmount,
content: this.content,
attributes:this.serivces,
vat:this.Vat,
   date:this.date,
   user_name:user_name.name,
subject: this.subject,
user_id:this.user_id,
role_id:this.role_id,

      }


this.$cookies.set('servicez',data);

 window.location.href = ('/service/preview2')

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

 if(this.images){
   formData.append('count', this.images.length);
   }
   
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });

     axios.post('/service/insert',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
this.$cookies.remove("service");

      window.location.href = ('/service/index')
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

addservice(){
    this.serivces.unshift({})
},
removeservice(index){
this.serivces.splice(index,1)
}
 ,
 

 },
        mounted() {
           this.rolejson()

              var dataa =  this.$cookies.get('servicez');

this.ref = dataa.ref,
      

this.to = dataa.to


 this.content =dataa.content
this.date = dataa.date

this.role_id = dataa.role_id

this.user_id = dataa.user_id

this.serivces = dataa.attributes

 this.subject = dataa.subject

 

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



var eq = (Number(e.employee_cost) * Number(100) / Number(e.amount)) ?? 0
e.percentage = eq.toFixed(1)
   


   })


   }
   return this.serivces
}
,
scailing2 : function(){
   if(this.scailing.length > 0){
   this.scailing.forEach(e=>{
   
      var eq = (Number(e.percentage) * Number(e.amount)) / Number(100)   ?? 0
e.employee_cost = eq.toFixed(1)


   })


   }
   return this.scailing
}
       }
    }
</script>
