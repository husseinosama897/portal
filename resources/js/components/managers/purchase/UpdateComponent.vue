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
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
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
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
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
                          </tr>
                          </thead>

                          <tbody>
                            <tr v-for="cycle in data.purchase_order_attachment" :key="cycle.id" >
                              <td>{{cycle.path}}</td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/purchase_order/'+cycle.path"   download >download</a></td>

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
                           <th ><strong>No.</strong></th>
                           <th style="width: 0%"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>
                           <th><strong>unit price</strong></th>
                           <th><strong>total</strong></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                     

                      <tr v-for="(product,index) in scailing" :key="index">
                       
                           <td><strong>{{index + 1}}</strong></td>
                           <td style="width: 30%">
                              <textarea v-model="product.dis"
                                @input="autocompletez2(product.dis,index)"

                              class="form-control" style="max-height: 2.3rem;">
                              </textarea>
  
                           </td>
                           <td>     <input v-model="product.unit" class="form-control"></td>
                           <td>     <input v-model="product.qty" class="form-control"></td>
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

                                
                                name=""
                                id="discount-percentage discount-percentage-text"
                                placeholder="10"
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
                                <button class="btn btn-primary " type="button" @click="addpayment()">
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
                                  @click="removepayment(index)"
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
                      <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title"> managers Comments</h4>
                           
                            </div>
                           <div class="card-body">
                                <div id="accordion-twelve" class="accordion accordion-rounded-stylish accordion-gradient">
                                    <div class="accordion__item" :key="data.id"  v-for="data in data.purchase_order_cycle">
                                        <template v-if="data.comment_purchase_order_cycle">
                                        <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">{{data.role.name}}</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                            <div class="accordion__body--text" >
                                               {{data.comment_purchase_order_cycle.content}}
                                            </div>
                                            
                                            <a  :href="'/uploads/purchase_order/'+cycle.path" v-for="cycle in data.comment_purchase_order_cycle.attachment_purchase_order_cycle" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
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
   var converter = require('number-to-words');

    export default {
props:['data', 'role'],
        data(){
return{

quotation:'',
project_id:'',
products:[],
wordtotalAmount:'',
   wordoverall:'',
   cash:false,
   no_vat:false,
   discount:'',
allerros:[],
  suppliers:[],
   supplier_id:'',
status:'',
condition:[{}],
date:'',
test:'',
subject:'',
order_for:'',
images:[],
cc:'',
ref:'',
userz:[],
projects:[],

choice:[],
to:'',
contentmanager:'',
matrial_request_cycle:[],
transportation:'',
path:'',
delivery_date:'',
material_avalibility:'',
subject:'',
payment: [],
}

        },

        methods:{

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
preview(path){
  this.path = path
  window.$("#preview").modal("show");
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



if(this.supplier_id){
	 formData.append('supplier_id', this.supplier_id);
}

if(this.date){
	 formData.append('date', this.date);
}

if(this.subject){
	 formData.append('subject', this.subject);
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
    axios.post('/managers/action_purchase_order/'+this.data.id,formData, {
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
 window.location.href = ('/managers/index_purchase_order')

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
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 
 addpayment(){
    this.payment.unshift({})
},
removepayment(index){
this.payment.splice(index,1)
}
 
 },
        mounted() {
       
          this.supplier()
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
this.test = this.data.discount ?? ''
this.cash =  parseInt(this.data.cash) == 1 ? true : false

this.no_vat =  parseInt(this.data.on_vat)  == 1 ? true : false
this.payment = this.data.note,
this.material_avalibility = this.data.material_avalibility,
this.transportation = this.data.transportation,
this.delivery_date = this.data.delivery_date,

this.data.attributes2.forEach(e=>{
  this.products.push(e)
})

this.data.attributes.forEach(e=>{
  this.products.push({id:e.id,dis:e.pivot.dis,qty:e.pivot.qty,product_id:e.pivot.product_id,unit:e.pivot.unit,unit_price:e.pivot.unit_price,})
})

this.project()
        },
     
        computed:{

          
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
