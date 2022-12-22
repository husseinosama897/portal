<template>
            <div class="card  border-container">
                            <div class="  row">
                                <div class="text-end ">
                                    <button type="button"   @click="print()"  class="btn btn-lightorange "> تحميل pdf <i
                                            class="fas fa-file-pdf"></i></button>
                                    <a   :href="'/managers/opening_credit_edit/'+entry_manual.id" type="button" class="btn btn-lightorange">تعديل <i
                                            class="fas fa-edit"></i></a>
                                    <a href="/managers/opening_credit" class="btn btn-lightorange">رجوع <i
                                            class="fas fa-arrow-left"></i></a>
                                </div>
                                <header class="d-flex mt-3 p-3">
                                    <div class="bg-header-title"></div>
                                    <div class="title-header">
                                        <h6> تفاصيل القيد اليدوي
                                        </h6>
                                    </div>
                                </header>
                                <br>

                            </div>
                            <!--*******************************-->
                                <div id="printMe">
                            <div class="row text-blue  ">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center ">
                                    <p>رقم القيد</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p>{{entry_manual.code}} </p>
                                </div>
                            </div>
                            <div class="row text-blue">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center">
                                    <p>الوصف </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="m-0">أرصدة إفتتاحية : أرصدة إفتتاحية </p>
                                    <p>أرصدة إفتتاحية : افلات</p>
                                </div>
                            </div>
                            <div class="row text-blue">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center">
                                    <p>التاريخ</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p>{{entry_manual.date}}
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
                                    <tbody id="table-body-proudact"  >
                                        <tr class="tr-css">
                                            <td v-if="entry_manual.sub_account3">
                                        {{entry_manual.sub_account3.name}}
                                            </td>

                                            <td v-else>

                                            </td>
                                        
                                            <td>
                                             
                                            </td>
                                            <td v-if="entry_manual.type !== 5 ">
                                                {{entry_manual.value}}
                                             
                                            </td>
                                            <td v-if="entry_manual.type == 1 || entry_manual.type == 2 || 
                                            
                                            entry_manual.type == 3


                                            || entry_manual.type == 4
                                            
                                            ">
                                                Opening Balance - رصيد افتتاحي | Cash on hand

                                            </td>

                                        </tr >
                                        <!--item 2-->
                                        <tr class="tr-css"  v-for="de in debtors" :key="de.id">

                                          
                                                <td v-if="de.creditor_sub_account3">
                                              {{de.creditor_sub_account3.name}}
                                            </td>
                                               
                                                <td v-if="de.creditor_sub_account4">
                                              {{de.creditor_sub_account4.name}}
                                            </td>

                                            <td v-if="de.sub_account3">
                                              {{de.sub_account3.name}}
                                            </td>
                                                   <td v-if="de.sub_account4">
                                              {{de.sub_account4.name}}
                                            </td>
                                            <td v-if="de.value">
                                                {{de.value }} ر.س 
                                            </td>
                                               <td v-else>
                                             0 ر.س 
                                            </td>


                                            <td v-if="de.value1">
                                              {{de.value1}}
                                             </td>
                                             
                                            <td v-else>
                                     
                                             </td>
                                            <td
                                            
                                            
                                            v-if="entry_manual.type == 1 || entry_manual.type == 2 || 
                                            
                                            entry_manual.type == 3


                                            || entry_manual.type == 4
                                            
                                            "

                                            >
                                                Opening Balance - رصيد افتتاحي | Cash on hand

                                            </td>

                                            <td v-else>
