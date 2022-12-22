<template>
   <div class="container">
      <div class="alert alert-danger"  v-if=" totalpo_expenses  > projectselected.po_budget" role="alert">
 the current budget less than your order 
</div>

      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
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
                    
              

                        <div class="col-xl-5 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> project</label>
                                   <select class="form-select select2" @change="getCostCenter" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                   

                         <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                <label class="form-label" > supplier  :</label>
                                   <select class="form-select select2"  @change="updating_data" v-model="supplier_id">
                              <option  value="0"></option>
                                 <option  v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{supplier.customer_name ? supplier.customer_name : supplier.comp}}</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-xl-3 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> pricing supplier</label>
                              <input type="text" lang="en-US"  @change="autocompletepricing_supplier" class="form-control input-rounded" v-model="pricing_supplier.name" placeholder="PS-..">
                         
                              <ul  v-if="pricing_suppliers.length > 0" class="list-group">
                                 <li class="list-group-item" @click="takethispricing(cho)" v-for="cho in pricing_suppliers"  :key="cho.id" >{{cho.ref}}</li>
                              </ul>


                           </div>
                        </div>
                     </div>
                     <div class="row">
               
               <div class="col-xl-5 mb-2">
                 <label for="password" class="form-label"> material avalibility</label>
                 <div class="form-group">
                    <input type="text"  @change="updating_data" class="form-control input-default "
                 
                       v-model="material_avalibility" >
            
                 </div>
              </div>

              <div class="col-xl-5 mb-2">
                 <label for="password" class="form-label"> transportation</label>
                 <div class="form-group">
                    <input type="text"  @change="updating_data" class="form-control input-default "
                 
                       v-model="transportation" >
            
                 </div>
              </div>
        
              <div class="col-xl-2 mb-2">
                 <div class="form-group">
                    <label for="password" class="form-label">delivery date</label>

                    <input type="date" @change="updating_data"  lang="en-US" class="form-control input-rounded" v-model="delivery_date" placeholder="input-rounded">
                 </div>
              </div>

           </div>
           
                     <div class="row">
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <label for="password" class="form-label"> to</label>
                              <input type="text"  @change="updating_data" class="form-control input-default " v-model="to" placeholder="to">
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
                     <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" >
                     </div>
                     <div class="form-group">
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" @change="updating_data" v-model="order_for" rows="6">
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
                           <th style="width: 30%"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>
                           <th><strong>unit price</strong></th>
                           <th><strong>total</strong></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(product,index) in scailing" :key="index">
                           <td></td>
                           <td><strong>{{index + 1}}</strong></td>
                           <td style="width: 30%">
                              <textarea v-model="product.dis"
                                @input="autocompletez2(product.dis,index)"

                              class="form-control" style="max-height: 2.3rem;">
                              </textarea>
               
                       
                           

        <ul class="list-group"         v-if="choices_product.length > 0   && product.dis !== ''       && index == id">
  <li v-for="data in choices_product" @click="update(data,product)" :key="data.id" class="list-group-item">{{data.name}}</li>
</ul>

                           </td>
                           <td>     <input v-model="product.unit" @change="updating_data" class="form-control"></td>
                           <td>     <input v-model="product.qty" @change="updating_data" class="form-control"></td>
                           <td>     <input v-model="product.unit_price" @change="updating_data" class="form-control"></td>
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

                                @change="updating_data"
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
                                @change="updating_data"
                                
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
    <input type="checkbox" class="form-check-input" @change="updating_data" v-model="no_vat" id="exampleCheck1">
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
    <input type="checkbox" class="form-check-input"  @change="updating_data" v-model="cash" id="exampleCheck1">
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

                                @change="updating_data"
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
                                @change="updating_data"
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

                         @change="updating_data"
                              />
                            </td>
                            <td>
                              <input
                                class="form-control input-default "
                                type="text"
                                placeholder="عند طلب التوريد"
                                v-model="pay.note"
                                @change="updating_data"
                              />
                            </td>

                            <td>
                              <input
                                class="form-control input-default "
                                type="date"
                              
                                v-model="pay.date"
                                @change="updating_data"
                              />
                            </td>
                        

                          </tr>
                        </tbody>
                      </table>
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
                       

                        <button class="btn btn-primary"  v-if="totalpo_expenses  <= projectselected.po_budget"  type="submit">
                        submit
                        </button>
                        <button class="btn btn-primary"   @click="submit2()" type="button" >
                        perview
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

   </div>
