<template>
   <div class="container">
      <div class="alert alert-danger"  v-if="   projectselected.petty_cash_budget < totalAmount" role="alert">
 the current budget less than your order 
</div>


      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
            <div class="card">
               <div class="card-body">
                  <table class="table dt-responsive nowrap w-100">
                     <thead>
                    
                    <tr>
                       <th>
                      budget
                    </th>
                    <th>
                     total expenses
                    </th>

                    <th>
                    Amount
                    </th>

                    <th>
                   expenses
                    </th>
                  </tr>

                 </thead>
                     <tbody>
                   
                        <td>
                           {{projectselected.petty_cash_budget}}
                        </td>

                        <td>
                           {{projectselected.petty_cash_expenses}}
                        </td>

                        <td>
                           {{totalAmount}}
                        </td>

                        <td>
                           {{projectselected.petty_cash_expenses - totalAmount }}
                        </td>

                     </tbody>
                  </table>
               </div>
            </div>

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
                              <input type="text" class="form-control input-default " v-model="subject" placeholder="subject">
                           </div>
                        </div>
                          <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                   <select class="form-select select2" @change="getCostCenter" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                         <div class="col-xl-4 mb-2" v-if="cost_centers.length > 0">
                           <div class="form-group">
                                <label class="form-label" > cost center  :</label>
                                   <select class="form-select select2" v-model="cost_center_id">
                              <option  value="0"></option>
                                 <option  v-for="cost_center in cost_centers" :key="cost_center.id" :value="cost_center.id">{{cost_center.name }}</option>
                              </select>
                           </div>
                        </div>

                     </div>
                     <div class="row">
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="to" placeholder="to">
                           </div>
                        </div>
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
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr v-for="(user,index) in userz" :key="index">
                                       <td><strong>{{index}}</strong></td>
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
                        <tr v-for="(product,index) in products" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="product.dis" class="form-control">
                              </textarea>
                           </td>
                           <td>     <input v-model="product.unit" class="form-control"></td>
                           <td>     <input v-model="product.qty" class="form-control"></td>
                           <td>     <input v-model="product.unit_price" class="form-control"></td>
                           <td>{{ product.unit_price * product.qty  }}</td>
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
                                             <div class="form-check">
    <input type="checkbox" class="form-check-input"  v-model="no_vat" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1"> included vat</label>
  </div>
                        <h4 class="card-title">VAT : {{Vat}}</h4>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           <button class="btn btn-primary"    v-if="sub  &&  projectselected.petty_cash_budget >= totalAmount" type="submit">
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
products:[{}],
projects:[],
allerros:[],
payment:[{}],
date:'',
no_vat:false,
subject:'',
userz:[],
content:'',
choice:[],
   cost_centers:[],
   cost_center_id:'',
   projectselected:'',

cc:'',
ref:this.refdata,
to:'',
transportation:'',
delivery_date:'',
material_avalibility:'',
subject:'',
   images:[],

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

                                   addcc(){


this.userz.push({name:this.cc, email:this.cc})
this.cc = ''
            },


            deleteuser(index){
                this.userz.splice(index,1)
            }
,
takethischoice(user){
this.userz.push(user)
   this.choice.splice(0)
},

       onImageChange(e) {    
         this.images = [] 
   this.images.push(e.target.files[0])
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
  this.date= '',
  this.subject= '',
  this.contract_on = '',
  this.to = ''
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
      
 to:this.to,

total:this.totalAmount,
project:projectname,
content: this.content,
project:projectname,
attributes:this.products,
vat:this.Vat,
   date:this.date,

subject: this.subject
      }


this.$cookies.set('petty',data);


 window.location.href = ('/user/prepetty_cashreturn')

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

    if(this.cost_center_id){
   formData.append('cost_center_id', this.cost_center_id);
   }
   
if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.Vat){
   formData.append('vat', this.Vat);
   }
   if(this.totalAmount){
   formData.append('total', this.totalAmount);
   }
if(this.subject){
	 formData.append('subject', this.subject);
}
if(this.content){
	 formData.append('content', this.content);
}
if(this.to){
	 formData.append('to', this.to);
}
if(this.products.length > 0){
	 formData.append('attr', JSON.stringify(this.products));
}
if(this.userz.length > 0){
	 formData.append('users', JSON.stringify(this.userz));
}

 if(this.images){
   formData.append('count', this.images.length);
   }
   
   
   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });

     axios.post('/user/petty_cashinsrting',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
this.$cookies.remove("petty");

      window.location.href = ('/user/index_petty_cash')
})
.catch(error=>{

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

addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
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

              var dataa =  this.$cookies.get('petty');

this.ref = dataa.ref,
      
 this.payment = dataa.note,

this.to = dataa.to


 this.content =dataa.content


this.products = dataa.attributes

 this.subject = dataa.subject


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
   sum = sum.toFixed(2)
   
   
                 }

                 return sum
   
   },

   overall(){
      var sum = 0

      sum = (Number(this.totalAmount)   + Number(this.Vat))
   }
       }
    }
</script>
