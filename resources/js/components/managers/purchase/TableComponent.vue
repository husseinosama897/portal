<template>
  <div >
    <div class="card">
<div class="card-body">
  <div class="row">
<div class="col-4">
  <label for="password" class="form-label">
    PO
  </label>
  <input type="text" class="form-control input-default " v-model="ref" placeholder="PO..">
</div>

<div class="col-4">
  <label for="password" class="form-label">
   from 
  </label>
  <input type="date" class="form-control input-default " v-model="from" placeholder="to">
</div>
<div class="col-4">
  <label for="password" class="form-label">
   to
  </label>
  <input type="date" class="form-control input-default " v-model="to" placeholder="to">
</div>

<div class="col-4">
  <label for="password" class="form-label">
   delivery date  
  </label>
  <input type="date" class="form-control input-default " v-model="delivery_date" placeholder="to">
</div>

<div class="col-4">
  <label for="password" class="form-label">
    project  
  </label>
  <select  class="form-select select2" v-model="project_id">
    <option ></option>
  <option v-for="proj in projects"  :value="proj.id" :key="proj.id">{{proj.name}}</option>
  </select>
</div>

<div class="col-4">
  <label for="password" class="form-label">
    user  
  </label>
  <select  class="form-select select2" v-model="user_id">
    <option ></option>
  <option v-for="user in users" :value="user.id" :key="user.id">{{user.name}}</option>
  </select>
</div>

<div class="col-4">
  <label for="password" class="form-label">
    suppliers  
  </label>

  <input @input="supplier_autocomplete"   v-model="supplier_x.name" class="form-control">


  <ul  v-if="supplierList.length > 0" class="list-group">
                                 <li class="list-group-item" @click="takesupplierList(supplier)" v-for="supplier in supplierList"  :key="supplier.id" >{{supplier.comp ? supplier.comp : supplier.supplier_name}}</li>
                              </ul>

</div>

</div>

</div>

    </div>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                    
                              

                              <a href="/managers/customizeWorkpurchase" class="btn btn-primary" >

Setting

</a>


<a href="/managers/Export/purchase_order" class="btn btn-primary" >

export 

</a>


                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                                <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                     <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                                 <th><strong>Delivery date</strong></th>
                                             
                                               <th><strong>Delivery feedback</strong></th>
                                       
                                             
                                             

                                             


                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.purchase_order">  
                                                    <td data-table="CODE">  


{{data.purchase_order.ref}}</td>
<td data-table="DATE"> {{data.purchase_order.date}}</td>
                                                <td data-table="USER" v-if=" data.purchase_order.user ">{{data.purchase_order.user.name}}</td>
                              
                                                <td data-table="DESCRIPTION">{{data.purchase_order.subject}}</td>
                                                                      
   
                                                <td data-table="Delivery date">{{data.purchase_order.delivery_date  ? data.purchase_order.delivery_date  : 'unknown'}}</td>
                                                     <td data-table="Delivery feedback" v-if="data.purchase_order.delivery_date < today && data.purchase_order.closed !== 1  "><span class="badge bg-danger border-0">warning</span></td>
   
                                                                               <td data-table="Delivery feedback" v-if="data.purchase_order.delivery_date >= today  && data.purchase_order.closed !== 1  "><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="Delivery feedback" v-if="data.purchase_order.delivery_date >= today  && data.purchase_order.closed == 1  "><span class="badge bg-success border-0">closed</span></td>

   <td v-if="data.purchase_order.delivery_date == null">
   undefined
   </td>



                                                 <td data-table="STATUS" v-if="data.status == 2">
                                                   <span class="badge bg-danger border-0" >REJECTED</span></td>
                                                                 <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                                 <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="VAT">{{data.purchase_order.vat}}</td>
                                                    <td data-table="TOTAL">{{data.purchase_order.total}}</td>
                                                 <td  data-table="ACTION">
												
  
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/purchase_orderreturn/'+data.purchase_order.id">preview</a>
      <a class="dropdown-item" :href="'/managers/update_purchase_order/'+data.purchase_order.id">update</a>
    
      <a class="dropdown-item"   href="#" @click="pay(data.purchase_order)"> forward to daily report</a>
    
  
  </div>
</div>
												</td>
                        </template>
                                            </tr>
								
					

                                        </tbody>
                                    </table>
                                      <pagination :data="datas" @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
				
				
         
      
                </div>



                <div class="modal fade bd-example-modal-lg"  id="preview" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <img src="/Tiny.jpg" class="img-fluid" alt="Responsive image">

    </div>
  </div>
