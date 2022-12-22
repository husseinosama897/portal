<template>
            <div class="container-lg  border-container">
                            <div class="m-3  row">
                                <div class="text-end ">
                                    <button  @click="print()" type="button" class="btn btn-lightorange "> تحميل pdf <i
                                            class="fas fa-file-pdf"></i></button>
                                    <a   :href="'/easy_entryedit/'+easy_entry.id" type="button" class="btn btn-lightorange">تعديل <i
                                            class="fas fa-edit"></i></a>
                                    <a    href="/home_entries" class="btn btn-lightorange">رجوع <i
                                            class="fas fa-arrow-left"></i></a>
                                </div>
                                <header class="d-flex mt-3 p-3">
                                    <div class="bg-header-title"></div>
                                    <div class="title-header">
                                        <h6> تفاصيل قيد سهل
                                        </h6>
                                    </div>
                                </header>
                                <br>

                            </div  >
                            <!--*******************************-->
                            <div id="printMe">
                            <div class="row text-blue  ">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center ">
                                    <p>رقم القيد</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p>{{easy_entry.code}} </p>
                                </div>
                            </div>
                            <div class="row text-blue">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center">
                                    <p>الوصف </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            
                                </div>
                            </div>
                            <div class="row text-blue">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center">
                                    <p>التاريخ</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p>{{easy_entry.date}}
                                    </p>
                                </div>
                            </div>
                            <!--*******************************-->

                            <div class="table-responsive">
                                <table class="table  mt-5">
                                    <thead class="thead-TB">
                                        <tr>

                                            <th> الحساب </th>
                                            <th> مدين </th>
                                            <th> دائن </th>
                                            <th>التعليقات </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-proudact">
                                        <tr class="tr-css">
                        
                                            <td v-if="easy_entry.creditor_sub_account3" >
                                        {{easy_entry.creditor_sub_account3.name}}
                                            </td>
                                                <td v-if="easy_entry.creditor_sub_account4" >
                                        {{easy_entry.creditor_sub_account4.name}}
                                            </td>
                                            <td>
                                             
                                            </td>
                                            <td>
                                                {{easy_entry.value}}
                                             
                                            </td>
                                     

                                        </tr >
                                        <!--item 2-->
                                        <tr class="tr-css"  >
                                            <td v-if="easy_entry.debtor_sub_account3">
                                              {{easy_entry.debtor_sub_account3.name}}
                                            </td>
                                                   <td v-if="easy_entry.debtor_sub_account4">
                                              {{easy_entry.debtor_sub_account4.name}}
                                            </td>
                                            <td>
                                                {{easy_entry.value}} ر.س 
                                            </td>
                                            <td>
                                             </td>
                                      
                                            
                                            
                            

                                        </tr>
                                  

                                 
                                        <tr>
                                            <td>
                                                المجموع
                                            </td>
                                            <td>
                                              {{easy_entry.value}} ر.س
                                            </td>
                                            <td>
                                               {{easy_entry.value}} ر.س </td>
                                            <td>

                                            </td>

                                        </tr>


                                    </tbody>
                                </table>

                            </div>

                            </div>
                     
                            <!--****************-->
                            <!--النشاطات-->
                            <!--****************-->
                            <div class="border bg-light mb-5">
                                <h4 class="text-blue p-3">النشاطات</h4>
                                <div class="scroll">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-4 ">
                                         
                                        
                                        </div>
                                        <div class="col-xs-6 col-md-6 border bg-white">
                                            <div class="row">
                                                <div class="col-xs-2 col-lg-2  p-3 ">
                                                    <button data-bs-toggle="modal" data-bs-target="#showModal"
                                                        class="btn  m-lg-auto btn-border btn-block h-100 btn-blue w-100">
                                                        <i class="fas fa-eye  m-lg-auto bigfont"></i>
                                                    </button>
                                                </div>
                                                <div class="text-blue txt-right col-5" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample2" aria-expanded="false"
                                                    aria-controls="collapseExample2">
                                                    <p style="margin: unset;">


                                                      {{ easy_entry.created_at | moment("dddd, MMMM Do YYYY") }}
                                                    </p>
                                                    <p>



                                                       {{ easy_entry.updated_at | moment("dddd, MMMM Do YYYY") }}


                                                    </p>
                                                </div>
                                                <div class="collapse text-blue" id="collapseExample2">
                                                    <div class="card card-body">
                                                        <hr>

                                                       

                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <!--2222222222222222222222222222222-->
                               
                                 
                                    <!--%%%%%%%%%%%%-->

                                </div>
                            </div>
                        </div>
</template>

