<template>
<div class="container">
  	<div class="card">
		<div v-if="succ" class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message.</p>
  <hr>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
  
                          <div class="container-lg">
                <header class="d-flex mt-3 p-3">
                  <div class="bg-header-title"></div>
                  <div class="title-header">
                    <h6>ادخال طلب مورد</h6>
                  </div>
                </header>
      
                <main class="sales section-form-main">
                  <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                    <div class="card">
                  <div class="card-body">
                    <section class="header-section mt-3">
                      <div class="row ">
                        <div class="col-12   d-flex float-left">
                          <div class="parent-label-header mt-1">
                            <label class="form-label">
                               code
                            </label>
                          </div>
                          <div class="parent-input-system">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="1212"
                              required
                              v-model="code"
                            />
                          </div>
                        </div>
                        
                      </div>
                    </section>
                    </div>
                    </div>

                    <div class="card">
<div class="card-body ">

                    <div class="table-responsive">
                    <table class="table table-bordered  mt-5">
                        <thead>
                          <tr>
                            <th width="50px" style="background-color: #fff">
                           
                            </th>
                        
                            <th scope="col"> material </th>
                          
                            <th scope="col">quantity</th>
             
                          </tr>
                        </thead>
                        <tbody id="table-body-proudact">
                          <tr v-for="(pro,index) in product" :key="index">
                            <td style="background-color: #fff">
                              <div class="action-container">
                                <button
                                  class="btn btn-danger"
                                  @click="removeRow(index)"
                                  type="button"
                                >
                            <span style="color:black;">X</span>
                                </button>
                              </div>
                            </td>
            

                            <td>
                              <input
                                class="form-control"
                                type="text"
                                placeholder="خشب"
                                v-model.lazy="pro.name"
                                 
                            @input="autocompletez2(pro,index)"

                              />
                           

       	<ul class="list-group"         v-if="ulz2.length > 0      && pro.name  !== ''     && index == id">
  <li v-for="data in ulz2" @click="update2(data,pro)" :key="data.id" class="list-group-item">{{data.name}}</li>

</ul>

                            </td>
                            <td>
                              <input
                                class="form-control"
                                   
                                type="text"
                                placeholder="0.00"
                                required
                                v-model="pro.quantity"

                               :id="'quantity'+index"
                              />
                            </td>
                        
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th width="50px" style="background-color: #fff">
                              <div class="action-container">
                                <button  type="button" class="btn btn-light" @click="addrowProudact()">
                               +
                                </button>
                              </div>
                            </th>
                        
                            <th scope="col"> </th>
                          
                            <th scope="col"></th>
             
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    </div>
                  </div>
        
            
                      <div class="row justify-content-center mt-5 mb-4">
                        <div class="col-12 col-md-3 col-lg-2">
                          <div class="save">
                            <button type="submit" class="btn btn-primary"> 
                              حفظ
                            </button>
                          </div>
                        </div>
                      
                    </div>
                  </form>
                
                
                </main>
          
                </div>
           






                          </div>
            
</template>


