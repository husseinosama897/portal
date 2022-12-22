<template>
<div>
       <div class="container-lg">
              <header class="d-flex mt-3 p-3">
                <div class="bg-header-title"></div>
                <div class="title-header">
                  <h6 style="color: #fff;"> Supplier Order</h6>
                </div>
              </header>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"> Supplier order</h5>

                      <a class="btn btn-primary" href="/managers/supplierordercreate" >
                        create
                      </a>

                  <div class="table-wrapper">
              
                    <div class="table-responsive">
                      <table class="table table-bordered ">
                        <thead>
                          <tr>

                            <th scope="col"> code</th>
                         
                            <th scope="col">   date</th>
                            <th scope="col">action</th>
                      
                          </tr>
                        </thead>
                       <tbody v-if="data.data" >
                          <tr v-for="(da,index) in data.data" :key="da.id">

                            <td>{{da.id}}</td>
                                 
                       
                            <td> {{ da.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                        
                            <td>
                              <a >
                                <i style="cursor: pointer;" class='bx bx-printer'></i>
                            </a>
                              <a href="#editEmployeeModal"  @click="editing(da)" class="edit" data-toggle="modal"><i
                                  class='bx bx-edit'></i></a>
                              <a href="#deleteEmployeeModal" @click="dele(da,index)" class="delete" data-toggle="modal">
                                <i class='bx bx-trash'></i></a>
                            </td>
               
                          </tr>
                        </tbody>
                      </table>
                      <pagination :data="data" @pagination-change-page="getResults"></pagination>
                    </div>
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
editz:{id:'',code:'',created_at:'',supplier:{id:'',comp:''}},
 dis:'',
buy_price:'',

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
suppliers:[],
            succ:false,
    }

          },

   methods: {
     	autocompletez(e){
this.suppliers = []
if( this.comp !== null){
	axios({
		method:'post',
		url:'/getselectboxsupp',
data:{
	name:e,

}
	}).then(res=>{
		this.suppliers = res.data.data
	})
}

},
update(p){
this.editz.supplier.id =  p.id
this.editz.supplier.comp = p.comp

this.suppliers = []
},
dele(data,index){
  this.deleter = []
      if(confirm("Do you really want to delete?")){
    this.deleter.push(data.id)
axios({
    url:'/pricing_supplierdelete/'+this.deleter,
    method:'post',
}).then(res=>{
this.data.data.data.splice(index,1)
    this.deleter = []
})

      }
},



dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/supplierorderdelete/'+this.deleter,
    method:'post',
}).then(res=>{
    this.deleter.forEach(z=>{
  this.data.data.forEach((e,index)=>{
   
    
           if(e.id == z){
            
this.data.data.splice(index,1)
           }
       })
    })
    this.deleter = []
})

     }


},
  getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/supplierorderjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

       

       product(){
axios({
	method:'get',
	'url':'/managers/supplierorderjson',
  data:{

  }
}).then(res=>{

	this.data = res.data.data

})
},


editing(pro){
  if(pro.supplier){
    this.editz = {id:pro.id,code:pro.code,created_at:pro.created_at,supplier:pro.supplier}
  }else{
this.editz = {id:pro.id,code:pro.code,created_at:pro.created_at,supplier:{id:'',comp:''}}
  }

},

  submit () {
      this.succ = false
    axios({
      method:'post',
      url:'/managers/updatesupplierorder/'+this.editz.id,
      data:{
supplier_id:this.editz.supplier.id,


      }
    }).then(res=>{


this.editz = {id:'',code:'',created_at:'',supplier:{comp:''}}

})


    
  }
}
    }
</script>
