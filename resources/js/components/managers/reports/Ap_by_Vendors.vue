<template>
 <div class="container">
        <section class="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-content">
                </div>

                <div class="inner-block-reports col-sm-12 col-xs-12 col-md-10 col-md-offset-1 clearfix" style="width: 123%; margin-right: -145px;">
                    <div class="reports-header text-center">
                        <h3>ملخص مستحقات الموردين</h3>
                     
                    </div>
                    <div class="table-responsive manage-currency-table reports-table">
                        <table class="table cf">
                            <thead class="cf">
                                <tr>
                                    
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

ledgerurl(){
    this.data = []
    axios({
	method:'post',
	'url':'/managers/ap_by_vendorsjson',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{

	
  this.data = res.data.data




})
},


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
e.purchase_order.forEach(offer=>{

offer.note.forEach(paymentoffer=>{

e.net_inv = (Number(paymentoffer.amount ?? 0) + Number(e.net_inv))

})

})


e.entry_manual_account.forEach(entry=>{

e.net_manule = (Number(entry.value ?? 0) + Number(e.net_manule))

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