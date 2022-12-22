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
   date 
  </label>
  <input type="date" class="form-control input-default " v-model="date" placeholder="to">
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
  <select  class="form-select select2" v-model="supplier_id">
    <option ></option>
  <option v-for="supplier in suppliers" :value="supplier.id" :key="supplier.id">{{supplier.comp ? supplier.comp : supplier.customer_name}}</option>
  </select>
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
                                               <th><strong>Attachment</strong></th>
                                             
                                             

                                             


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

   <td data-table="Attachment"  v-if="data.purchase_order.closed !== '1'   " >  
      <input type="file"    v-on:change="onImageChange($event,data.purchase_order)" >
                                                      
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
ref:'',
date:'',
delivery_date:'',
projects:[],
suppliers:[],
supplier_id:'',
users:[],
user_id:'',
project_id:'',
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

   let formData = new FormData();

if(this.images){
	 formData.append('count', this.images.length);
}

this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });

 axios.post('/managers/action_purchase_order_inv/'+data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
Vue.set(data,'closed',1)
     })


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
		axios({
  method: 'post',
  url: '/managers/returnjsonpurchase?page=' + page,
  data:{
  ref:this.ref,
date:this.date,
delivery_date:this.delivery_date, 
project_id:this.project_id,
user_id:this.user_id,
supplier_id:this.supplier_id
}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/managers/returnjsonpurchase' ,
data:{
  ref:this.ref,
date:this.date,
delivery_date:this.delivery_date, 
project_id:this.project_id,
user_id:this.user_id,
supplier_id:this.supplier_id
}
})		.then(response => {
                    
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
     this.supplier()
        },
      
        watch:{
          'ref':function(){
            this.datajson()
          } ,
'date':function(){
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
        }
    }
</script>
