<template>
   <div >


      <div class="alert alert-danger"  v-if=" projectselected &&   projectselected.subcontractor_budget < total_expenses" role="alert">
 the current budget less than your order 
</div>

<div class="alert alert-danger"  v-if=" The_rest_of_the_contract_value < 0" role="alert">
The rest of the contract value less than your order 
</div>


<div class="alert alert-danger"  v-if="error" role="alert">
The rest of the contract value less than your order 
</div>


      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
            <div class="card" v-if="projectselected">
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
                    
                        <tr>
                           <td>
                           {{projectselected.subcontractor_budget}}
                        </td>
                        <td>
                           {{projectselected.subcontractor_expenses}}
                        </td>

                        <td>
                           {{totalAmount}}
                        </td>

                        <td>
                           {{ projectselected.subcontractor_expenses - totalAmount }}
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
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>

                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly v-model="invoice_ON" placeholder="invoice_ON">
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
                                   <select class="form-select select2" @change="getCostCenter" disabled="disabled" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
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
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" v-model="contract_on" rows="6">
                        </textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
     
            <div class="card">
               <div class="table-responsive">
                  <table class="table table-responsive-xl" style="width:100%">
                     <thead>
                        <tr>
                           <th style="width:2%;">
                              <a @click="addproduct()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>
                           <th style="width:1%" ><strong>No.</strong></th>
                           <th style="width:15%"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>

                           <th><strong>Prev. Qty</strong></th>

                           <th><strong>Current Qty</strong></th>

                           <th><strong>total Qty</strong></th>
                           
                           <th style="width:5%; padding:0;"><strong>Excution
                              percentage</strong></th>

                           <th><strong>unit price</strong></th>

                           <th><strong>total</strong></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(product,index) in scaling" :key="index">
                           <td style="width:2%;"></td>
                           <td style="width:1%;" ><strong>{{index}}</strong></td>
                           <td style="width:15%;">
                              <textarea v-model="product.name" readonly class="form-control">
                              </textarea>
                           </td>
                     
                           <td>     <input v-model="product.unit" readonly class="form-control"></td>
                           <td>     <input v-model="product.expctedqty" readonly class="form-control"></td>
                           <td>     <input v-model="product.previous_qty" readonly class="form-control"></td>
                           <td>     <input v-model="product.currentqty "  :class="product.error ? 'form-control is-invalid' : 'form-control'" >
                           
                           
                              <div id="validationServerUsernameFeedback" v-if="product.error" e class="invalid-feedback">
                                 quantity must be reduced
      </div>


                           </td>

                           <td>     <input v-model="product.qty" readonly  class="form-control"></td>
                           <td  style="width:5%;">     <input v-model="product.Excution_percentage"  class="form-control"></td>
                           <td>     <input v-model="product.unit_price" readonly class="form-control"></td>
                     
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
       

            <div class="container" v-for="inv in invoice" :key="inv.id">
            <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
              <a class="dropdown-item" :href="'/user/subcontractorreturn/'+inv.id">    <h4 class="card-title">Deduct prev. Amount  {{inv.invoice_ON}} : {{inv.total}}</h4></a>
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
                        <h4 class="card-title">The_rest_of_the_contract_value : {{The_rest_of_the_contract_value}}</h4>
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
                           
                           <button class="btn btn-primary"  v-if="The_rest_of_the_contract_value >=  0 && error == false  && projectselected.subcontractor_budget >= total_expenses"  type="submit">
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
import { sign } from 'crypto'

    export default {
        props:['refdata',
        'contract_total','id','projectt','num','invoice','attributes'],
        data(){
return{
cws:{},
quotation:'',
project_id:this.projectt,
products:[],
projects:[],
allerros:[],
no_vat:false,
payment:[{}],
date:'',
invoice_ON:this.num,
subject:'',
userz:[],
contractor:{},
contract_on:'With reference to the above subject, 6565',
choice:[],
cc:'',
ref:this.refdata,
to:'CP-HO',
contracts:[],
projectselected:{},
error:false,
transportation:'',
contractors:[],
  cost_centers:[],
   cost_center_id:'',
delivery_date:'',
material_avalibility:'',
subject:'',

}

        },


        methods:{
         updatecws(p){
this.cws.id =  p.id
this.cws.name = p.ref

this.contracts = []
},

         updatecontractor(p){
this.contractor.id =  p.id
this.contractor.name = p.comp ? p.comp : p.contractor_name

this.contractors = []
},
      
chunkcws(){
this.contracts = []
if( this.cws.name !== null){
	axios({
		method:'post',
		url:'/chunkcws',
data:{
	name:this.cws.name,

}
	}).then(res=>{
		this.contracts = res.data.data
	})
}

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
  this.date= '',
  this.subject= '',
  this.contract_on = '',
  this.to = ''
},
submit(){
          	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.totalAmount){
	 formData.append('total', this.totalAmount);
}
if(this.Vat){
	 formData.append('vat', this.Vat);
}
if(this.contractor.id){
   formData.append('contractor_id', this.contractor.id);
   }


    if(this.cost_center_id){
   formData.append('cost_center_id', this.cost_center_id);
   }

if(this.subject){
	 formData.append('subject', this.subject);
}
if(this.contract_on){
	 formData.append('contract_on', this.contract_on);
}

if(this.invoice_ON){
	 formData.append('invoice_ON', this.invoice_ON);
}

if(this.payment_no){
	 formData.append('payment_no', this.payment_no);
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
     axios.post('/user/subcontractorinsrting/'+this.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  this.$cookies.remove("subcontractor");

    window.location.href = ('/user/index_subcontractor_inv/'+this.id) 
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
   
   vat:this.Vat,

contract_on: this.contract_on,
   date:this.date,
attributes:this.products,

subject: this.subject
      }

this.$cookies.set('subcontractor',data);


 window.location.href = ('/user/presubcontractorreturn')

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
                    
                        
                        
                        var dataa =     this.$cookies.get('subcontractor')  ?? {};
if(Object.keys(dataa).length > 0){

   this.ref = dataa.ref  ? dataa.ref : this.refdata,
 this.payment = dataa.note ? dataa.note :null,
this.to = dataa.to ?  dataa.to:  null
this.totalAmount = dataa.total ? dataa.total : 0
 this.contract_on =dataa.contract_on  ? dataa.contract_on : this.contract_on
this.Vat = dataa.vat ? dataa.vat : 0,
this.products = dataa.attributes ?  dataa.attributes : this.attributes

 this.subject = dataa.subject ? dataa.subject : null

}else{
   this.attributes.forEach(e=>{

this.products.push({
 Excution_percentage:e.Excution_percentage,
 contract_withsubcontractor_id:e.contract_withsubcontractor_id,
 currentqty:0,
 expctedqty:e.expctedqty,
 id:e.id,
 name:e.name,
 previous_qty:e.previous_qty,
 qty:e.qty,
 total:e.total,
 unit_price: e.unit_price,
 unit:e.unit,
})

})

}

        },
            computed:{

invoices(){
   var total = 0
   if(this.invoice ){
      this.invoice.forEach(e=>{
total = (Number(e.total) + Number(total))
})
   }

return total
},

               scaling(){
this.products.forEach(e=>{
   
  
   var total = (Number(e.currentqty ) + Number(e.previous_qty))
   
e.error = e.expctedqty < total  && total >= 0  ? true : false

if(e.Excution_percentage){
   e.qty = (Number(e.currentqty) + Number(e.previous_qty))
   e.Excution_percentage = e.Excution_percentage ?? 0
  var Excution_value = (Number(e.unit_price) * Number(e.qty) * Number(e.Excution_percentage) / 100  )
  Excution_value = (Excution_value).toFixed(2)
   e.total = Number(Excution_value)


}

})

let product  = this.products.find(product=>
  true == product.error
)


if(product !== undefined){

   this.error == true

}



return this.products
            

},

               totalAmount: function () {
                 var sum = 0;
   if(this.scaling.length > 0){
   this.scaling.forEach(e=>{
      
   sum =  ( Number(sum) + Number(e.total)   ) 
  
   
                
                })
   
   }
   
   sum = (Math.round(sum) - Number(this.invoices))
   return sum
   },

   The_rest_of_the_contract_value(){
      var sum = (this.totalAmount  + this.invoices)
 var rest = (this.contract_total - sum )
   
return rest
},



   
total_expenses(){
return this.totalAmount + this.Vat + this.projectselected.subcontractor_expenses
},

                     Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.totalAmount) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum
   
   },
       },
      

       watch:{
         'total_expenses':function(){
            if(this.total_expenses  >= this.projectselected.subcontractor_expenses){

               window.$("#LowBudgetModal").modal("show"); 
      

            }
         }
       }

       
    }
</script>
