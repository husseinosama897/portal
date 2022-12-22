<template>
<div>
   
           
          
             <div class="card-header">

               contractors
             </div>
              <div class="row">
                <div class="col-12">
                  <a class="btn btn-primary" href="/managers/contractorcpage">

                    Create

                  </a>
                  <div class="card mt-6">
                  <div class="card-body">

                  <div class="table-wrapper">
               
                    <div class="table-responsive">
                      <table class="table datatable-button-print-basic">
                        <thead>
                          <tr>

                            <th scope="col">contractor</th>
                            <th scope="col"> E-mail</th>
                            <th scope="col">phone </th>
                            <th scope="col">city</th>
                            <th scope="col">country</th>
                            <th scope="col">options</th>
                      
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(data,index) in data.data" :key="data.id">

                            <td> <a :href="'/managers/contractor/profile/'+data.id">{{data.comp ? data.comp : data.contractor_name }}</a></td>
                          
                            <td>{{data.email}}</td>
                            <td>{{data.phone}}</td>
                         
                            <td >{{data.city}}</td>
                            <td >{{data.country}}</td>
                            <td>
                              <a  :href="'/managers/contractor/update/'+data.id" class="edit" >
                              
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
this.contractor()
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
  url: '/managers/contractorjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

 


          contractor(){
axios({
	method:'get',
	'url':'/managers/contractorjson',
  data:{

  }
}).then(res=>{

	this.data = res.data.data

})
},

dele(data,index){
 
      if(confirm("Do you really want to delete?")){
 
axios({
    url:'/managers/deletecontractor/'+data.id,
    method:'post',
}).then(res=>{
  this.data.data.splice(index,1)
})

      }
},




},







    }
</script>
