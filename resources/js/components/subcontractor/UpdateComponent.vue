<template>
   <div >
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
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="to" placeholder="to">
                           </div>
                        </div>
                     </div>
                    <div class="form-group">
                     <label for="password" class="form-label">conent</label>
                     <textarea class="form-control"   v-model="contract_no" rows="4">
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
                              <td><a class="btn btn-danger"   :href="'/uploads/subcontractor/'+cycle.path"   download >download</a></td>

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
                           <th style="width:30%;"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>

                           <th><strong>Prev. Qty</strong></th>

                           <th><strong>Current Qty</strong></th>

                           <th><strong>total Qty</strong></th>
                           
                           <th><strong>Excution_percentage</strong></th>

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
                              <textarea v-model="product.name" readonly class="form-control">
                              </textarea>
                           </td>
                     
                           <td>     <input v-model="product.unit" readonly class="form-control"></td>
                           <td>     <input v-model="product.expctedqty" readonly class="form-control"></td>
                           <td>     <input v-model="product.previous_qty" readonly class="form-control"></td>
                           <td>     <input v-model="product.currentqty" class="form-control"></td>
                           <td>     <input v-model="product.qty" readonly class="form-control"></td>
                           <td>     <input v-model="product.Excution_percentage"  class="form-control"></td>
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
       
         </div>
         
         <div class="container" v-for="inv in invoice" :key="inv.id">
            <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Deduct prev. Amount  {{inv.ref}} : {{inv.total}}</h4>
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
                        <h4 class="card-title">total_amount : {{data.total - data.vat}}</h4>
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
 

                        <h4 class="card-title">VAT : {{data.vat}}</h4>
                     </div>
                  </div>
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
                            <div class="accordion__item" :key="data.id"  v-for="data in data.subcontractor">
                                <template v-if="data.comment_subcontractor_cycle">
                                <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">{{data.role.name}}</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                    <div class="accordion__body--text" >
                                        {{data.comment_subcontractor_cycle.content}}
                                    </div>
                                    
                                    <a  :href="'/uploads/subcontractor/'+cycle.path" v-for="cycle in data.comment_subcontractor_cycle.attachment_subcontractor_cycle" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
                                        file
                                        </span></a>
                                </div>
                                </template>
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
      <iframe :src="'/uploads/subcontractor/'+path" style="width: 100%; height: 100%"  class="embed-responsive-item" title="Iframe Example"></iframe> 
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
props:['data'],
        data(){
return{

quotation:'',
project_id:'',
products:[{}],
allerros:[],
projects:[],
status:'',
condition:[{}],
no_vat:false,
date:'',
subject:'',
contract_no:'',
images:[],
cc:'',
ref:'',
userz:[],
invoice_ON:'',
payment_no:'',
choice:[],
path:'',
files:this.data.files,
to:'',
contentmanager:'',
matrial_request_cycle:[],
transportation:'',
delivery_date:'',
material_avalibility:'',
subject:'',
}

        },

        methods:{

         
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


if(this.invoice_ON){
	 formData.append('invoice_ON', this.invoice_ON);
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

if(this.contentmanager !== null){
	 formData.append('contentmanager', JSON.stringify(this.contentmanager));
}



if(this.date){
	 formData.append('date', this.date);
}


if(this.subject){
	 formData.append('subject', this.subject);
}
if(this.contract_no){
	 formData.append('contract_no', this.contract_no);
}

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.totalAmount){
	 formData.append('total', this.totalAmount);
}
if(this.Vat){
	 formData.append('vat', this.Vat);
}

if(this.products.length > 0){
	 formData.append('attr', JSON.stringify(this.products));
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
    axios.post('/user/subcontractor/update/'+this.data.id,formData, {
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
window.location.href = ('/user/index_subcontractor_inv/'+this.id) 

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
 
 addcondition(){
    this.condition.push({})
},
removecondition(index){
this.condition.splice(index,1)
}
 
 },
        mounted() {
       this.project()
this.project_id = this.data.project_id,
this.products = this.data.attributes,
this.condition = this.data.note,
this.date =this.data.date,
this.subject = this.data.subject,
this.contract_no = this.data.contract_no,
this.ref = this.data.ref,
this.matrial_request_cycle = this.data.matrial_request_cycle ?? []
this.to = this.data.to
this.invoice_ON = this.data.invoice_ON
this.payment_no = this.data.payment_no

        },
     
        computed:{

invoices(){
   var total = 0
   if(this.invoice && this.invoice.length > 0){
      this.invoice.forEach(e=>{
total = (Number(e.total) + Number(total))
})
   }

return total
},

               scaling(){
this.products.forEach(e=>{


   
   e.qty = (Number(e.currentqty) + Number(e.previous_qty))
 
  var Excution_value = (Number(e.unit_price) * Number(e.qty) * Number(e.Excution_percentage) / 100  )
  Excution_value = (Excution_value).toFixed(2)
   e.total = Number(Excution_value)

})

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
                     Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.totalAmount) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum
   
   },
       },

    }
</script>
