<template>
   <div class="container-lg  border-container">
                            <div class="m-3  row">
                                <div class="col-6">
                                     <a href="/managers/selecteasyeasy_entries" class="btn btn-lightblue">
                                        <i class="fas fa-greater-than  pt-1 "></i> رجوع
                                    </a>
                                </div>

                          <div class="card">
                            <div class="card-body">
                              <div class="card-header"> محاسبة الرواتب 
                              </div>

                                    <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                                    <div class="row pt-4">
                                        <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">حساب رأس مال المالك  </label>
                                            <p class="lightblue">حساب رأس المال الذي ارتفع </p>

                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 mt-2">
                                  

                                               <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" >
{{accountt.name}}
  </span>



</span>




  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px;   width:25%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
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


                                        </div>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">الهيئة  </label>
                                                <p class="lightblue">هيئة راس المال المضاف</p>

                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 mt-2">
                                               

                                               <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" >
{{accountt2.name}}
  </span>



</span>



  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px; width:25%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
  float: right !important;
  left: initial !important;
  right: 0 !important;
  
  " aria-labelledby="dropdownMenuButton1">
  <li    >  <input type="text" class="form-control" v-model="searchQuery2" > </li>

 
    <ul  dir="rtl" >
       <ul v-if="totalAmount2.length > 0">
        <li   v-for=" t in totalAmount2"  :key="t.id">
<a @click="updateaccount4(t)"  class="dropdown-item" href="#">{{t.name}} - {{t.code}}</a>


        </li>
       </ul>
       

<li   v-for="u in totalAmount2.subaccount1" :key="u.id"  >
<a @click="updateaccount4(z)" v-if="u.sub_account3.length <= 0" class="dropdown-item" href="#">{{u.name}} - {{u.code}}</a>

<ul dir="rtl"
>
<li   v-for="z in u.sub_account3" :key="z.id"   ><a @click="updateaccount4(z)" v-if="z.sub_account4.length <= 0" class="dropdown-item" href="#">{{z.name}} - {{z.code}}</a>
<ul dir="rtl"
>
<li   v-for="f in z.sub_account4" :key="f.id"   >
<a @click="updateaccount4(f)"  class="dropdown-item" href="#">{{f.name}} - {{f.code}}</a>
</li>
</ul>


</li>
</ul>

</li>
    </ul>


  </ul>
                                            </div>
                                        </div>

                                        <div class="row pt-4">
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">القيمة </label>
                                                <p class="lightblue">ما هي قيمة العملية؟  </p>
    
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 mt-2">
                                                <input type="text" class="form-control"  v-model="value" placeholder="الوصف"
                                                name="discription">
    
                                            </div>
                                            </div>
                                        <div class="row pt-1">
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">التاريخ:</label>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">

                                                <input type="date" id="birthday" v-model="date" name="birthday" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row pt-4">
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">الوصف</label>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                                <textarea class="form-control" v-model="dis" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="row pt-4">
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">المرفقات</label>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                                <input class="form-control" type="file" id="formFile">

                                            </div>
                                        </div>


                                        <div class="row pt-4 text-center">
                                            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-12 ">
                                                <button type="submit" class="btn  btn-primary">متابعة

                                                </button>
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
  mounted() {

this.hingez()
this.hingez2()
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
searchQuery2:'',
ide:'',
supplier_name:'',
doner:[],
offers:[],
ulz2:[],
supplier_tax_number:'',
supplier_email:'',
payment:[{}],
auto_order:'',
clients:[],
con:'',
allerros:[],
spina:[],
account:[],
            succ:false,
    }

          },

   methods: {
              goback(){
      window.location.href = ('/managers/home_entries')

     },

     removeRow(index){
this.account.splice(index)
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
	'url':'/managers/moneycapital2saccount'
}).then(res=>{

	this.ulz2 = res.data.data
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



	autocompletez(){

	axios({
		method:'get',
		url:'/managers/accountbanksele',

	}).then(res=>{
		this.ulz = res.data.data
	})


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
this.goback()

  
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
    value = this.ulz2.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }

    




}


if(value.length == 0){
   this.ulz2.subaccount1.forEach(e=>{
   
    if(value.length == 0){
    value = e.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
    
   
    
})




}


if(value.length == 0){
   this.ulz2.subaccount1.forEach(e=>{
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
        return this.ulz2;
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
  }

 
 
    }
</script>
