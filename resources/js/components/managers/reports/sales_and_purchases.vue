<template>
<div class="container">
        <section class="content">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">
                    <form class="form-wraper report_filter_validation_aged_invoice" action="https://www.qoyod.com/tenant/reports/inventory_report/filter_report" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="Yih8O2RYk4Y9mbqfMjOAw0R03rDZdsULKzRO5AjtdlclIBcdYPrMK6jym1FibDDrGjBG4s+5nckz7QW02jSDrg==" />
                        <div class="form-content">
                            <div class="form_row">
                                <label for="">من</label>
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <input type="date" value="30-11-2021"
                                        v-model="from"
                                         class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                        <div class="input-group-prepend">
                                            <span class="datepicker-toggle">
                                                <span class="datepicker-toggle-button"></span>
                                            <input type="date" class="datepicker-input">
                                            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-calendar-alt"></i></span>
                                            </span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="form_row">
                                <label for="">إلى</label>
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <input type="date" value="30-11-2021"
                                        v-model="to"
                                        
                                         class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                     
                                    </div>


                                </div>
                            </div>
                            <div class="form_row">
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group"
                                            
                                            
                                             for="inputGroupSelect01"> الموقع</label>
                                        </div>
                                        <select class="custom-select"
                                        
                                        v-model="inventory_id"
                                         id="inputGroupSelect01">
                                            
                                          <option  v-for="inv in inventories" :key="inv.id">{{inv.name}}</option>
                                       
                                        </select>
                                    </div>

                                </div>
                            </div>
                         

                            <div class="form_row">
                                <div class="form_field ">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group" for="inputGroupSelect01"> النوع</label>
                                        </div>
                                        <select class="custom-select" 
                                        v-model="section"
                                        id="inputGroupSelect01">
                                            
                                          <option   value="1" selected>المبيعات والمشتريات</option>
                                          <option value="2" > المبيعات</option>
                                          <option value="3" >المشتريات</option>
                                        
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <a @click="reset()" class="btn products-reset-btn"><i class="fa fa-undo"></i> إعادة تعيين</a>

                   

                         
                        </div>
                    </form>

                    <div class="inner-block-reports col-md-12  col-sm-12 col-xs-12 clearfix">
                        <div id="inventory_table_data">
                            <div class="reports-header text-center">
                                <h3>ملخص المبيعات والمشتريات</h3>
                              
                                <h5>من <span> {{to}} </span> إلى <span>{{from}}</span></h5>
                            </div>
                            <div class="table-responsive manage-currency-table reports-table">
                                <table class="table cf table-bordered inventary-table">
                                    <thead class="cf">
                                        <tr>
                                            <th class="text-center" colspan="1">تفاصيل المنتج</th>
                                            <th class="text-center" colspan="5"
                                               v-if="section == 1 || section == 3"
                                            >المشتريات</th>
                                            <th class="text-center" colspan="5"    v-if="section == 1 || section == 2">المبيعات</th>
                                        </tr>
                                        <tr>
                                            <th>اسم المنتج</th>
                                            <th    v-if="section == 1 || section == 3">متوسط سعر الشراء</th>
                                            <th    v-if="section == 1 || section == 3">الكمية</th>
                                 
                                            <th    v-if="section == 1 || section == 3">المجموع</th>
                                            <th    v-if="section == 1 || section == 2">متوسط سعر البيع</th>
                                          
                                            <th    v-if="section == 1 || section == 2">الكمية</th>
                                            <th    v-if="section == 1 || section == 2">المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="da in sales_purchase" :key="da.id">  
                                            <td data-title="اسم المنتج"> {{da.code}} - {{da.name}}</td>
                                            <td data-title="متوسط سعر الشراء" v-if="section == 1 || section == 3"> {{da.buy_price}}.00 ر.س</td>
                                            <td data-title="الكمية"
                                             v-if="section == 1 || section == 3"
                                            > {{da.qty}}</td>
                                        
                                            <td data-title="المجموع"
                                             v-if="section == 1 || section == 3"
                                            > {{da.totalbuy}} ر.س</td>

                                            <td data-title="متوسط سعر البيع"
                                             v-if="section == 1 || section == 2"
                                            > {{da.selling}} ر.س</td>
                                            <td data-title="الكمية"
                                            
                                             v-if="section == 1 || section == 2"
                                            > {{da.totalquantity}}</td>
                                      
                                            <td data-title="المجموع"
                                            
                                             v-if="section == 1 || section == 2"
                                            > {{da.totalselling}} ر.س</td>
                                        </tr>
                                   
                                        <tr>
                                            <td>المجموع</td>
                                            <td    v-if="section == 1 || section == 3">-</td>
                                            <td    v-if="section == 1 || section == 3">-</td>
                                            
                                         
                                            <td    v-if="section == 1 || section == 3">{{purchase}} ر.س</td>
                                            <td    v-if="section == 1 || section == 2">-</td>
                                            <td    v-if="section == 1 || section == 2">-</td>
                                         
                                            <td    v-if="section == 1 || section == 2">{{sales}} ر.س</td>

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
axios({
	method:'post',
	'url':'/sales_and_purchases',
  data:{
from:this.from,
to:this.to,
inventory:this.inventory_id,
  }
}).then(res=>{

	
     
	
	 
                 
                  
this.data = res.data.data.product
                    
                    



  




})
},
       ledgerurl2(){
axios({
	method:'post',
	'url':'/manule_entry_json',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{
	res.data.data.forEach(e => {
	 if(Array.isArray(e)){
     

                    e.forEach(n=>{
this.newdata 
.push(n)
                    })
                 }else{

let vm = []

                   Object.keys(e).map((n)=>{

                  this.newdata = res.data.data
.push(e[n])
                     })

                 }



})
})
},


reset(){
this.section = 1,
this.inventory_id = ''
 this.to = moment().format("YYYY-MM-DD")
 this.from = moment().subtract(1, 'years').format("YYYY-MM-DD")
}   ,  

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

      purchase: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.totalbuy)    +    Number(sum))




    })

return sum

    },

sales: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.totalselling)    +    Number(sum))




    })

return sum

    },


sales_purchase:function(){
 
 var array = []
    this.data.forEach(e=>{
e.totalselling = 0
e.totalquantity = 0
e.totalquantity_orde = 0
 e.totalbuy = 0

if(e.purchase_order.length > 0){

    e.purchase_order.forEach(offer=>{


        e.totalbuy = (Number(offer.pivot.quantity ) * Number(offer.pivot.selling) + Number(e.totalbuy))

        e.totalquantity_orde = (Number(offer.pivot.quantity)    + Number(e.totalquantity_orde))
    })
}

    })



return this.data


    }
 
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