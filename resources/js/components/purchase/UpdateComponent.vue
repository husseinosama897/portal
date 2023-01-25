<template>
  <div class="container">

   <div class="alert alert-danger"  v-if=" totalpo_expenses  > projectselected.po_budget" role="alert">
the current budget less than your order 
</div>
   

     <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
       <div class="card">
              <div class="card-body">
                 <table class="table dt-responsive nowrap w-100">
                    <tbody>
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
                    </tbody>

                    <tbody>
                       <tr>
                        
                       <td>
                          {{projectselected.po_budget}}
                       </td>


                       
                       <td>
                          {{  projectselected.po_expenses }}
                       </td>


                       <td>
                          {{totalAmount}}
                       </td>




                       <td>
                          {{  projectselected.po_expenses   - totalAmount}}
                       </td>

                    </tr>
                    </tbody>
                 </table>
              </div>
           </div>

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
                                 <select class="form-select select2"  @change="getCostCenter()" v-model="project_id">
                             <option  value="0"></option>
                                <option  v-for="project in projects" :key="project.id" :value="project.id" >{{project.name}}</option>
                             </select>
                          </div>
                       </div>
                          <div class="col-xl-4 mb-2">
                          <div class="form-group">
                                  <select class="form-select select2" v-model="supplier_id">
                             <option  value="0"></option>
                                <option  v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{supplier.customer_name ? supplier.customer_name : supplier.comp}}</option>
                             </select>
                          </div>
                       </div>

                       <div class="col-xl-2 mb-2">
                          <div class="form-group">
                             <input type="text" class="form-control input-default " v-model="to" placeholder="to">
                          </div>
                       </div>
                    </div>
                 
                    <div class="row">
              
              <div class="col-xl-4 mb-2">
                <label for="password" class="form-label"> material avalibility</label>
                <div class="form-group">
                   <input type="text" class="form-control input-default "
                
                      v-model="material_avalibility" >
           
                </div>
             </div>

             <div class="col-xl-4 mb-2">
                <label for="password" class="form-label"> transportation</label>
                <div class="form-group">
                   <input type="text" class="form-control input-default "
                
                      v-model="transportation" >
           
                </div>
             </div>
       
             <div class="col-xl-2 mb-2">
                <div class="form-group">
                   <label for="password" class="form-label">delivery date</label>

                   <input type="date" lang="en-US" class="form-control input-rounded" v-model="delivery_date" placeholder="input-rounded">
                </div>
             </div>

          </div>

                  <label class="form-label" > files  :</label>
                    <div class="col-sm mb-2">
                       <input type="file" v-on:change="onImageChange($event)" >
                    </div>
                    
                   <div class="form-group">
                    <label for="password" class="form-label">conent</label>
                    <textarea class="form-control"   v-model="order_for" rows="4">
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
<th>delete</th>
                         </tr>
                         </thead>

                         <tbody>
                           <tr v-for="cycle in files" :key="cycle.id" >
                             <td>
                               
                               
               
                          {{cycle.path}}
                          <i class="fas fa-trash-alt"  style="color:red;" v-if="cycle.deleted" ></i>
                             </td>
                             <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                             <td><a class="btn btn-danger"   :href="'/uploads/purchase_order/'+cycle.path"   download >download</a></td>

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
                          <th style="width: 30%"><strong>Item description</strong></th>
                          <th><strong>unit</strong></th>
                          <th><strong>qty</strong></th>
                          <th><strong>unit price</strong></th>
                          <th><strong>total</strong></th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr  v-for=" (product,index) in  products" :key="product.id">
                         <td></td>
                          <td><strong>{{index}}</strong></td>
                          <td style="width: 30%">
                             <textarea v-model="product.dis "
                             
                             @input="autocompletez2(product.dis,index)"

                             class="form-control"
                             
                             
                            

                             style="max-height: 2.3rem;">
                             </textarea>
                                 

                             <ul class="list-group"         v-if="choices_product.length > 0   && product.dis !== ''       && index == id">
 <li v-for="data in choices_product" @click="update(data,product)" :key="data.id" class="list-group-item">{{data.name}}</li>
