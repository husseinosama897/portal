<template>
     <div class="container-lg  border-container">
                            <div class="m-3  row">
                                <div class="text-end ">
                                    <a href="/managers/selecteasyeasy_entries" class="btn btn-dark ">  انشاء قيد سهل <i
                                            class="fas fa-plus"></i></a>
                                   
                                </div>
                                <header class="d-flex mt-3 p-3">
                                    <div class="bg-header-title"></div>
                                    <div class="title-header">
                                        <h6> قيود سهلة </h6>
                                    </div>
                                </header>
                                <br>
                                <div class="card  mt-3">
                                  <div class="card-body">
                                    <form class=" align-items-center">
                                        <div class="row ">
                                          

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">من</label>
                                                <input  v-model="from" type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label>إلي</label>
                                                <input v-model="to" type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                       
                                       
                                            
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12 mt-4">
                                                <div class="col-auto">
                                               
                                                    <button @click="from = '' && to  " class="btn undo-btn "><i class="fas fa-sync-alt"></i>إعادة
                                                        تعيين</button>

                                                </div>
                                            </div>
                                     
                                       </div>
                                    </form>
                                </div>
                                  </div>
                            </div>
                            <div class="card">
                                   <div class="card-body">
                            <div class="table-responsive">
                                  <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead >
                                        <tr>
                                            <th> من <i class="fas fa-sort"></i></th>
                                            <th> الي <i class="fas fa-sort"></i></th>
                                            <th> الوصف </th>
                                            <th> التاريخ <i class="fas fa-sort"></i></th>
                                            <th> مجموع الدائن \المدين <i class="fas fa-sort"></i></th>
                                            <th> الخيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-proudact">
                                        <tr v-for="da in data.data" :key="da.id">
                                            <td  v-if="da.debtor_sub_account3">{{da.debtor_sub_account3.name}}
                  
                                            </td>
                                            <td v-if="da.debtor_sub_account4">

{{da.debtor_sub_account4.name}}
                                            </td>
                                    


                                            <td v-if="da.creditor_sub_account3">
           
  {{da.creditor_sub_account3.name}}

                                            </td>

                                            <td v-if="da.creditor_sub_account4">
  {{da.creditor_sub_account4.name}}

                                            </td>
                                            <td>
                                            {{da.dis}}
                                            </td>
                                            <td>
                                               {{da.date}}
                                            </td>
                                            <td>
                                             {{da.value}}
                                            </td>
                                            <td>
                                                <div>
                                                    <span class="button"> <i class="fas fa-plus  plus-fa"></i></span>
                                                <a :href="'/managers/easy_entryedit/'+da.id">    <span class="button"> <i class="fas fa-edit plus-fa"></i></span></a>
                                                    <span class="button"> <i class="fas fa-print  plus-fa"></i></span>
                                                    <span class="button"> <i class="fas fa-trash-alt plus-fa"></i></span>

                                                </div>
                                            </td>
                                        </tr>
                              

                                    </tbody>
                                </table>

                            </div>
                            </div>
     </div>

                        </div>
</template>

