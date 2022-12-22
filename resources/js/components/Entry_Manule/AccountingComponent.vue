<template>
                   <div class="container-lg  border-container">
                                              <div class="m-3  row">
                                <div class="col-6">
                                       <a href="/managers/opening_credit" class="btn btn-danger">
                                        <i class="fas fa-greater-than  pt-1 "></i> رجوع
                                    </a>
                                </div>
                                <div class="text-end  col-6">
                                      <a href="/managers/opening_credit_select" class="btn btn-primary "> أرصدة افتتاحية <i
                                            class="fas fa-plus"></i></a>
                                    <button type="button" class="btn btn-primary">انشاء قيد يدوي <i
                                            class="fas fa-plus"></i></button>
                                </div>
<div class="card mt-2">
  <div class="card-body">

    <div class="card-header">الحسابات 

    </div>
                                <form class=" align-items-center" method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">التاريخ:</label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">

                                            <input type="date"   v-model="date" name="birthday" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="discription">الوصف:</label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                            <input type="text" class="form-control"  v-model="dis" placeholder="الوصف"
                                                name="discription">

                                        </div>
                                    </div>


                                    <div class="row mt-5 pt-4">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">حساب الرصيد الافتتاحي </label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 mt-2">
                                  


                                               <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" >
{{accountt.name}}
  </span>



</span>




  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px; width:100%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
  float: right !important;
  left: initial !important;
  right: 0 !important;
  
  " aria-labelledby="dropdownMenuButton1">
  <li    >  <input type="text" class="form-control" v-model="searchQuery" > </li>

 
    <ul  dir="rtl" >
       <ul v-if="totalAmount.length > 0">
        <li   v-for=" t in totalAmount"  :key="t.id">
<a @click="updateaccount2(t)"  class="dropdown-item" href="#">{{t.name}} - {{t.code}}</a>


        </li>
       </ul>
       

<li   v-for="u in totalAmount.subaccount1" :key="u.id"  >
<a @click="updateaccount2(z)" v-if="u.sub_account3.length <= 0" class="dropdown-item" href="#">{{u.name}} - {{u.code}}</a>

<ul dir="rtl"
>
<li   v-for="z in u.sub_account3" :key="z.id"   ><a @click="updateaccount2(z)" v-if="z.sub_account4.length <= 0" class="dropdown-item" href="#">{{z.name}} - {{z.code}}</a>
<ul dir="rtl"
>
<li   v-for="f in z.sub_account4" :key="f.id"   >
<a @click="updateaccount2(f)"  class="dropdown-item" href="#">{{f.name}} - {{f.code}}</a>
</li>
</ul>


</li>
</ul>

</li>
    </ul>


  </ul>

                                            <p class="lightblue">هذا الحساب موقت ويستخدم في قيود الارصدة الافتتاحية
                                                لموازيها في جانب حقوق الملاك من المركز المالي . ان لم يكن لديك حساب مخصص
                                                يمكنك انشاء حساب نوعه حقوق ملاك</p>
                                        </div>


                                    </div>
                                    <div class="row lightorange p-2 ">
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">  الموقع </label>
                                        </div>
                                                <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">  المنتج </label>
                                        </div>

                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">الرصيد الافتتاحي </label>
                                        </div>


                                    </div>
                                    <div class="row p-2"  v-for="(dep,index) in debtors" :key="index">
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                          
                                               <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" v-if="dep.account.name" >
{{dep.account.name}}
  </span>
    <span class=" col-form-label col-form-label-sm text-end" v-else >
الحساب الرئيسي
  </span>



</span>




  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px; width:100%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
  float: right !important;
  left: initial !important;
  right: 0 !important;
  
  " aria-labelledby="dropdownMenuButton1">
  <li    >  <input type="text" class="form-control" v-model="searchQuery2" > </li>

 
    <ul  dir="rtl" >
       <ul v-for=" t in totalAmount2"  :key="t.id">
 
       
       <li v-if="!t.subaccount1">
<a @click="updateaccount4(dep,t)"  class="dropdown-item" href="#">{{t.name}}</a>
         </li>