</ul>


<ul class="list-group"         v-if="choices_product.length > 0   && product.name !== ''       && index == id">
 <li v-for="data in choices_product" @click="update(data,product)" :key="data.id" class="list-group-item">{{data.name}}</li>
</ul>


                          </td>



                          <td>  
                                <input v-if="product.pivot && product.pivot.unit" v-model="product.pivot.unit " class="form-control">
                          <input v-else v-model="product.unit " class="form-control">
                          </td>
                          <td> 
                                 <input 
                                 
                                 v-if="product.pivot && product.pivot.qty"

                                 v-model="product.pivot.qty" class="form-control">
                                 
                                   <input 
                                 
                                 v-else

                                 v-model="product.qty" class="form-control">
                                 
                                 
                                 </td>
                          <td>  
                             
                             <input v-if=" product.pivot && product.pivot.unit_price" v-model="product.pivot.unit_price" class="form-control">
                          
                            <input v-else v-model="product.unit_price" class="form-control">
                          
                          
                          </td>
                          <td v-if="product.pivot">{{ product.pivot.unit_price * product.pivot.qty ? product.pivot.unit_price * product.pivot.qty :product.unit_price * product.qty  }}
                          
                          </td>
                          <td v-else>{{ product.unit_price * product.qty  }}
                          
             
                          </td>
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
          
          
        <div class="card">
                   <div class="card-body">
                   <div class="row mt-3">
                     <div class="parent-input-system mt-2">
                       <div class="col-12  col-xl-10">
                         <div class="row ">
                           <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                             <label for="sum-price" class="label-req"
                               > SubtotalAmount </label
                             >
                           </div>
                           <div class="col-12 col-sm-6 col-md-5 col-lg-4  col-xl-5">
                             <input
                               type="text"
                               class="form-control input-default "
                    :value="wordtotalAmount"
                               name=""
                               id="sum-price price-text"
                               placeholder="مائتان ألف ريال فقط لا غير"
                             />
                           </div>
                           <div class="col-12 col-sm-3 mt-2 mt-sm-0 col-md-3 col-xl-4">
                             <input
                               type="text "
                                 class="form-control input-default "
                               required
                               name=""
                               id="sum-price price-num"
                               placeholder="200.000"  
:value="totalAmount"

                             />
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="parent-input-system mt-4">
                       <div class="col-12 col-xl-10">
                         <div class="row">
                           <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                             <label for="discount-percentage" class="label-req"
                               > discount</label
                             >
                           </div>
                           <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-5">
                             <input
                               type="text"
                               class="form-control input-default "

                               required
                               name=""
                               id="discount-percentage discount-percentage-text"
                               placeholder="10%"
                             v-model="discount"
                             @input="perdiscount($event)"
                               max="100"
                             />
                           </div>
                           <div class="col-12 col-sm-3 mt-2 mt-sm-0 col-md-3 col-xl-4">
                             <input
                             type="text"
                               class="form-control input-default "

                               required
                               name=""
                               id="discount-percentage discount-percentage-text"
                               placeholder="10%"
                               v-model="test"

@input="valuediscount($event)"

                             />
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="parent-input-system mt-4">
                       <div class="col-12 col-xl-10">
                         <div class="row">
                           <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                             <label for="discount-percentage" class="label-req"
                               >after discount</label
                             >
                           </div>
                    
                           <div class="col-12 col-sm-3 mt-2 mt-sm-0 col-md-3 col-xl-4">
                             <input
                               type="text"
                                 class="form-control input-default "
                               required
                               name=""
                               id="discount-percentage discount-percentage-num"
                               placeholder="20.000"
