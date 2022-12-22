<template>

    <div class="container">
        <section class="content">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">
                    <div class="form-content">
                        <form class="form" action="#" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                            <div class="form_row">
                                <label for="">من</label>
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <input type="date" v-model="from" value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                  
                                    </div>


                                </div>
                            </div>
                            <div class="form_row">
                                <label for="">إلى</label>
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <input type="date" v-model="to" value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                    
                                    </div>


                                </div>
                            </div>

                         
                           
                        </form>
                        <br>
                    </div>

                    <div class="inner-block-reports col-md-12  col-sm-12 col-xs-12 clearfix">
                        <div id="inventory_table_data">
                            <div class="reports-header text-center">
                                <h3>تقرير فواتير المبيعات الضريبية</h3>
                        
                                <h5>
                                    من
                                    <span> {{from}}</span> إلى
                                    <span> {{to}}</span>
                                </h5>
                            </div>
                            <div class="table-responsive manage-currency-table reports-table">
                                <table class="table cf table-bordered inventary-table">
                                    <thead class="cf">
                                        <tr>
                                            <th class="text-center">مرجع الفاتورة</th>
                                           
                                            <th class="text-center">اسم العميل</th>
                                            <th class="text-center">الرقم الضريبي للعميل</th>
                                            <th class="text-center">تاريخ الإصدار</th>
                                            <th class="text-center">تاريخ الاستحقاق</th>
                                            <th class="text-center">مجموع الفاتورة</th>
                                            <th class="text-center">مجموع الضريبة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="dat in data" :key="dat.id">
                                            <td data-title="مرجع الفاتورة"> {{dat.code}}</td>
                                        
                                            <td data-title="اسم العميل"  v-if="dat.customer" >
                                                 {{dat.customer.customer_name ? dat.customer.customer_name : dat.comp  }}</td>
                                                 <td v-else></td>
                                            <td data-title="الرقم الضريبي للعميل" v-if="dat.customer">{{dat.customer.tax_number}} </td>
                                             <td v-else></td>
                                            <td data-title="تاريخ الإصدار">{{ dat.created_at | moment("dddd, MMMM Do YYYY") }} </td>
                                            <td data-title="تاريخ الاستحقاق"> {{dat.date_of_supply}}</td>
                                            <td data-title="مجموع الفاتورة"> {{dat.overall}}ر.س</td>
                                            <td data-title="مجموع الضريبة"> {{dat.tax}} ر.س</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><b>إجمالي الفواتير</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                    
                                            <td></td>
                                            <td data-title="إجمالي الفواتير"><b>{{overall}} ر.س</b></td>
                                            <td data-title="إجمالي الضريبة"><b>{{tax}} ر.س</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">تصدير</button>
                          
                            </div>
                        </div>
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
	'url':'/sales_invoicesjson',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{

	
     
	res.data.data.forEach(e => {
	 if(Array.isArray(e)){
                 
                    e.forEach(n=>{
this.data.push(n)
                    
                    })



     }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.data
.push(e[n])
                     })

                 }
     })





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

      tax: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.tax)    +    Number(sum))




    })

return sum

    },

overall: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.overall)    +    Number(sum))




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