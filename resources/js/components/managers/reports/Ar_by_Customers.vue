<template>
 <div class="container">
        <section class="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-content">
                </div>

                <div class="inner-block-reports col-sm-12 col-xs-12 col-md-10 col-md-offset-1 clearfix" style="width: 123%; margin-right: -145px;">
                    <div class="reports-header text-center">
                        <h3>ملخص مستحقات العملاء</h3>
                      
                    </div>
                    <div class="table-responsive manage-currency-table reports-table">
                        <table class="table cf">
                            <thead class="cf">
                                <tr>
                                    <th>الاسم</th>
                                    <th>اسم المنشأة</th>
                                    <th>رقم الاتصال</th>
                                    <th>البريد الإلكتروني</th>

                                    <th>مبالغ فواتير معلقة</th>
                             
                                    <th>صافي حركات القيود اليدوية</th>
                                    <th>صافي المبلغ المستحق</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="dat in customers" :key="dat.id">
                                    <td data-title="Vendor Name">{{ dat.customer_name}}</td>
                                    <td data-title="Organization">{{dat.comp ? dat.comp : dat.customer_name}}</td>
                                    <td data-title="Contact No">{{dat.phone}}</td>
                                    <td data-title="Email">{{dat.email}}</td>
                                 
                                    <td>{{dat.net_inv}} ر.س</td>
                                  
                                    <td>{{dat.net_manule}} ر.س</td>
                                    <td>{{dat.total_net}} ر.س</td>
                                   
                                </tr>
                                <tr class="reports-total">
                                    <td data-title="Total">المبلغ الكلي المستحق</td>
                                    <td></td>
                                    <td></td>
                                      <td></td>
                                    <td>{{inv}} ر.س</td>
                                      
                                  
                                    <td>{{entry}} ر.س</td>
                              
                                    <td>{{net}} ر.س</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="dropdown" style="margin-bottom: -60px;">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">تصدير</button>
                     
                    </div>

                </div>

            </div>

        </section>
    </div>

</template>

<script>
    export default {
  mounted() {
 
this.ledgerurl()

  },
          data() {
    return {
 type:'',
  name:'',
code:'',
group:'',
measuring:'',
data:[],
barcode:'',
to:'',
from:'',
 dis:'',
buy_price:'',
editz:{},
inventories:[],
inventory_id:'',
selectedlevel:'',
searchname:'',
supplier_address:'',
code:'',
section:1,
place:'',
supplier_address:''

,
newdata:[],
selling:'',
inventory:'',
typex:'',
deleter:[],
loaction_inventory:'',
quantity:'',
min_quantity:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
auto_order:'',
            succ:false,
    }

          },

   methods: {
dele(data,index){
  this.deleter = []
      if(confirm("Do you really want to delete?")){
    this.deleter.push(data.id)
axios({
    url:'/deleteacreateccountbank'+data.level+'/'+this.deleter,
    method:'post',
}).then(res=>{
this.newdata.splice(index,1)
    this.deleter = []
})

      }
},


dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/deleteacreateccountbank/'+this.deleter,
    method:'post',
}).then(res=>{
     this.deleter.forEach(z=>{
    this.data.data.find((e,index)=>{
           if(e.id == z.id){
         
this.data.data.splice(index)
           }
       })
    })
    this.deleter = []

})
}


     },




ledgerurl(){
    this.data = []
    axios({
	method:'post',
	'url':'/ar_by_customersjson',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{

	
  this.data = res.data.data.customer




})
},

       


editing(pro){
this.editz = {id:pro.id,code:pro.code,type:pro.type,name:pro.name,initial_balance:pro.initial_balance,number:pro.number}
},

  submit () {
      this.succ = false
    axios({
      method:'post',
      url:'/updateacc/'+this.editz.id,
      data:{
 name:this.editz.name,
 number:this.editz.number,
 type:this.editz.type,
 initial_balance:this.editz.initial_balance,


      }
    }).then(res=>{


this.data.data.find(e=>{
if(e.id == this.editz.id){
     e.name =  this.editz.name,
 e.number = this.editz.number,
 e.type = this.editz.type,
 e.initial_balance = this.editz.initial_balance
}

})

this.editz = {}
    })
  }
},computed: {
    

  

    depetor: function () {
     var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.debtor)    +    Number(sum))


}

    })

return sum

    },

      customers: function () {
     var sum = 0
    this.data.forEach(e=>{ 
e.net_inv = 0
e.net_manule = 0
e.total_net = 0
e.offerpaid.forEach(offer=>{

offer.paymentoffer.forEach(paymentoffer=>{

e.net_inv = (Number(paymentoffer.overall) + Number(e.net_inv))

})

})


e.entry_manual_account.forEach(entry=>{

e.net_manule = (Number(entry.value) + Number(e.net_manule))

})



e.total_net = (Number(e.net_inv) + Number(e.net_manule))




    })

return this.data

    },

entry: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.net_manule)    +    Number(sum))




    })

return sum

    },

inv: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.net_inv)    +    Number(sum))




    })

return sum

    },
    net: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.total_net)    +    Number(sum))




    })

return sum

    },



 
},
watch:{
    
    "inventory_id" :function (id){
this.ledgerurl()

},
"from" :function (id){
this.ledgerurl()

},
"to" :function (id){
this.ledgerurl()

}
}		,   

    }
</script>