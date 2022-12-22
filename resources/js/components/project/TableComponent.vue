<template>
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <button type="button" @click="create()" class="btn btn-primary">
                  create
                  </button>
                  <table class="table datatable-button-print-basic">
                     <thead>
                        <tr>
                           <th><strong>CODE</strong></th>
                           <th><strong>name</strong></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(data,index) in datas.data "  :key="data.id">
                           <td data-table="CODE">{{data.id}}</td>
                           <td data-table="name">{{data.name}}</td>
                           <td  data-table="ACTION">
                              <div class="dropdown">
                                 <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 ACTION
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" @click="open(data)" >update</a>
                                    <a class="dropdown-item" @click="dele(data,index)"  href="#">delete</a>

                         <a class="dropdown-item"  :href="'/admin/projectPage/'+data.id">report</a>

                                    
                                 </div>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <pagination :data="datas" @pagination-change-page="getResults"></pagination>
               </div>
            </div>
         </div>
      </div>
      <div id="adz" class="modal fade " style="overflow:auto;">
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
              <div class="modal-header justify-content-center">
                <button class="btn-close m-0" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
              </div>
                <div class="modal-body">
                    <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">name</label>
                     <input type="text" v-model="name" class="form-control" id="exampleInputPassword1">
                  </div>
                           <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">lat</label>
                     <input type="text" v-model="lat" class="form-control" id="exampleInputPassword1">
                  </div>

                   <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">log</label>
                     <input type="text" v-model="log" class="form-control" id="exampleInputPassword1">
                  </div>

             
                  
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">bid_value</label>
                     <input type="text" v-model="bid_value" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">duration</label>
                     <input type="text" v-model="duration" class="form-control" id="exampleInputPassword1">
                  </div>


                  
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">receive_date</label>
                     <input type="date" v-model="receive_date" class="form-control" id="exampleInputPassword1">
                  </div>


                    
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">initial_delivery_date</label>
                     <input type="text" v-model="initial_delivery_date" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">final_delivery_date</label>
                     <input type="text" v-model="final_delivery_date" class="form-control" id="exampleInputPassword1">
                  </div>


     
       <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">po_budget</label>
                     <input type="text"  v-model="po_budget" class="form-control" id="exampleInputPassword1">
                  </div>


                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">subcontractor_budget</label>
                     <input type="text"  v-model="subcontractor_budget" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">petty_cash_budget</label>
                     <input type="text"  v-model="petty_cash_budget" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">staff  budget</label>
                     <input type="text"  v-model="employee_budget" class="form-control" id="exampleInputPassword1">
                  </div>


                  

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">budget</label>
                     <input type="text " readonly :value="budget" class="form-control" id="exampleInputPassword1">
                  </div>


                  <div class="form-group row mb-2">
                        <label for="password-confirm" class="col-md-2 col-form-label text-md-right">project manager  </label>
                        <div class="col-md-8">
                           <select  class="form-control select2" v-model="projectmanager_id">
                              <option    v-for="user in users"   :key="user.id" :value="user.id">{{user.name}}</option>
                           </select>
                        </div>
                      

                     </div>


                  <div class="form-group row mb-2">
                        <label for="password-confirm" class="col-md-2 col-form-label text-md-right">customer name </label>
                        <div class="col-md-8">
                           <select  class="form-control select2" v-model="customer_id">
                              <option    v-for="cus in customer"   :key="cus.id" :value="cus.id">{{cus.customer_name ? cus.customer_name : cus.comp}}</option>
                           </select>
                        </div>
                      

                     </div>


                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
              </div>
            </div>
         </div>
      </div>
      <div id="deathEmployeeModal" class="modal fade" >
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
                <div class="modal-body">
               <form method="POST"  v-on:submit.prevent="submit1()" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">name</label>
                     <input type="text" v-model="updating.name" class="form-control" id="exampleInputPassword1">
                  </div>
                           <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">lat</label>
                     <input type="text" v-model="updating.lat" class="form-control" id="exampleInputPassword1">
                  </div>

                   <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">log</label>
                     <input type="text" v-model="updating.log" class="form-control" id="exampleInputPassword1">
                  </div>



       <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">po_budget</label>
                     <input type="text"  v-model="updating.po_budget" class="form-control" id="exampleInputPassword1">
                  </div>


                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">subcontractor_budget</label>
                     <input type="text"  v-model="updating.subcontractor_budget" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">petty_cash_budget</label>
                     <input type="text"  v-model="updating.petty_cash_budget" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">staff budget</label>
                     <input type="text"  v-model="updating.employee_budget" class="form-control" id="exampleInputPassword1">
                  </div>

                     <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">budget</label>
                     <input type="text" readonly :value=" ubudget " class="form-control" id="exampleInputPassword1">
                  </div>



                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">bid_value</label>
                     <input type="text" v-model="updating.bid_value" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">duration</label>
                     <input type="text" v-model="updating.duration" class="form-control" id="exampleInputPassword1">
                  </div>


                  
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">receive_date</label>
                     <input type="date" v-model="updating.receive_date" class="form-control" id="exampleInputPassword1">
                  </div>


                    
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">initial_delivery_date</label>
                     <input type="text" v-model="updating.initial_delivery_date" class="form-control" id="exampleInputPassword1">
                  </div>

                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">final_delivery_date</label>
                     <input type="text" v-model="updating.final_delivery_date" class="form-control" id="exampleInputPassword1">
                  </div>


                  <div class="form-group row mb-2">
                        <label for="password-confirm" class="col-md-2 col-form-label text-md-right">project manager  </label>
                        <div class="col-md-8">
                           <select  class="form-control select2" v-model="updating.projectmanager_id">
                              <option    v-for="user in users"   :key="user.id" :value="user.id">{{user.name}}</option>
                           </select>
                        </div>
                      

                     </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
                </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
    export default {
        props:['subcontractor'],
        data(){
return{

datas:{},
allerros:[],
name:'',
lat:'',
bid_value:'',
  duration:'',
  projectmanager_id:'',
receive_date:'',
initial_delivery_date:'',
final_delivery_date:'',
customer_id:'',
customer:[],
users:[],
log:'',
updating:{},
po_budget:'',
       subcontractor_budget:'',
       petty_cash_budget:'',
       employee_budget:''
}

        },

        methods:{

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


 

         CHunking_customer_data(){
axios({
	method:'get',
	'url':'/managers/CHunking_customer_data'
}).then(res=>{

			res.data.data.forEach(e => {
		 if(Array.isArray(e)){
     

                    e.forEach(n=>{
this.customer.push(n)
                    })
                 }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.customer.push(e[n])
                     })

                 }
	});

})
},