:value=" after_discount "


                             />
                           </div>
                         </div>
                       </div>
                     </div>
                     
                     <div class="parent-input-system mt-4">
                       <div class="col-12  col-xl-10">
                         <div class="row">
                           <div class="col-2">
                             <label for="tax-value" class="label-req"
                               >Vat </label
                             >
                           </div>
                           <div class="col-4">
                             <input
                          type="text"
                               class="form-control input-default "
                               required
                               name=""
                               id="tax-value tax-value-text"
                               placeholder="10%"
                   value="15"
                   readonly
                               max="100"
                                />
                           </div>

                           <div class="col-4">
                             <input
                               type="text "
                                 class="form-control input-default "
                               required
                               name=""
                               id="tax-value tax-value-num"
                               placeholder="20.000"
                           :value="Vat  "
                             />
                           </div>
                           <div class="col-2">
                           <div class="form-check">
   <input type="checkbox" class="form-check-input"  v-model="no_vat" id="exampleCheck1">
   <label class="form-check-label" for="exampleCheck1"> included vat</label>
 </div>
</div>
                         </div>
                       </div>
                     </div>
                     <div class="parent-input-system mt-4">
                       <div class="col-12 col-xl-10">
                         <div class="row">
                           <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                             <label for="total-sales-order" class="label-req"
                               >  total Amount included vat & discount </label
                             >
                           </div>
                           <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-5">
                             <input
                               type="text"
                               class="form-control input-default "
                             
                               name=""
                               id="total-sales-order total-sales-order-text"

                               :value="wordoverall"
                               placeholder="مائتان ألف وسبع مئة ريال فقط لا غير"
                             />
                           </div>
                           <div class="col-12 col-sm-3 mt-2 mt-md-0 col-md-3 col-xl-4">
                             <input
                               type="text "
                                 class="form-control input-default "
                               readonly
                               name=""
                               id="total-sales-order total-sales-order-num"
                               placeholder="207.000"

                               :value="overall"
                             />
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                   </div>
                  
                   <div class="card">
                   <div class="card-body">
                     <div class="title-section p-2 ">
                         <h5> installments</h5>

                         <div class="col-2">
                           <div class="form-check">
   <input type="checkbox" class="form-check-input"  v-model="cash" id="exampleCheck1">
   <label class="form-check-label" for="exampleCheck1">  divided into installments</label>
 </div>
</div>

                       </div>
                    <div class="table-responsive" v-if="cash">
                     <table class="table table-bordered mt-5">
                       <thead>
                         <tr>
                           <th width="50px" style="background-color: #fff">
                             <div class="action-container">
                               <button type="button" class="btn btn-primary" @click="addpayment()">
                                +
                               </button>
                             </div>
                           </th>
                           <th scope="col">installment</th>
                           <th scope="col">percentage</th>
                           <th scope="col">value</th>
                           <th scope="col">Payment details</th>
                           <th scope="col"> date</th>
                         </tr>
                       </thead>
                       <tbody id="table-body-payment">
                         <tr  v-for="(pay,index) in payment" :key="index">
                           <td style="background-color: #fff">
                             <div class="action-container">
                               <button 
                                 class="btn btn-danger"
                                 @click="removepRow(index)"
                                 type="button"
                               >
                             x
                               </button>
                             </div>
                           </td>
                           <td>
                             <input
                               class="form-control input-default "
                               type="text"
                               placeholder="الأولى"
                               v-model="pay.name"
                             />
                           </td>
                           <td>
                             <input
                               class="form-control input-default "
                               type="text"
                               placeholder="30%"
                               v-model="pay.percentage"
@input="checkerpayment(pay)"
                               max="100"
                             />
                           </td>
                           <td>
                                  <input
                               class="form-control input-default "
                               type="text"
                               placeholder="62100"
                               :value=" pay.amount = pay.percentage * overall / 100"
                      hidden
                             />

                             <input
                               class="form-control input-default "
                               type="text"
                               placeholder="62100"
                         
                        v-model="pay.amount"
                             />
                           </td>
                           <td>
                             <input
                               class="form-control input-default "
                               type="text"
                               placeholder="عند طلب التوريد"
                               v-model="pay.note"
                        
                             />
                           </td>

                           <td>
                             <input
                               class="form-control input-default "
                               type="date"
                             
                               v-model="pay.date"
                        
                             />
                           </td>
                       

                         </tr>
                       </tbody>
                     </table>
                   </div>
                   </div>
                   </div>
                 

        <div class="row justify-content-center">
             
           <div class="container">
              <div class="row justify-content-center">
                 <div class="col">
                    <div class="card">
                       <div class="card-header">
                         <button class="btn btn-primary"  v-if="totalpo_expenses  <= projectselected.po_budget"  type="submit">
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
     <iframe :src="'/uploads/purchase_order/'+path" style="width: 100%; height: 100%"  class="embed-responsive-item" title="Iframe Example"></iframe> 
   </div>
 </div>
