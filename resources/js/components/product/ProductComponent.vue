<template>


                    <div class="">
                
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

              <div class="card">

<div class="card-body">

  <div class="card-header">

product

  </div>

                <main class="sales section-form-main">
                  <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                   

                  <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th >
                              <a @click="addproduct()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>

                    

                           <th>

                            name

                           </th>

<th>
type

</th>

<th></th>

                           </tr>

                           

                           </thead>

                           <tbody>
<tr v-for="(product,index) in products" :key="index" >

                  

<td></td>
<td><input class="form-control" v-model="product.name"></td>
<td>  <select class="form-select select2" v-model="product.type">
                 <option  value="1">equipment</option>
                 <option  value="2">matrial</option>
                 </select></td>

                 <td>
                              <a class="btn btn-danger" @click="removeproduct(index)" >
                              <strong style="color:white;">  Delete</strong>
                              </a>
                           </td>
</tr>

                           </tbody>
                           </table>
                           </div>


                      <div class="row justify-content-center mt-5 mb-5">
                        <div class="col-12 col-md-3 col-lg-2">
                    
                            <button type="submit" class="btn btn-primary">
                              save
                            </button>
                       
                        </div>
                        
                    </div>
                  </form>


                </main>
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
this.accounting()
this.accounting2()
  },
          data() {
    return {
 type:1,
  name:'',
code:'',
group:'',
products:[],
measuring:{},
barcode:'',
 dis:'',
buy_price:'',
accountt2:{name:'Purchase Account'},
accountt:{name:'حساب البيع'},
supplier_address:'',
code:'',
place:'',
supplier_address:''
,
selling:'',
inventory:'',
loaction_inventory:'',
suppliers:[],
country:'',
comp:'',
units:[],
customer_name:'',
email:'',
status:'',

quantity:'',
allerros:[],
searchQuery2:'',
size:'',
min_quantity:'',
supplier_name:'',
categories:[]
,
category:{},
supplier_tax_number:'',
supplier_email:'',
searchQuery:'',

auto_order:'',
supplier_id:{},
accountingz:[],
accountingz2:[],
spina:[],
            succ:false,
    }

          },

   methods: {
/*
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
/*
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
/*

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
*/
addproduct(){
   this.products.push({})
   },
   removeproduct(index){
   this.products.splice(index,1)
   }
   ,
/*
updateaccount2(acc){
this.accountt = {}

this.accountt  = acc



},

/*
updateaccount4(acc){
this.accountt2 = {}

this.accountt2  = acc


},

/*

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
/*
     accounting(){
axios({
	method:'get',
  
	'url':'/managers/producteleingsaccount'
}).then(res=>{

	this.accountingz = res.data.data
})
},

accounting2(){
axios({
	method:'get',
	'url':'/managers/productfixed0saccount'
}).then(res=>{

	this.accountingz2 = res.data.data
})
},
  
  

*/
  

	autocompletez1(){


  window.$("#scaner").modal("show"); 



},






  submit () {
      this.succ = false
      this.allerros = []
      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.products.length){
	 formData.append('product', JSON.stringify(this.products));
}


     axios.post('/managers/addproduct',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  window.location.href = ('/managers/product_table')
   

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
},

computed: {

  totalAmount2: function () {
      if(this.searchQuery2){
           var value = ''





if(value.length == 0){

       if(value.length == 0){
    value = this.accountingz2.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }

    




}


if(value.length == 0){
   this.accountingz2.subaccount1.forEach(e=>{
   
    if(value.length == 0){
    value = e.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
    
   
    
})




}


if(value.length == 0){
   this.accountingz2.subaccount1.forEach(e=>{
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
        return this.accountingz2;
      }
    
    },
    totalAmount: function () {
       if(this.searchQuery){
           var value = ''





if(value.length == 0){

       if(value.length == 0){
    value = this.accountingz.subaccount1.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }

    




}


if(value.length == 0){
   this.accountingz.subaccount1.forEach(e=>{
   
    if(value.length == 0){
    value = e.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery);
    })
       }
    
   
    
})




}


if(value.length == 0){
   this.accountingz.subaccount1.forEach(e=>{
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
        return this.accountingz;
      }
    
    },
  }

    }
</script>