<script>
    export default {
  mounted() {
this.code = Math.round(Math.random() * 100)  +''+Math.round(Math.random() * 100) 
  },
          data() {
    return {
 type:'',
  name:'',
code:'',
group:'',
measuring:'',
barcode:'',
 dis:'',
buy_price:'',
supplier_address:'',
code:'',
place:'',
fq:'',
email :'',
status  : '',
country : '',
customer_name : '',
comp :'',

selling:'',
inventory:'',
loaction_inventory:'',
suppliers:[],
quantity:'',
min_quantity:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
auto_order:'',
product:[],
supplier_id:{},
id:'',
allerros:[],
ulz:[],
ulz2:[],
ulz1:[],
spina:[],
            succ:false,
    }

          },

   methods: {
   goback(){
      window.location.href = ('/supplierorderindex')

     },

updatez(data,pro){
Vue.set(pro,'code',data.id)
Vue.set(pro,'barcode',data.barcode)
Vue.set(pro,'price',data.selling)
Vue.set(pro,'group',data.group)
Vue.set(pro,'name',data.name)
Vue.set(pro,'id',data.id)

var u = this.product.indexOf(pro)
      document.getElementById('quantity'+this.product.indexOf(pro)).focus();
},
update1(data,pro){
    

Vue.set(pro,'code',data.id)
Vue.set(pro,'barcode',data.barcode)
Vue.set(pro,'price',data.selling)
Vue.set(pro,'group',data.group)
Vue.set(pro,'name',data.name)
Vue.set(pro,'id',data.id)

const e = this.product.indexOf(pro)


      document.getElementById('quantity'+this.product.indexOf(pro)).focus();
},

update2(data,pro){

Vue.set(pro,'code',data.id)
Vue.set(pro,'barcode',data.barcode)
Vue.set(pro,'price',data.selling)
Vue.set(pro,'group',data.group)
Vue.set(pro,'name',data.name)
Vue.set(pro,'id',data.id)
var u = this.product.indexOf(pro)

       document.getElementById('quantity'+this.product.indexOf(pro)).focus();

       this.ulz2 = []
},




	autocompletez2(pro,index){
this.id = index
	this.ulz2 = []
  	this.ulz1 = []
    	this.ulz = []
if( pro.name !== null){
	axios({
		method:'post',
		url:'/autoCompleteProduct',
data:{
	name:name,

}
	}).then(res=>{
		this.ulz2 = res.data.data
	})
}

},

  onDecode (result) {
   
	axios({
		method:'post',
		url:'/managers/getselectproductbarcode',
data:{
	barcode:result,

}
	}).then(res=>{
    this.product.find((e,index)=>{
if(this.id == index){
e = res.data.data
}
    })
	
	})

  },

  submit2 () {
       this.succ = false
    axios({
      method:'post',
      url:'/managers/createsupp',
      data:{
 comp:this.comp,
 email:this.email,
 status:this.status,
 country:this.country,
customer_name:this.customer_name,

      }
    }).then(res=>{

   
  window.$("#editEmployeeModal2").modal("hide"); 

  
      this.comp = '',
          this.personal = '',
      this.type_customer = '',
         this.customer_name= '',
        this.stype = '',
this.tax_number= '',
this.representative= '',
this.phone= '',
this.location= '',
this.country = '',
  this.succ = true,
                    this.postal_code = '',
 this.status= '',
this.building_num = '',
this.street_name= '',
   this.city= '',
this.email= ''
    })
  },


     removeRow(index){
this.product.splice(index)
     },
addrowProudact(){
this.product.push({})
},
update(p){
this.supplier_id.id =  p.id
this.supplier_name = p.customer_name
this.suppliers = []
},


	autocompletez(){
this.suppliers = []
if( this.comp !== null){
	axios({
		method:'post',
		url:'/managers/getselectboxsupp',
data:{
	name:this.comp,

}
	}).then(res=>{
		this.suppliers = res.data.data
	})
}

},
		  onImageChange(e) {
       
        this.img = e.target.files[0]; 

             
            },
            
      submit2 () {

      this.succ = false
    axios({
      method:'post',
           url:'/customer',
      data:{

 email:this.email,
 status:this.status,
 country:this.country,
customer_name:this.customer_name,
comp:this.comp

      }
    }).then(res=>{


  window.$("#editEmployeeModal2").modal("hide"); 

this.email = '',
this.status  = '',
this.country = '',
this.customer_name = '',
this.comp = ''

    })
  },

  submit () {
      this.succ = false
      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

      formData.append('code', this.code);
       formData.append('product', JSON.stringify(this.product));
        formData.append('supplier_id', this.supplier_id.id);
            formData.append('fq', this.fq);

     axios.post('/managers/supplierorderinsert',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  this.goback()
this.code = Math.round(Math.random() * 100)  +''+Math.round(Math.random() * 100) ,
this.product = [{}],
this.fq = '',
this.supplier_id.id = '',
this.supplier_name = ''
  window.$("#editEmployeeModal").modal("show"); 

    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
  }
},
watch:{
"supplier_name" :function (id){
this.autocompletez
}
}
    }
</script>