<script>
    export default {
  mounted() {

this.hingez()
  },
          data() {
    return {
 type:'',
  name:'',
   
 ename:'',
  dis:'',
level:'',
   initial_balance:'',
code:'',
group:'',
measuring:'',
value:'',
date:'',
barcode:'',
 dis:'',
buy_price:'',
code_offer:'',
percentage:10,
con:'',
place:'',
supplier_address:''
,
accountt:{name:'الحساب الرئيسي'},
accountt2:{name:'الحساب الرئيسي'},
selling:'',
discount:10,
account_type:'',
  isUpdating: false,
  friends:[],
   autoUpdate: true,
inventory:'',
from:'',
to:'',
loaction_inventory:'',
suppliers:[],
model:{name:'',id:''},
ulz:[],
taxnum:'',
quantity:'',
data:{},
product:[{}],
min_quantity:'',
level:'',
id:'',
searchQuery:'',
searchQuery2:'',
ide:'',
supplier_name:'',
doner:[],
offers:[],
supplier_tax_number:'',
supplier_email:'',
payment:[{}],
auto_order:'',
clients:[],
con:'',
spina:[],
account:[],
            succ:false,
    }

          },

   methods: {
     rowPayment(){
this.payment.push({})
     },
         removepRow(index){
this.payment.splice(index)
     },
     removeRow(index){
this.account.splice(index)
     },
rowProudact(){
this.account.push({code:Math.round(Math.random() * 100)  +'-'+Math.round(Math.random() * 100)})
},
	autocompleteclient(){

this.clients = []
if( this.model.name !== null){
	axios({
		method:'post',
		url:'/getselectcustomer',
data:{
	name:this.model.name,

}
	}).then(res=>{
		this.clients = res.data.data
	})
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


updateaccount4(acc){
this.accountt2 = {}

this.accountt2  = acc


},



submitupdate(){

    if(this.accountt.level == 1){
        this.accountt.subaccount1.forEach(e=>{
            if(e.code == this.account_type){
                this.id = e.id
                this.level = e.level
                
            }
        })
    }

      if(this.accountt.level == 2){
        this.accountt.sub_account3.forEach(e=>{
            if(e.code == this.account_type){
                this.id = e.id

                 this.level = e.level

            }
        })

    }

    if(this.accountt.level == 3){
        this.id = this.accountt.id
         this.level = this.accountt.level
    }
}
,
updatea(data,pro){

pro.code = data.code
pro.group = data.group
pro.selling = data.selling
pro.barcode = data.barcode
pro.name = data.name
pro.id = data.id

this.ulz = []
},
hingez(){
axios({
	method:'post',
	'url':'/managers/homejson',
  data:{
    from:this.from,
    to:this.to,
  }
}).then(res=>{

	this.data = res.data.data
})
},




updateclient(data){

this.model.name = data.customer_name
this.model.id = data.id
this.clients = []
},

update(data){

this.doner = data
this.code_offer = data.code
this.ide = data.id
this.offers = []
},

updateclient(data){

this.model.name = data.customer_name
this.model.id = data.id
this.clients = []
},

	auto(){

this.offers = []
if( this.code_offer !== null){
	axios({
		method:'post',
		url:'/getselectpriceshow',
data:{
	code:this.code_offer,

}
	}).then(res=>{
		this.offers = res.data.data
	})
}

},

	autocompletez(){

	axios({
		method:'get',
		url:'/accountbanksele',

	}).then(res=>{
		this.ulz = res.data.data
	})


},

	autocompleteclient(){

this.clients = []
if( this.model.name !== null){
	axios({
		method:'post',
		url:'/getselectboxsupp',
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

  submit () {
      this.succ = false
this.submitupdate()




axios({
    url:'/managers/easymovementpost',
   method:'post',
   data:{
       creditor_level:this.accountt2.level,

        debtor_level:this.accountt.level,
       value:this.value,
       dis:this.dis,
       date:this.date,
   debtor_id:this.accountt.id,
   creditor_id :this.accountt2.id

  

   }
})
.then(res=>{
   window.$("#editEmployeeModal").modal("show"); 

  
    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
  }
},
  watch: {
    isUpdating (val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000)
      }
    },
  }, 

  computed: {

  totalAmount2: function () {
      if(this.searchQuery2){
           var value = ''





if(value.length == 0){

       if(value.length == 0){
    value = this.ulz.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }

    




}


if(value.length == 0){
   this.ulz.subaccount1.forEach(e=>{
   
    if(value.length == 0){
    value = e.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
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
  },

  watch:{

'from':function ddd() {
  this.hingez()
},

'to':function ddd() {
  this.hingez()
}

  }

 
 
    }
</script>
