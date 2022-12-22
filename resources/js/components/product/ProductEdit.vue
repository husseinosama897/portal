<template>

  <div class="card">

<div class="card-body">

  <div class="card-header">

المنتجات

  </div>

                <main class="sales section-form-main">
               
    <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                       
                    <div class="row mt-3">
                 
                              <div class="col-sm-3">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="product name"

                                v-model="name"

                              />
                              </div>
                        
                               <div class="col-sm-3">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="unit"
                                v-model="measuring.name"
                                required

                     @input="unitz()"

                              />

                                                   	<ul class="list-group"
                                                         
                                 

                                                         
                                                          v-if="units.length > 0 ">
  <li v-for="uni in units" @click="updateunit(uni)" :key="uni.id" class="list-group-item">{{uni.name}}</li>

</ul>
                     

                            </div>

                              <div class="col-sm-3">
                                <input
                                  class="form-control"
                                  type="text"
                                  placeholder="barCode"
                                  v-model="barcode"
                            

                                />
                              </div>
               
                     
                    </div>
                               
                        <div class="row mt-3"        >
                 
                
                       
                            
                          
        

                         
                   

                        <div class="col-sm-3" v-if="type == 1">
   
               
                                                         
                                               <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <span class=" col-form-label col-form-label-sm text-end" >
{{accountt2.name}}
  </span>



</span>



  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px; width:100%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
  float: right !important;
  left: initial !important;
  right: 0 !important;
  
  " aria-labelledby="dropdownMenuButton1">
  <li    >  <input type="text" class="form-control" v-model="searchQuery2" > </li>

 
    <ul  dir="rtl" >
       <ul v-for="t in totalAmount2" :key="t.id">
<li   v-for="u in t.subaccount1" :key="u.id"  >
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


  </ul>

                             
                      

                        </div>
                      
      
                        
                    
                    </div>

                    <div class="row mt-5">
                        <div class="col-12 col-lg-6">      
                        
                                
                                <label >Image</label>
                                <input 
                                
                                class="form-control"
                                 v-on:change="onImageChange" type="file" >
                 
                           
                          </div>
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

          
                  
</template>