<li   v-for="u in t.subaccount1" :key="u.id"  >
<a @click="updateaccount4(dep,u)" v-if="u.sub_account3.length <= 0" class="dropdown-item" href="#">{{u.name}} - {{u.code}}</a>

<ul dir="rtl"
>
<li   v-for="z in u.sub_account3" :key="z.id"   ><a @click="updateaccount2(dep,z)" v-if="z.sub_account4.length <= 0" class="dropdown-item" href="#">{{z.name}} - {{z.code}}</a>
<ul dir="rtl"
>
<li   v-for="f in z.sub_account4" :key="f.id"   >
<a @click="updateaccount4(dep,f)"  class="dropdown-item" href="#">{{f.name}} - {{f.code}}</a>
</li>
</ul>


</li>
</ul>

</li>

    </ul>
    </ul>


  </ul>
                                        </div>
                                    

                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                            <input type="text" class="form-control"  v-model="dep.value" name="discription">
                                        </div>
                                             <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                           <button type="button" @click="deletedep(index)" class="btn  btn-danger ">حذف <i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="row pt-4 text-end">
                                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 ">
                                          <button  class="btn  btn-primary">متابعة

                                          </button>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 ">
                                            <button type="button" @click="adddebtor()" class="btn  btn-primary ">المزيد <i class="fas fa-plus"></i></button>
                                            </div>
                                    </div>
    </form>

                            </div>

                        

                        </div>
                        
                            </div>

                        

                        </div>
</template>

<script>
var converter = require('number-to-words');
    export default {
      
  mounted() {
this.code = Math.round(Math.random() * 100)  + '' +Math.round(Math.random() * 100) 
this.hingez()
this.hingez2()
  },
          data() {
    return {
 type:'',
 comp:'',
  name:'',
code:'',
group:'',
measuring:'',
barcode:'',
 dis:'',
 date:'',
buy_price:'',
accountt:{name:'الحساب الرئيسي'},
supplier_address:'',
code:'',
searchQuery2:'',
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
product:[],
min_quantity:'',
debtors:[  { value:'',account:{}}],
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

     hingez(){
axios({
	method:'get',
	'url':'/managers/moneycapitalsaccount'
}).then(res=>{

	this.ulz = res.data.data
})
},
     hingez2(){
axios({
	method:'get',
	'url':'/managers/allaccount'
}).then(res=>{

	this.ulz2 = res.data.data
})
},

     cust(){
axios({
	method:'get',
	'url':'/managers/productselect'
}).then(res=>{
			res.data.data.forEach(e => {
		 if(Array.isArray(e)){
     

                    e.forEach(n=>{
this.product.push(n)
                    })
                 }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.product.push(e[n])
                     })

                 }
	});

})
},



     deletedep(index){

        this.debtors.splice(index, 1);
        

     }, 

     adddebtor(){

    
if(this.debtors.length <= 10){
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
      window.location.href = ('/opening_credit')
                    },

  submit () {
      this.succ = false
      this.allerros = []
 

axios({
  url:'/managers/createopening_credit_insarting',
  method:'post',
  data:{
    date:this.date,
    dis:this.dis,
    creditor_id:this.accountt.id,
    value:this.overall,
      line:this.debtors.length,
    account:JSON.stringify(this.debtors),
    level:this.accountt.level,
    type:3,
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

updateaccount4(dep,acc){


Vue.set(dep,'account',acc)

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


  totalAmount2: function () {
       if(this.searchQuery2){
           var value = ''





     

    







if(value.length == 0){
   this.ulz2.forEach(e=>{
   e.subaccount1.forEach(z=>{
  if(value.length == 0){
    value = z.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
   })
  
    
   
    
})




}


if(value.length == 0){

   this.ulz2.forEach(e=>{
   e.subaccount1.forEach(z=>{

       z.sub_account3.forEach(a=>{
if(value.length == 0){
    value = a.sub_account4.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
       })
  
   })
  
    
   
    
})



}



      return value
      
      
    
      }else{
        return this.ulz2;
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