</template>
<script>
   var converter = require('number-to-words');

   export default {
      props:['refdata'],
       data(){
   return{
   project_id:1,
   products:[{}],
   pricing_supplier:{},
   pricing_suppliers:[],

   test:'',
   allerros:[],
   suppliers:[],
   choices_product:[],
   id:'',
   wordtotalAmount:'',
   wordoverall:'',
   supplier_id:'',
   payment:[{}],
   date:'',
   cost_centers:[],
   cash:false,
   cost_center_id:'',
   subject:'',
   projects:[],
   order_for:"with reference to the above subject your quotation no xxxxxx (rev.0) Dated on XXXXX , we would like to place the purchase order for Below Items.",
   cc:'',
   ref:this.refdata,
   projectselected:{},
   userz:[],
   no_vat:false,
   choice:[],
   to:'',
   transportation:'',
   delivery_date:'',
   discounttota:'',
   material_avalibility:'',
   subject:'',
   images:[],
   discount:'',
   }
   
       },
   
       methods:{

         autocompletepricing_supplier(){
this.pricing_suppliers = []

axios({
   url:'/pricing_suppliersAutoComplete',
   method:'post',
   data:{
      ref:this.pricing_supplier.name
   }
}).then(res=>{
   this.pricing_suppliers = res.data.data

})

         },

         takethispricing(choice){
axios({
   url:'/getricingdetails/'+choice.id,
method:'post'
}).then(res=>{

   res.data.data.attributes2.forEach(e=>{
  this.products.push(e)
})

res.data.data.attributes.forEach(e=>{
  this.products.push({id:e.id, dis:e.pivot.dis,qty:e.pivot.qty,product_id:e.pivot.product_id,unit:e.pivot.unit,unit_price:e.pivot.unit_price,})
})

this.payment = res.data.data.note

this.pricing_supplier.id = res.data.data.id 

this.supplier_id = res.data.data.supplier_id

this.pricing_supplier.name = res.data.data.ref

this.pricing_supplier.id = res.data.data.id
this.discount = res.data.data.percentage_discount
this.test = res.data.data.discount 
this.cash = res.data.data.cash == '1' ? true : false
this.no_vat = res.data.data.on_vat == '1' ? true : false

this.order_for = res.data.data.order_for
this.pricing_suppliers = []

})
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

         update(data,pro){
  	this.choices_product = []

Vue.set(pro,'dis',data.name)
Vue.set(pro,'id',data.id)


},

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
   
                     onImageChange(e) {     
   this.images.push(e.target.files[0])
           },
   
    
updating_data(){
   
   const  data = {ref:this.ref,
     
     note:this.payment,
    supplier_id: this.supplier_id,
     to:this.to,
     cost_center_id:this.cost_center_id,
     total:this.overall,
     subtotal:this.totalAmount,
     discount:this.discounttotal,
     date:this.date,
     order_for: this.order_for,
     vat:this.Vat,
     project:projectname,
     project_id:this.project_id,
     attributes:this.products,
     transportation:this.transportation,
     delivery_date:this.delivery_date,
     material_avalibility:this.material_avalibility,
     subject: this.subject
       }
     
     this.$cookies.set('purchase',data);
     

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
   submit2(){

      var projectname = {}
this.projects.forEach(e=>{
    if(e.id == this.project_id){
        projectname.name = e.name
    }
})


   
   const  data = {ref:this.ref,
     
   note:this.payment,
  supplier_id: this.supplier_id,
   to:this.to,
   cost_center_id:this.cost_center_id,
   total:this.overall,
   subtotal:this.totalAmount,
   discount:this.discounttotal,
   date:this.date,
   order_for: this.order_for,
   vat:this.Vat,
   project:projectname,
   project_id:this.project_id,
   attributes:this.products,
   transportation:this.transportation,
   delivery_date:this.delivery_date,
   material_avalibility:this.material_avalibility,
   subject: this.subject
     }
   
   this.$cookies.set('purchase',data);
   
   
   window.location.href = ('/user/prepurchasereturn')
   
   },
   
   submit(){
   
     	const config = {
   
                   headers: { 'content-type': 'multipart/form-data' }
   
               }
   
               let formData = new FormData();
      if(this.supplier_id){
   formData.append('supplier_id', this.supplier_id);
   }
       if(this.cost_center_id){
   formData.append('cost_center_id', this.cost_center_id);
   }

   if(this.project_id){
   formData.append('project_id', this.project_id);
   }
 
   if(this.payment.length > 0){
   formData.append('payment', JSON.stringify(this.payment));
   }
   if(this.scailing.length > 0){
   formData.append('attr', JSON.stringify(this.scailing));
   }
   if(this.date){
   formData.append('date', this.date);
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
   

   if(this.Vat){
   formData.append('vat', this.Vat);
   }
   if(this.totalAmount){
   formData.append('total', this.totalAmount);
   }
   if(this.subject){
   formData.append('subject', this.subject);
   }
   if(this.order_for){
   formData.append('order_for', this.order_for);
   }
   
   if(this.overall){
   formData.append('overall', this.overall);
   }

   if(this.ref){
   formData.append('ref', this.ref);
   }
      if(this.to){
   formData.append('to', this.to);
      }
   if(this.transportation){
   formData.append('transportation', this.transportation);
   }
   if(this.delivery_date){
   formData.append('delivery_date', this.delivery_date);
   }
   if(this.material_avalibility){
   formData.append('material_avalibility', this.material_avalibility);
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
   
   axios.post('/user/insarting_data',formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   })
   .then(res=>{
   
   this.$cookies.remove("purchase");
   
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
   this.products.push({})
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

  
   },
 

       mounted() {
       

     this.project()
     this.supplier()
     var dataa =  this.$cookies.get('purchase');
   

   this.ref = dataa.ref,
     this.supplier_id = dataa.supplier_id
   this.payment = dataa.note,
   
   this.to = dataa.to
   
   this.totalAmount = dataa.total
   
   this.order_for =dataa.order_for
   this.Vat = dataa.vat,
   
   this.products = dataa.attributes
   this.transportation = dataa.transportation
   this.delivery_date = dataa.delivery_date
   this.project_id = dataa.project_id

   this.date = dataa.date
   this.material_avalibility =dataa.material_avalibility
   this.subject = dataa.subject
   
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