</div>
				
    


              </div>

</template>

<script>
import moment from 'moment'

    export default {
        props:['subcontractor'],
        data(){
return{

datas:{},
images:[],
allerros:[],
today:'',
purchase_payment:{},
ref:'',
from:'',
supplierList:[],
to:'',
delivery_date:'',
accountt:{name:'الحساب الرئيسي'},
projects:[],
suppliers:[],

total:'',
users:[],
user_id:'',
project_id:'',
level:'',
capital_array:[],
supplier_x:{},
supplier_id:'',
}

        },

        methods:{
          

          takesupplierList(supplier_prameter){
this.supplier_id = supplier_prameter.id
this.supplier_x.name = supplier_prameter.comp ? supplier_prameter.comp  : supplier_prameter.supplier_name
this.supplierList.splice(0)
          },
supplier_autocomplete(){
this.supplier_id = ''
  axios({
	method:'post',
	'url':'/managers/getselectboxsupp'
  ,
  data:{
name:this.supplier_x.name
    }
}).then(res=>{
    this.supplierList = res.data.data
  })

},
          updateaccount2(acc){
this.accountt = {}

this.accountt  = acc



},

capital(){
axios({
	method:'get',
	'url':'/managers/moneycapitalsaccount'
}).then(res=>{

	this.capital_array = res.data.data
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
                      }
                      else{
    
    let vm = []
    
                       Object.keys(n).map((z)=>{
    
                    this.suppliers.push(n[z])
                         })
    
                     }

                            })
           
    
    })
    },

    pay(purchase){
    
      let formData = new FormData();
      if(purchase.supplier_id){
   formData.append('supplier_id', purchase.supplier_id);
   }

   if(purchase.id){
   formData.append('purchase_order_id', purchase.id);
   }

   formData.append('type','PO');




   axios.post('/managers/report/daily/financial/insert',formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   })
   .then(res=>{
    window.$("#succ").modal("show");
    })

    },

          user(){
    
    axios({
        url:'/CHunking_user',
        method:'get',
    }).then(res=>{
        
           
         
    
                        res.data.data.forEach(n=>{
                          if(Array.isArray(n)){
                             n.forEach(z=>{
    this.users.push(z)
                        })

                      }else{
                        Object.keys(n).map((z)=>{
    
    this.users.push(n[z])
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
            
    
    })
    },
    onImageChange(e,data) {   
            this.images.splice(0)   
this.images.push(e.target.files[0])

    },
 
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_subcontractor_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {

      
      let formData = new FormData();

if(this.project_id){
	 formData.append('project_id', this.project_id);
}

if(this.supplier_id){
	 formData.append('supplier_id', this.supplier_id);
}
if(this.delivery_date){
	 formData.append('delivery_date', this.delivery_date);
}

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.user_id){
	 formData.append('user_id', this.user_id);
}


axios.post('/managers/returnjsonpurchase?page='+page,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
}).then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){

      let formData = new FormData();

if(this.project_id){
	 formData.append('project_id', this.project_id);
}


if(this.to){
	 formData.append('to', this.to);
}


if(this.from){
	 formData.append('from', this.from);
}


if(this.supplier_id){
	 formData.append('supplier_id', this.supplier_id);
}

if(this.delivery_date){
	 formData.append('delivery_date', this.delivery_date);
}

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.user_id){
	 formData.append('user_id', this.user_id);
}

axios.post('/managers/returnjsonpurchase',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})

	.then(response => {
                    
              this.datas =  response.data.data
            
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
          this.today = moment().format('DD/MM/YYYY');
     this.datajson()
     this.project()
     this.user()
     this.capital()
     this.supplier()
        },
      
        watch:{
          'ref':function(){
            this.datajson()
          } ,
'to':function(){
            this.datajson()
          } ,
          'from':function(){
            this.datajson()
          } ,
'delivery_date':function(){
            this.datajson()
          } , 
'project_id':function(){
            this.datajson()
          } ,
'user_id':function(){
            this.datajson()
          } ,
'supplier_id':function(){
            this.datajson()
          } 
        },
        computed:{
          rest(){
            var sum = Number(this.purchase_payment.paid) + Number(this.total) - ( Number(this.purchase_payment.total)   ) ?? 0

            sum = sum.toFixed(2)

            return sum 
          },
       
        }
    }
</script>
