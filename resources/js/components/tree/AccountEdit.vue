<template>
     <div class="col p-0">
                       

                        <div class="card mt-3">
                              <div class="card-body">

                            <div class="m-3  row">
                                <div class="text-end ">
                                   
                                </div>
                            </div>

                            <h5 class="card-title"> تعديل حساب</h5>
                            <br>
                            <div class="">
     <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">

                                    <div class="row ">
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">حساب
                                            رئيسي <span class="required-input">*</span></label>

                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">


<span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" >
{{accountt.name}}
  </span>



</span>



                                        </div>
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">نوع
                                            الحساب <span class="required-input">*</span></label>

  
                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">
                                            
                                            <select v-if="accountt.level == 1"  @change="updateacode()" v-model="account_type" class="form-select" aria-label="Default select example" required>
                                                <option v-for="acc in accountt.subaccount1" :value="acc.code" :key="acc.id">{{acc.name}}</option>
                                           
                                            </select>

                                              <select v-if="accountt.level == 2" @change="updateacode()"  v-model="account_type" class="form-select" aria-label="Default select example" required>
                                                <option v-for="acc in accountt.sub_account3" :value="acc.code" :key="acc.id"> {{acc.name}} </option>
                                           
                                            </select>

                                                 <select v-if="accountt.level == 3" disabled  v-model="account_type" class="form-select" aria-label="Default select example" >
                                                <option  :value="accountt.code" :key="accountt.id" selected> {{accountt.name}} </option>
                                
                                            </select>

                                            
                                                 <select v-if="accountt.level == 4" disabled  v-model="account_type" class="form-select" aria-label="Default select example" >
                                                <option  :value="accountt.code" :key="accountt.id" selected> {{accountt.name}} </option>
                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="row  ">
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">الاسم
                                            الانجليزي<span class="required-input">*</span></label>

                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">
                                            <input type="text"    v-model="ename" class="form-control" required aria-label="First name">
                                        </div>
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">الاسم
                                            العربي<span class="required-input">*</span></label>

                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">
                                            <input type="text" class="form-control"   v-model="name" required aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="row  ">
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">
                                            الرمز <span class="required-input">*</span></label>

                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">
                                            <input type="text"  :value="code" class="form-control" required aria-label="First name">
                                        </div>
                                    </div>
                                    <div class="row  ">
                                        <label for="colFormLabelSm"
                                            class="col-xs-3 col-sm-3 col-md-2 pb-2 col-form-label col-form-label-sm text-end">
                                            الوصف</label>

                                        <div class="col-xs-8 col-sm-8 col-md-4 pb-2">
                                            <textarea class="form-control" v-model="dis" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>


                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="col-10 text-end ">
                                            <button type="submit" class="btn btn-primary pl-3 pr-3 m-3 btnsave">حفظ <i
                                                    class="fa fa-save"></i></button>

                                            <button type="button" class="btn btn-primary pl-3 pr-3 btn-cancel">إلغاء
                                                <i class="far fa-window-close"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
       
             </div>
                        </div>

                                                        <div id="editEmployeeModal" class="modal fade bd-example-modal-xl" style="overflow:auto;">
    <div class="modal-dialog modal-xl">
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
 

                             <div id="deathEmployeeModal" class="modal fade bd-example-modal-xl" style="overflow:auto;">
    <div class="modal-dialog modal-xl">
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
        props:['data'],
  mounted() {
 
this.account_type = this.data.code
this.name = this.data.name
this.ename = this.data.ename

this.code = this.data.code
this.dis = this.data.dis

if(this.data.sub_account3){

    this.updateaccount(this.data.sub_account3)
}

if(this.data.subaccount1){
 this.updateaccount(this.data.subaccount1)
}



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
selling:'',
discount:10,
account_type:'',
  isUpdating: false,
  friends:[],
   autoUpdate: true,
inventory:'',
loaction_inventory:'',
suppliers:[],
model:{name:'',id:''},
ulz:[],
taxnum:'',
quantity:'',
product:[{}],
min_quantity:'',
level:'',
id:'',
searchQuery:'',
ide:'',
supplier_name:'',
doner:[],
offers:[],
supplier_tax_number:'',
allerros:[],
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
     goback(){
      window.location.href = ('/managers/accountbanktable')

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


if(acc.level == 3){
    this.account_type  = acc.code

    if(this.accountt.sub_account4 && this.accountt.sub_account4.length > 0){
      var d = this.accountt.sub_account4.length - 1
this.code =   (Number(this.accountt.sub_account4[d].code) +1 )
    }else{
        
this.code =  this.accountt.code +''+ '01'
    }

}
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
	method:'get',
	'url':'/accountbanksele'
}).then(res=>{

			res.data.data.forEach(e => {
		 if(Array.isArray(e)){
     

                    e.forEach(n=>{
this.ulz.push(n)
                    })
                 }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.ulz.push(e[n])
                     })

                 }
	});

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
if(this.data.level == 3){
axios({
    url:'/managers/update3/'+this.data.id,
   method:'post',
   data:{
       name:this.name,
       ename:this.ename,
       code:this.code,
       dis:this.dis,
       level:this.level,
   sub_account1_id:this.id

   }
}).then(res=>{
this.goback()
  
    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
}
if(this.data.level == 4){
axios({
    url:'/managers/update4/'+this.data.id,
   method:'post',
   data:{
       name:this.name,
       ename:this.ename,
       code:this.code,
       dis:this.dis,
       level:this.level,
   sub_account1_id:this.id

   }
}).then(res=>{
this.goback()
  
    }).catch(error=>{
 if (error.response.status == 422){
       this.allerros = error.response.data.errors;
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
}




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


    totalAmount: function () {
       if(this.searchQuery){
           var value = ''



 value =  this.ulz.filter((item)=>{
   return   item.name.startsWith(this.searchQuery);
    
        
       
      })


if(value.length == 0){
   this.ulz.forEach(e=>{
       if(value.length == 0){
    value = e.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }else{
           return value
       }

    
})




}


if(value.length == 0){
   this.ulz.forEach(e=>{
       e.subaccount1.forEach(z=>{
    if(value.length == 0){
    value = z.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }else{
           return value
       }

       })
   
    
})




}





      return value
      
      
    
      }else{
        return this.ulz;
      }
    
    },
  }

 
 
    }
</script>
