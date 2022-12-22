<template>
<div>
      <div class="card mt-3">
           
           <div class="card-body">
             <div class="card-header">

               Suppliers
             </div>
              <div class="row">
                <div class="col-12">
                  <div class="table-wrapper">
                            <div class="col-12 col-md-6">
                                            <div class="button-add-remove ">
                                              <div class="row">
                                                <div class="col-12 col-md-5 mt-2 mt-md-0">
                                                  <a href="/managers/createsupplier" class="btn btn-primary">
                                                    <i class='bx bx-user-plus'></i>
                                                    <span>اضافه حساب جديد</span></a>
                                                </div>
                                         
                                              </div>
                                            </div>
                  
                                          </div>
               
                    <div class="table-responsive">
                      <table class="table datatable-button-print-basic">
                        <thead>
                          <tr>

                            <th scope="col"> Supplier</th>
                          
                            <th scope="col">vat </th>
                            <th scope="col"> phone</th>
                            <th scope="col"> city</th>
                            <th scope="col">country</th>
                            <th scope="col">Action</th>
                            <th style="width: 50px;">
                              <span class="custom-checkbox" style="top: 5px; left: 5px">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                              </span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(data,index) in data.data" :key="data.id">

                            <td>{{data.comp ? data.comp : data.customer_name}}</td>
                            <td>{{data.tax_number}} </td>
                            <td>{{data.email}}</td>
                          <td>
                            {{data.phone}}
                          </td>
                          <td>
                            {{data.city}}
                          </td>

                            <td >السعوديه</td>
                            <td>
                              <a  @click="editing(data)" href="#editEmployeeModal" class="edit" data-toggle="modal">
              
               <i class="fas fa-edit plus-fa"></i>

              </a>
                              <a   @click="dele(data,index)" href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                              
                              </a>
                            </td>
                            <td style="width: 50px;">
                              <span class="custom-checkbox">
                                <input type="checkbox"  v-model="deleter" id="checkbox1" name="options[]" :value="data.id">
                                <label for="checkbox1"></label>
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                        <pagination :data="data" @pagination-change-page="getResults"></pagination>  
                  </div>

                </div>
              </div>
           </div>
            </div>

              <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">تعديل مورد </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="label-req">اسم الشركة</label>
              <input type="text" v-model="editz.comp" class="form-control" placeholder="العودة" required>
            </div>
            <div class="form-group">
              <label class="label-req">اسم المورد </label>
              <input type="text" v-model="editz.customer_name" class="form-control" placeholder="سالم السالم" required>
            </div>
            <div class="form-group">
              <label class="label-req">البريد الالكتروني</label>
              <input type="email" class="form-control" v-model="editz.email" placeholder="example@gmail.com " required>
            </div>
            <div class="form-group">
              <label class="label-req">حالة المورد</label>
          <select class="form-control" v-model="editz.status">
            <option value="1" >نشط </option>
             <option value="2" >خامل</option>
          </select>
            </div>
            <div class="form-group">
              <label class="label-req">البلد</label>
              <input type="text"    v-model="editz.country" class="form-control" placeholder="السعودية" >
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn cansel" data-dismiss="modal" value="الغاء">
            <input type="submit" class="btn btn-info" value="حفظ">
          </div>
        </form>
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
allerros:[],
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
  url: '/managers/supplierjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

 

      submit () {

      this.succ = false
    axios({
      method:'post',
      url:'/managers/updatesupp/'+this.editz.id,
      data:{
 comp:this.editz.comp,
 email:this.editz.email,
 status:this.editz.status,
 country:this.editz.country,
customer_name:this.editz.customer_name,

      }
    }).then(res=>{


this.data.data.find(e=>{
if(e.id == this.editz.id){
     e.comp =  this.editz.comp,
 e.email = this.editz.email,
 e.country = this.editz.country,
 e.status = this.editz.status,
 e.customer_name = this.editz.customer_name
}

})

this.editz = {}
    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 

         window.$("#editEmployeeModal").modal("hide"); 
       
      }
    })
  },

editing(pro){
this.editz = {id:pro.id,comp:pro.comp,email:pro.email,country:pro.country,customer_name:pro.customer_name,status:pro.status,country:pro.county}
},

          product(){
axios({
	method:'get',
	'url':'/managers/supplierjson',
  data:{

  }
}).then(res=>{

	this.data = res.data.data

})
},

dele(data,index){
  this.deleter = []
      if(confirm("Do you really want to delete?")){
    this.deleter.push(data.id)
axios({
    url:'/managers/deletesupp/'+this.deleter,
    method:'post',
}).then(res=>{
this.data.data.splice(index,1)
    this.deleter = []
})

      }
},

dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/managers/deletesupp/'+this.deleter,
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