create(){
  window.$("#adz").modal("show"); 
},

open(data){
this.updating = data

      window.$("#deathEmployeeModal").modal("show"); 

},
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/admin/delete_project/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/admin/project_json?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'get',
  url: '/admin/project_json/' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


submit(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.name){
	 formData.append('name', this.name);
}

if(this.lat){
	 formData.append('lat', this.lat);
}

if(this.log){
	 formData.append('log', this.log);
}

if(this.po_budget){
	 formData.append('po_budget', this.po_budget);
}

if(this.subcontractor_budget){
	 formData.append('subcontractor_budget', this.subcontractor_budget);
}
if(this.petty_cash_budget){
	 formData.append('petty_cash_budget', this.petty_cash_budget);
}
if(this.employee_budget){
	 formData.append('employee_budget', this.employee_budget);
}



var budget = (Number(this.petty_cash_budget) + Number(this.employee_budget)

+ Number(this.subcontractor_budget)  + Number(this.po_budget))

budget = Math.round(budget)


if(budget){
	 formData.append('budget', budget);
}

if(this.duration){
	 formData.append('duration', this.duration);
}

if(this.bid_value){
	 formData.append('bid_value', this.bid_value);
}


if(this.receive_date){
	 formData.append('receive_date', this.receive_date);
}

if(this.projectmanager_id){
	 formData.append('projectmanager_id', this.projectmanager_id);
}


if(this.initial_delivery_date){
	 formData.append('initial_delivery_date', this.initial_delivery_date);
}

if(this.final_delivery_date){
	 formData.append('final_delivery_date', this.final_delivery_date);
}

if(this.customer_id){
	 formData.append('customer_id', this.customer_id);
}

    axios.post('/admin/post_project',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
      
       this.datas.data.push(res.data.data)
     
 window.$("#adz").modal("hide"); 
    })
},
submit1(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.updating.name){
	 formData.append('name', this.updating.name);
}

if(this.updating.lat){
	 formData.append('lat', this.updating.lat);
}



if(this.updating.log){
	 formData.append('log', this.updating.log);
}

if(this.updating.duration){
	 formData.append('duration', this.updating.duration);
}

if(this.updating.bid_value){
	 formData.append('bid_value', this.updating.bid_value);
}


if(this.updating.receive_date){
	 formData.append('receive_date', this.updating.receive_date);
}


if(this.updating.po_budget){
	 formData.append('po_budget', this.updating.po_budget);
}

if(this.updating.subcontractor_budget){
	 formData.append('subcontractor_budget', this.updating.subcontractor_budget);
}


if(this.updating.employee_budget){
	 formData.append('employee_budget', this.updating.employee_budget);
}

if(this.updating.petty_cash_budget){
	 formData.append('petty_cash_budget', this.updating.petty_cash_budget);
}


if(this.ubudget){
	 formData.append('budget', this.ubudget);
}
if(this.updating.projectmanager_id){
	 formData.append('projectmanager_id', this.updating.projectmanager_id);
}

if(this.updating.initial_delivery_date){
	 formData.append('initial_delivery_date', this.updating.initial_delivery_date);
}

if(this.updating.final_delivery_date){
	 formData.append('final_delivery_date', this.updating.final_delivery_date);
}

if(this.updating.customer_id){
	 formData.append('customer_id', this.updating.customer_id);
}


axios.post('/admin/update_project/'+this.updating.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
       this.name = ''
             window.$("#deathEmployeeModal").modal("hide"); 

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
     this.datajson()
     this.CHunking_customer_data()
 this.user()

   },
      

   computed:{
      budget:function(){
         var budget =(Number( this.po_budget) +  Number(this.subcontractor_budget) + Number(this.petty_cash_budget) + Number(this.employee_budget))

         return budget

      },
      ubudget:function(){
         var budget =  (Number( this.updating.po_budget) +  Number(this.updating.subcontractor_budget) + Number(this.updating.petty_cash_budget) + Number(this.updating.employee_budget))

         
         
         return budget

      }

   }
    }
</script>