<script>
    export default {
      props:['data','inventoryz'],
  mounted() {
this.accounting()
this.accounting2()


 this.name = this.data.name

   this.type = this.data.type

this.place = this.data.place

 if(this.data.category && this.data.category.name){
this.category.name  = this.data.category.name
  this.group = this.data.category.id
 }
 
  this.measuring.id =   this.data.unit_id

if(this.data.unit && this.data.unit.name){
this.measuring.name = this.data.unit.name
this.measuring.id = this.data.unit.id

}

this.barcode = this.data.barcode

    
     this.buy_price = this.data.buy_price
       
     
 
          
this.selling = this.data.selling
         
               this.accountt2 = this.data.p_account4 ?? this.data.p_account3
this.accountt = this.data.selling_account3 ?? this.data.selling_account4
                   
              this.inventory = this.data.inventory
                         
            
           
  this.loaction_inventory.id = this.inventoryz.id 
this.loaction_inventory.name = this.inventoryz.name

 this.supplier_id.id = this.data.supplier_id
if(this.data.supplier){
 this.supplier_id.name = this.data.supplier.name ?? null
    
}

this.quantity = this.data.quantity
       this.min_quantity  = this.data.min_quantity

 this.auto_order  = this.data.auto_order
  


  },
          data() {
    return {
 type:1,
  name:'',
code:'',
group:'',
measuring:{},
barcode:'',
 dis:'',
buy_price:'',

supplier_address:'',
code:'',
place:'',
accountt2:{name:'حساب الشراء'},
accountt:{name:'حساب البيع'},
supplier_address:''
,
selling:'',
loaction_inventories:[],
inventory:'',

loaction_inventory:{},
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

update_inventories(p){
this.loaction_inventory.id =  p.id
this.loaction_inventory.name= p.name

this.loaction_inventories = []
},


inventoriesget(){
this.loaction_inventories = []
console.log(this.loaction_inventory)
if( this.loaction_inventory.name !== null){
	axios({
		method:'post',
		url:'/getselectinventory',
data:{
	name:this.loaction_inventory.name,

}
	}).then(res=>{
		this.loaction_inventories = res.data.data
	})
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

     accounting(){
axios({
	method:'get',
  
	'url':'/producteleingsaccount'
}).then(res=>{

	this.accountingz = res.data.data
})
},

accounting2(){
axios({
	method:'get',
	'url':'/productfixed0saccount'
}).then(res=>{

	this.accountingz2 = res.data.data
})
},
  
  
           goback(){
      window.location.href = ('/producttable')

     },

  onDecode (result) {
   
	this.barcode = result

  },
   submit2 () {
       this.succ = false
    axios({
      method:'post',
      url:'/createsupp',
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

	autocompletez1(){


  window.$("#scaner").modal("show"); 



},




	categoriesz(){
this.categories = []
if( this.category.name !== null){
	axios({
		method:'post',
		url:'/getselectcategory',
data:{
	name:this.category.name,

}
	}).then(res=>{
		this.categories = res.data.data
	})
}

},


	unitz(){
this.units = []
if( this.measuring.name !== null){
	axios({
		method:'post',
		url:'/getselectunit',
data:{
	name:this.measuring.name,

}
	}).then(res=>{
		this.units = res.data.data
	})
}

},


update(p){
this.supplier_id.id =  p.id
this.supplier_name = p.comp

this.suppliers = []
},

	autocompletez(){
this.suppliers = []
if( this.supplier_name !== null){
	axios({
		method:'post',
		url:'/getselectboxsupp',
data:{
	name:this.supplier_name,

}
	}).then(res=>{
		this.suppliers = res.data.data
	})
}

},

updatecategeory(category){
this.categories = []

this.category = category
},

updateunit(category){
this.categories = []

this.measuring = category
this.units = []
},
		  onImageChange(e) {
       
        this.img = e.target.files[0]; 

             
            },

  submit () {
      this.succ = false
      this.allerros = []
      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.name){
	 formData.append('name', this.name);
}

  if(this.type){
    formData.append('type', this.type);

  }
  

       if(this.accountt){
  formData.append('selling_account'+''+this.accountt.level+'_id', this.accountt.id);

    } 
    
     

           if(this.accountt2){
  formData.append('p_account'+''+this.accountt2.level+'_id', this.accountt2.id);

    } 
    
     
  
if(this.group){
formData.append('group', this.group);

}
    if(this.measuring){
  formData.append('measuring', this.measuring.id);

    }
     if(this.barcode){
  formData.append('barcode', this.barcode);

     }
       if(this.buy_price){
       formData.append('buy_price', this.buy_price);
       }
     
    if(this.place){
       formData.append('place', this.place);
    }
            
            if(this.selling){
 formData.append('selling', this.selling);
            }
               
                   
                 if(this.inventory)  {
                          formData.append('inventory', this.inventory);
                 }
            
            if(this.loaction_inventory){
  formData.append('loaction_inventory', this.loaction_inventory.id);

            }

            if(this.code){
 formData.append('code', this.code);
            }
                            
     if(this.supplier_id.id){
 formData.append('supplier_id',this.supplier_id.id);
    
     }
     
if(this.quantity){
 formData.append('quantity', this.quantity);
}
         if(this.min_quantity){
     formData.append('min_quantity', this.min_quantity);
         }
          if(this.supplier_name){
   formData.append('supplier_name', this.supplier_name);
          }
               
                 if(this.supplier_tax_number){
        formData.append('supplier_tax_number', this.supplier_tax_number);
          }

                       if(this.supplier_email){
     formData.append('supplier_email', this.supplier_email);
          }
               
                               if(this.auto_order){
     formData.append('auto_order', this.auto_order);
          }
                 
                                if(this.img){
     formData.append('img', this.img);
          }
              

     axios.post('/updateproduct/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  this.goback()
 this.type = '',
   this.name = '',
this.code = Math.round(Math.random() * 100)  +'-'+Math.round(Math.random() * 100),
 this.group = '',
 this.measuring = '',
 this.barcode = '',
  this.dis = '',
  this.supplier_address = '',
 this.buy_price = '',
 this.selling = '',
 this.inventory = '',
 this.loaction_inventory = '',
 this.quantity = '',
 this.min_quantity = '',
 this.supplier_name = '',
 this.place = '',
 this.supplier_tax_number = '',
 this.supplier_email = '',
   this.succ = true,
 this.auto_order = ''
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