<script>
var converter = require('number-to-words');
    export default {
      props:['easy_entry'],
  mounted() {

this.date = this.easy_entry.date
this.dis = this.easy_entry.dis
this.accountt = this.easy_entry.sub_account3
this.hingez()
this.cust()
  },
          data() {
    return {
 type:'',
 comp:'',
 date:'',
  name:'',
code:'',
group:'',
measuring:'',


barcode:'',
 dis:'',
buy_price:'',
accountt:{name:'الحساب الرئيسي'},
supplier_address:'',
code:'',

email :'',
status  : '',
country : '',
customer_name : '',
comp :'',

branch_id:{tax:15,id:58},

percentage:10,
con:'',
searchQuery:'',
place:'',
supplier_address:''
,
selling:'',
discount:0,
inventory:'',
loaction_inventory:'',
suppliers:[],
model:{name:'',id:''},
ulz:[],
quantity:'',
product:[{}],
min_quantity:'',
debtors:[{value:'', account:{}}],
customers:[],
id:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
wordtotalAmount:'',
wordoverall:'',
dof3at_seen: false,
payment:[{}],
auto_order:'',
clients:[],
ulz1:[],

branches:[],
allerros : [],
ulz2:[],
dof3at : ['الاولى','الثانيه','الثالثه','الرابعه','الخامسه','السادسه','السابعه'],
dof3at_index:0,
con:'',
terms:[
  
  
  'يجب الشروط والاحكام ما بين المؤسسه والعميل'


],
terms_s : [],



oneterm:'',
spina:[],
            succ:false,
    }

          },

   methods: {

      print () {
     
      this.$htmlToPaper('printMe');
	  
    },
    

     hingez(){
axios({
	method:'get',
	'url':'/managers/moneycapitalsaccount'
}).then(res=>{

	this.ulz = res.data.data
})
},

     cust(){
axios({
	method:'get',
	'url':'/managers/customerdebetor'
}).then(res=>{
			res.data.data.forEach(e => {
		 if(Array.isArray(e)){
     

                    e.forEach(n=>{
this.customers.push(n)
                    })
                 }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.customers.push(e[n])
                     })

                 }
	});

})
},



     deletedep(index){

        this.debtors.splice(index, 1);
        

     }, 

     adddebtor(){

    
if(this.debtors.length < 10){
       this.debtors.push({ value:'', account:{}});

}






     },

     show_dof3at(){

       this.dof3at_seen = true;



     }, hide_dof3at(){

       this.dof3at_seen = false;



     },



     theAction(){

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


     rowPayment(){

  var test = converter.toWords(this.payment.length + 1);
         this.payment.push({name:test})
      

     },
         removepRow(index){
this.payment.splice(index)
     },
     removeRow(index){
this.product.splice(index)
     },
addrowProudact(){
this.product.unshift({})
console.log(this.product);

},
update(data,pro){
  	this.ulz2 = []
  	this.ulz1 = []
    this.ulz = []

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
    
	this.ulz2 = []
  	this.ulz1 = []
    	this.ulz = []
Vue.set(pro,'code',data.id)
Vue.set(pro,'barcode',data.barcode)
Vue.set(pro,'price',data.selling)
Vue.set(pro,'group',data.group)
Vue.set(pro,'name',data.name)
Vue.set(pro,'id',data.id)

const e = this.product.indexOf(pro)


      document.getElementById('quantity'+this.product.indexOf(pro)).focus();
},

aw(){
  this.branches.find(e=>{
if(e.id == this.branch_id.id){
  this.branch_id = e
}
  })
},



update2(data,pro){
	this.ulz2 = []
  	this.ulz1 = []
    	this.ulz = []
Vue.set(pro,'code',data.id)
Vue.set(pro,'barcode',data.barcode)
Vue.set(pro,'price',data.selling)
Vue.set(pro,'group',data.group)
Vue.set(pro,'name',data.name)
Vue.set(pro,'id',data.id)
var u = this.product.indexOf(pro)

       document.getElementById('quantity'+this.product.indexOf(pro)).focus();
},

updateclient(data){

this.model.name = data.customer_name
this.model.id = data.id
this.clients = []
},
updateterm(term){

 this.oneterm = term
 this.terms_s = []
 this.addterm(term)


},

	autocompletez(pro,index){
this.id = index
	this.ulz2 = []
  	this.ulz1 = []
    	this.ulz = []
if( pro.code !== null){
	axios({
		method:'post',
		url:'/getselectproduct',
data:{
	code:pro.code,

}
	}).then(res=>{
		this.ulz = res.data.data
	})
}

},


  onDecode (result) {
   
	axios({
		method:'post',
		url:'/getselectproductbarcode',
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

	autocompletez1(pro,index){
this.id = index

  window.$("#scaner").modal("show"); 



},

	autocompletez2(pro,index){
this.id = index
	this.ulz2 = []
  	this.ulz1 = []
    	this.ulz = []
if( pro.name !== null){
	axios({
		method:'post',
		url:'/getselectproductname',
data:{
	name:name,

}
	}).then(res=>{
		this.ulz2 = res.data.data
	})
}

},



		  onImageChange(e) {
       
        this.img = e.target.files[0]; 

             
            },

                    goback(){
      window.location.href = ('/opening_credit')
                    },





},
   
 
 
    }
</script>
