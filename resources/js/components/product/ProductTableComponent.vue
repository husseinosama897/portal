<template>
<div>
       <div class="card mt-4">
     
             
               
                       <div class="card-body">
             

<div class="card-header">
products
</div>

<a href="/managers/product"  class="btn btn-primary mt-3">  
Add product
</a>
                    <div class="table-responsive">

                      <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                          <tr>

                            <th scope="col">product</th>     
                            <th scope="col">type</th>
              
                            <th scope="col">Action</th>
                     
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(pro,index) in data.data" :key="pro.id">
                           
                            <td>{{pro.name}}</td>
                            <td v-if="pro.type == 1" >equipment </td>
                            <td v-if="pro.type == 2" >matrial </td>
                            <td v-else >unknown </td>
                            <td>
                              <a  @click="editing(pro)" class="edit" :href="'/managers/productedit/'+pro.id">
                              
                                  

                              </a>
                              <a href="#deleteEmployeeModal" @click="dele(pro,index)"  data-toggle="modal">
<i class="fa fa-trash" aria-hidden="true"></i>

                    </a>
                            </td>
                    
                          </tr>

                         
                        </tbody>
                      </table>
                      <pagination :data="data" @pagination-change-page="getResults"></pagination>
                    </div>
                    </div>
                

               
                
            </div>


  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">  تعديل المنتج </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="label-req"> اسم الصنف </label>
                <input type="text" class="form-control" v-model="editz.name" placeholder="علبة بيبسي" required>
              </div>
            <div class="form-group">
              <label class="label-req"> نوع الصنف </label>
              <select class="form-control" v-model="editz.type">
                  <option value="2">خدمه</option>
                     <option value="1">سلعه</option>
              </select>
            </div>
            <div class="form-group">
              <label class="label-req"> مجموعة الصنف </label>
              <input type="text" class="form-control" v-model="editz.group"  placeholder=" مشروب غازي	 " required>
            </div>
               <div class="form-group" v-if="editz.type == 1">
              <label class="label-req"> سعر الشراء  </label>
              <input type="text" class="form-control" v-model="editz.buy_price"   required>
            </div>
                  <div class="form-group" >
              <label class="label-req">  سعر البيع </label>
              <input type="text" class="form-control" v-model="editz.selling"   required>
            </div>
            <div class="form-group">
              <label class="label-req"> الباركود</label>
              <input type="text" class="form-control" v-model="editz.barcode" placeholder="12" required>
            </div>
          <div class="modal-footer">
            <input type="button" class="btn cansel" data-dismiss="modal" value="الغاء">
            <input type="submit" class="btn btn-info" value="حفظ">
          </div>
            </div>
        </form>
      </div>
    </div>
     
  </div>



                                                  <div id="adz" class="modal fade " style="overflow:auto;">
    <div class="modal-dialog ">
      <div class="modal-content" style="overflow:auto;">
                <button style="color:black" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:black" aria-hidden="true">&times;</span>
        </button>
       <img src="/uploads/10820.jpg">
      <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">تم العمليه بنجاح !</h4>
  <p> لقد نجحت في بمكانك اللقاء نظره</p>
  <hr>
<input type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
</div>
      </div>
    </div>
  </div>
 

            <div id="deathEmployeeModal" class="modal fade" >
    <div class="modal-dialog ">
      <div class="modal-content" style="overflow:auto;">
     
       <img src="/uploads/3999809.jpg">
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
  mounted() {

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
  url: '/managers/productjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

       

       product(){
axios({
	method:'get',
	'url':'/managers/productjson',
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
    url:'/managers/deleteproduct/'+this.deleter,
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
    url:'/managers/deleteproduct/'+this.deleter,
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