قيد يدوي

                                            </td>

                                        </tr>
                                  

                                 
                                        <tr>
                                            <td>
                                                المجموع
                                            </td>
                                            <td>
                                              {{entry_manual.value}} ر.س
                                            </td>
                                            <td>
                                               {{entry_manual.value}} ر.س </td>
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


                                                      {{ entry_manual.created_at | moment("dddd, MMMM Do YYYY") }}
                                                    </p>
                                                    <p>



                                                       {{ entry_manual.updated_at | moment("dddd, MMMM Do YYYY") }}


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
      props:['entry_manual'],
  mounted() {
  this.debtors = this.entry_manual.entry_manual_account
this.date = this.entry_manual.date
this.dis = this.entry_manual.dis
this.accountt = this.entry_manual.sub_account3
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
           url:'/managers/customer',
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
		url:'/managers/getselectproduct',
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
		url:'/managers/getselectproductname',
data:{
	name:name,

}
	}).then(res=>{
		this.ulz2 = res.data.data
	})
}

},
  autocompleteterm(){


    this.terms_s = ['شرط اولى ' ]

      
  if( this.oneterm !== null){
    axios({
      method:'post',
      url:'/managers/getselectterm',            
  data:{
    oneterm:this.oneterm,

  }
    }).then(res=>{
      this.terms_s = res.data.terms
    })
  }



    


 


  },

	autocompleteclient(){

this.clients = []
if( this.model.name !== null){
	axios({
		method:'post',
		url:'/managers/getselectcustomer',
data:{
	name:this.model.name,

}
	}).then(res=>{
		this.clients = res.data.data
	})
}

},
		  onImageChange(e) {
       
        this.img = e.target.files[0]; 

             
            },

                    goback(){
      window.location.href = ('/managers/opening_credit')
                    },

  submit () {
      this.succ = false
      this.allerros = []
 

axios({
  url:'/managers/opening_credit_update/'+this.entry_manual.id,
  method:'post',
  data:{
    date:this.date,
    dis:this.dis,
    line:this.debtors.length,
    creditor_id:this.accountt.id,
    value:this.overall,
    account:JSON.stringify(this.debtors),
    level:this.accountt.level,
    type:1,
  }
})
.then(res=>{
this.goback()

    window.$("#editEmployeeModal").modal("show"); 


    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
  },



  checkerpayment(e){
  
  if(e.percentage >= 0 && e.percentage <= 100){

Vue.set(e,'percentage',e.percentage)
  }
if(e.percentage  < 0 ){
    

    Vue.set(e,'percentage',0)
}

if(e.percentage > 100){
Vue.set(e,'percentage',100)
}




},


updateaccount(acc){
this.accountt = {}

this.accountt  = acc


if(acc.level == 3){
    this.account_type  = acc.code
        if(this.accountt.sub_account4){
      var d = this.accountt.sub_account4.length - 1
this.code =   (Number(this.accountt.sub_account4[d].code) +1 )
    }else{
           var d = this.accountt.sub_account3.length - 1
this.code =  this.accountt.sub_account3[d].code +''+ '01'
    }
}
},

updateaccount1(acc){
this.accountt = {}

this.accountt  = acc




if(acc.level == 3){
    this.account_type  = acc.code
       if(acc.subaccount4){
      var d = acc.subaccount4.length - 1
this.code =   (Number(acc.subaccount4[d].code) +1 )
    }else{
      var d = acc.subaccount3.length - 1
this.code =  acc.subaccount3[d].code +''+ '01'
    }
}
},

updateacode(){




    if(this.accountt.level == 3){

    
    if(this.accountt.sub_account4){
      var d = this.accountt.sub_account4.length - 1
this.code =   (Number(this.accountt.sub_account4[d].code) +1 )
    }else{
           var d = this.accountt.sub_account3.length - 1
this.code =  this.accountt.sub_account3[d].code +''+ '01'
    }
    }
if(this.accountt.level == 2){
        if(this.accountt.sub_account3){
            this.accountt.sub_account3.forEach(e=>{
                if(e.code == this.account_type){
   
this.code = e.code + '' +'01'
                }
            })

    }

}

if(this.accountt.level == 1){
      this.accountt.subaccount1.forEach(e=>{
          if(this.account_type == e.code){

  var d = e.sub_account3.length - 1
this.code = (Number( e.sub_account3[d].code )   +  Number(1))
    
          }
    
      })
     

}





},

updateaccount2(acc){
this.accountt = {}

this.accountt  = acc



},

  checker(){
  if(this.discount >= 0 && this.discount <= 100){
this.discount = this.discount
  }
if(this.discount  < 0 ){
    
    this.discount = 0
}

if(this.discount > 100){
  this.discount = 100
}

  if(this.branch_id.tax  >= 0 && this.branch_id.tax  <= 100){
this.branch_id.tax  = this.branch_id.tax 
  }
if(this.branch_id.tax   < 0 ){
    
    this.branch_id.tax  = 0
}

if(this.perbranch_id.tax  > 100){
  this.branch_id.tax  = 100
}


},
},
watch:{


"supplier_name" :function (id){
this.autocompletez
},
"discount" :function (id){
this.checker()
},

"percentage" :function (id){
this.checker()
},
  
    
      deep: true,

   
}		,   
 
   computed: {

    totalAmount: function () {
       if(this.searchQuery){
           var value = ''





if(value.length == 0){

       if(value.length == 0){
    value = this.ulz.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }

    




}


if(value.length == 0){
   this.ulz.subaccount1.forEach(e=>{
   
    if(value.length == 0){
    value = e.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }
    
   
    
})




}


if(value.length == 0){
   this.ulz.subaccount1.forEach(e=>{
   e.sub_account3.forEach(z=>{
    if(value.length == 0){
    value = e.sub_account4.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
   })

    
   
    
})




}



      return value
      
      
    
      }else{
        return this.ulz;
      }
    
    },

    overall:function(){
    var sum = 0

    this.debtors.forEach(e=>{
      sum = (Number(e.value) + Number(sum))
    })

    return sum
    }
   }
    }
</script>
