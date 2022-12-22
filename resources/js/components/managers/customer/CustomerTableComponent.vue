<template>
<div>
   
           
          
             <div class="card-header">

               العملاء
             </div>
              <div class="row">
                <div class="col-12">
                  <a class="btn btn-primary" href="/managers/addcpage">

                    Create

                  </a>
                  <div class="card mt-6">
                  <div class="card-body">

                  <div class="table-wrapper">
               
                    <div class="table-responsive">
                      <table class="table datatable-button-print-basic">
                        <thead>
                          <tr>

                    
                      
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(data,index) in data.data" :key="data.id">

                            <td>{{data.comp ? data.comp :  data.customer_name }}</td>
                           
                            <td>{{data.email}}</td>
                            <td>{{data.phone}}</td>    
                            <td >{{data.city}}</td>
                            <td >{{data.country}}</td>
                            <td>
                              <a  :href="'/managers/customer/update/'+data.id" class="edit" >
                              
                                <i class="fas fa-edit plus-fa"></i>

                              </a>
                              <a   @click="dele(data,index)" href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                               <i class="fa fa-trash" aria-hidden="true"></i>
</a>
                            </td>
                     
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
    
  </div>
</template>

<script>
    export default {
  mounted() {
this.code = Math.round(Math.random() * 100)  +'-'+Math.round(Math.random() * 100) 
this.product()
  },
          data() {
    return {
 type:'',
  name:'',
code:'',
group:'',
measuring:'',
data:{},
barcode:'',
 dis:'',
buy_price:'',
editz:{},
supplier_address:'',
code:'',
place:'',
supplier_address:''
,
selling:'',
inventory:'',
deleter:[],
loaction_inventory:'',
quantity:'',
min_quantity:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
auto_order:'',
            succ:false,
    }

          },

   methods: {


  getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/customerjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

 

      submit () {

      this.succ = false
    axios({
      method:'post',
      url:'/managers/updatecustomer/'+this.editz.id,
      data:{

 email:this.editz.email,
 status:this.editz.status,
 country:this.editz.country,
customer_name:this.editz.customer_name,
comp:this.editz.comp

      }
    }).then(res=>{


this.data.data.find(e=>{
if(e.id == this.editz.id){
    
 e.email = this.editz.email,
 e.country = this.editz.country,
 e.comp = this.editing.comp
 e.status = this.editz.status,
 e.customer_name = this.editz.customer_name
}

})

this.editz = {}
    })
  },

editing(pro){
this.editz = {id:pro.id,email:pro.email,comp:pro.comp,customer_name:pro.customer_name,status:pro.status,country:pro.county}
},

          product(){
axios({
	method:'get',
	'url':'/managers/customerjson',
  data:{

  }
}).then(res=>{

	this.data = res.data.data

})
},

dele(data,index){
  
      if(confirm("Do you really want to delete?")){
  
axios({
    url:'/managers/deletecustomer/'+data.id,
    method:'post',
}).then(res=>{
this.data.data.splice(index,1)
   
})

      }
},

dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/managers/deletecustomer/'+this.deleter,
    method:'post',
}).then(res=>{
     this.deleter.forEach(z=>{
    this.data.data.find((e,index)=>{
           if(e.id == z){
         
this.data.data.splice(index,1)
           }
       })
    })
    this.deleter = []
})

     }

     }


},







    }
</script>