</div>

  </div>
</template>
<script>
  var converter = require('number-to-words');

   export default {
props:['data', 'role'],
       data(){
return{

quotation:'',
project_id:'',

products:[],
allerros:[],
 suppliers:[],
  supplier_id:'',
status:'',
condition:[{}],
date:'',
no_vat:false,
wordtotalAmount:false,
cash:false,
subject:'',
order_for:'',
images:[],
wordoverall:'',
test:'',
cc:'',
ref:'',
userz:[],
projects:[],
discount:'',
choice:[],
projectselected:{},
files:this.data.purchase_order_attachment,
to:'',
contentmanager:'',
choices_product:[],
path:'',
transportation:'',
delivery_date:'',
material_avalibility:'',
subject:'',
payment: [],

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


         deletefile(file){

Vue.set(file,'deleted',true)

         },

         restorefile(file){

           Vue.set(file,'deleted',false)

         },

         preview(path){
 this.path = path
 window.$("#preview").modal("show");
},

         autocompletez2(name,index){
this.id = index
 

    this.choices_product = []
if( name !== null){
 axios({
   method:'post',
   url:'/autoCompleteProduct',
data:{
 name:name,

}
 }).then(res=>{
   this.choices_product = res.data.data
 })
}
},

perdiscount(e){
     
     var  discount = 0
     if(this.totalAmount){
       discount = (Number(this.discount)   * Number(this.totalAmount) / Number(100))
       return this.test = discount.toFixed(2) 
        }      
     
     },
     valuediscount(e){
        var   discount = 0
        if(this.totalAmount){
       discount = (Number(this.test) * Number(100) / Number(this.totalAmount))
       return this.discount = discount.toFixed(2) 
        }
     }
     ,

         update(data,pro){
   this.choices_product = []

Vue.set(pro,'dis',data.name)
Vue.set(pro.pivot,'product_id',data.id)


},



        checker(){
 if(this.discount >= 0 && this.discount <= 100){
this.discount = this.discount
 }
if(this.discount  < 0 ){
   
   this.discount = 0
}

if(this.discount > 100){
 this.discount = 100
}




},

checkerpayment(e){
 
 if(e.percentage >= 0 && e.percentage <= 100){

Vue.set(e,'percentage',e.percentage)
 }
if(e.percentage  < 0 ){
   

   Vue.set(e,'percentage',0)
}

if(e.percentage > 100){
Vue.set(e,'percentage',100)
}




},

                                      supplier(){
  
  axios({
  url:'/supplierselex',
  method:'get',
  }).then(res=>{
  

      
   res.data.data.forEach(n=>{
                    if(Array.isArray(n)){
                        n.forEach(z=>{
this.suppliers.push(z)
                   })
                 }else{

let vm = []

                  Object.keys(n).map((e)=>{

               this.suppliers.push(n[e])
                    })

                }
                       })
  

  })
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
  

                       this.getCostCenter()
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

submit(){

       const config = {

                   headers: { 'content-type': 'multipart/form-data' }

               }

               let formData = new FormData();



if(this.project_id){
  formData.append('project_id', this.project_id);
}
 if(this.payment.length > 0){
  formData.append('payment', JSON.stringify(this.payment));
  }
   if(this.products.length > 0){
  formData.append('attr', JSON.stringify(this.products));
  }

if(this.images){
  formData.append('count', this.images.length);
}

var deletedfiles = []
this.files.forEach(e=>{

 if(e.deleted){
   deletedfiles.push(e.id)
 }

})

formData.append('deletedfiles',deletedfiles);

this.images.forEach((element, index, array) => {
 if(element !== undefined){
formData.append('files-' + index, element);
 }
    
   });



if(this.overall){
  formData.append('overall', this.overall);
  }

  if(this.cash){
  formData.append('cash', this.cash);
  }

  if(this.discounttotal){
  formData.append('discount', this.discounttotal);
  }
  if(this.discount){
  formData.append('percentage_discount', this.discount);
  }
  




if(this.Vat){
  formData.append('vat', this.Vat);
  }
  if(this.totalAmount){
  formData.append('total', this.totalAmount);
  }

if(this.supplier_id){
  formData.append('supplier_id', this.supplier_id);
}

if(this.date){
  formData.append('date', this.date);
}

if(this.subject){
  formData.append('subject', this.subject);
}

if(this.delivery_date){
  formData.append('delivery_date', this.delivery_date);
}

if(this.transportation){
  formData.append('transportation', this.transportation);
}

if(this.material_avalibility){
  formData.append('material_avalibility', this.material_avalibility);
}

if(this.order_for){
  formData.append('order_for', this.order_for);
}

if(this.ref){
  formData.append('ref', this.ref);
}



if(this.no_vat){
  formData.append('no_vat', this.no_vat);
  }
  if(this.cash){
  formData.append('cash', this.cash);
  }

  if(this.discounttotal){
  formData.append('discount', this.discounttotal);
  }
  if(this.discount){
  formData.append('percentage_discount', this.discount);
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
   axios.post('/user/purchase_action/'+this.data.id,formData, {
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
window.location.href = ('/user/purchase_table')

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

addproduct(){
   this.products.push({dis:''})
},
removeproduct(index){
this.products.splice(index,1)
}
,

 addpayment(){
   this.payment.unshift({})
},
removepRow(index){
this.payment.splice(index,1)
}

},
       mounted() {
      
this.project_id = this.data.project_id,

this.order_for = this.data.order_for
this.condition = this.data.note,
this.date =this.data.date,
this.supplier_id = this.data.supplier_id,
this.subject = this.data.subject,
this.ref = this.data.ref,
this.matrial_request_cycle = this.data.matrial_request_cycle ?? [],
this.to = this.data.to,
this.discount = this.data.percentage_discount
this.test = this.data.discount 
this.cash = this.data.cash == '1' ? true : false
this.no_vat = this.data.on_vat == '1' ? true : false
this.payment = this.data.note,
this.material_avalibility = this.data.material_avalibility,
this.transportation = this.data.transportation,
this.delivery_date = this.data.delivery_date,

this.data.attributes2.forEach(e=>{
 this.products.push(e)
})

this.data.attributes.forEach(e=>{
 this.products.push({id:e.id, dis:e.pivot.dis,qty:e.pivot.qty,product_id:e.pivot.product_id,unit:e.pivot.unit,unit_price:e.pivot.unit_price,})
})
this.supplier()
this.project()
       },
       computed:{

totalpo_expenses(){
return (Number(this.overall) + Number(this.projectselected.po_expenses))
},

scailing(){
var data =  this.products

data.forEach(e=>{

  var total = (e.qty * e.unit_price)

  e.total = total.toFixed(2)

})

return data
},


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

this.wordtotalAmount = converter.toWords(sum);

return sum
},
         Vat: function () {
       var sum = 0;
       if(this.no_vat == true){
sum = (Number(15) * Number(this.after_discount) / Number(100)) ?? 0
sum = Math.round(sum)


       }

       return sum

},




discounttotal:function(){
var discount =0
if(this.totalAmount !== 0 && this.test  ){
discount = (Number(this.test )) 
}


return discount
},

after_discount:function(){
var sum = ( Number(this.totalAmount)  -   Number(this.discounttotal) )
return sum.toFixed(2) 
},


overall:function(){
var overall = ( Number(this.after_discount) + Number(this.Vat) )

this.wordoverall = converter.toWords(overall);

return overall
}
},


   }
   
</script>
