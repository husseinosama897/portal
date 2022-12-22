<template>
      <div class="container-lg  border-container">
                            <div class="m-3  row">
                           
                              <div class="text-end ">
                                    <a   href="/managers/opening_credit_select" class="btn btn-primary "> opening balances <i class="fa fa-plus" aria-hidden="true"></i></a>
                                            
                                                 <a   href="/managers/createmanule" class="btn btn-primary ">create accounting restrictions <i class="fa fa-plus" aria-hidden="true"></i></a>
                                </div>

<div class="card mt-2">
  <div class="card-body">

    <div class="card-header"> customers

    </div>                          
                                <form class=" align-items-center" method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">date:</label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">

                                            <input type="date" id="birthday"  v-model="date" name="birthday" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="discription">description:</label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                            <input type="text" class="form-control"  v-model="dis" placeholder="description"
                                                name="discription">

                                        </div>
                                    </div>


                                    <div class="row mt-5 pt-4">
                                        <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">account the opening balance</label>
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
       <ul v-if="scaling_account.length > 0">
        <li   v-for=" t in scaling_account"  :key="t.id">
<a @click="updateaccount2(t)"  class="dropdown-item" href="#">{{t.name}} - {{t.code}}</a>


        </li>
       </ul>
       

<li   v-for="u in scaling_account.subaccount1" :key="u.id"  >
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
                                    <div class="row lightorange p-2 ">
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday"> customer </label>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <label for="birthday">opening balance</label>
                                        </div>


                                    </div>
                                    <div class="row p-2"  v-for="(dep,index) in debtors" :key="index">
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                            <select class="form-select" v-model="dep.customer_id" aria-label="Default select example">
                                                <option  v-for="cus in customers" :key="cus.id" :value="cus.id"> {{cus.customer_name ? cus.customer_name : cus.comp}} </option>
                                             
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                            <input type="text" class="form-control"  v-model="dep.value" name="discription">
                                        </div>
                                             <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 ">
                                           <a href="#" @click="deletedep(index)" > <i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="row pt-4 text-end">
                                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 ">
                                          <button  class="btn  btn-primary">submit

                                          </button>
                                        </div>
                                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 ">
                                            <button type="button" @click="adddebtor()" class="btn  btn-primary ">add <i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
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

this.moneycapitalsaccount()
this.customer()
  },
          data() {
    return {

 date:'',
dis:'',
accountt:{name:'account the opening balance'},

searchQuery:'',


suppliers:[],
model:{name:'',id:''},
ulz:[],

debtors:[{value:'', account:{}}],
customers:[],
id:'',

ulz1:[],

ulz2:[],


            succ:false,
    }

          },

   methods: {

     moneycapitalsaccount(){
axios({
	method:'get',
	'url':'/managers/moneycapitalsaccount'
}).then(res=>{

	this.ulz = res.data.data
})
},

     customer(){
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
  url:'/managers/createopening_credit_insarting',
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


updateaccount2(acc){
this.accountt = {}

this.accountt  = acc



},


},
 
 
   computed: {

    scaling_account: function () {
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
