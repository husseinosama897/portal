<template>
<div class="container">
        <section class="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">
                    <div class="form-content">
                        <form class="form-wraper report_filter_validation_aged_invoice" action="/tenant/reports/tax_return" accept-charset="UTF-8" method="get">
                            <input name="utf8" type="hidden" value="&#x2713;" />
                            <div class="form_row">
                                <div class="form_field ">
                                    <select name="select_duration_type" id="select_duration_type" class="selectpicker">
                                        <option value="">نوع الفترة شهري / ربع سنوي</option><option value="Monthly">شهري</option>
                                         <option value="Quarterly">ربع سنوي</option>
                                        </select>
                                </div>
                            </div>
                            <div class="form_row">
                                <div class="form_field ">
                                    <div id="duration_type_dropdown">
                                        <select name="duration_value" id="duration_value" class="selectpicker">
                                            <option value=""> نوع الفترة الشهر / الربع</option>
                                            <option value="1">الربع الأول</option>
                                            <option value="2">الربع الثاني</option>
                                            <option value="3">الربع الثالث</option>
                                            <option value="4">الربع الرابع</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form_row">
                                <div class="form_field ">
                                    <select name="year" id="year" class="selectpicker">
                                        <option value="">السنة</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>
   
                        </form>
                    </div>
                      <div id="data_container">
                        <div class="inner-block-reports col-md-12  col-sm-12 col-xs-12 clearfix" style="width: 124%; margin-right: -150px;">
                            <div class="reports-header text-center">
                                <h3>نموذج الإقرار الضريبي</h3>
                           
                                <h5>
                                    <br>
                                    <span></span>
                                </h5>
                                <h5><b>من </b>
                                    <span> : {{from}}</span> <b> إلى </b>
                                    <span> : {{to}}</span>
                                </h5>
                                <h5>
                                    <b>الرقم الضريبي</b> :
                                </h5>
                            </div>

                            <div class="table-responsive manage-currency-table reports-table  ">
                                <table class="table cf table-bordered inventary-table  text-center">
                                    <thead class="cf">
                                        <tr>
                                            <th class="text-center" style="background: white;" colspan="2"></th>
                                            <th class="text-center" colspan="2">الرصيد</th>
                                         
                                            <th class="text-center" colspan="1">رصيد الضريبة</th>
                                        </tr>
                                    </thead>
                                    <thead class="cf">
                                        <tr>
                                            <th class="text-center" colspan="2">الضريبة</th>
                                            <th class="text-center" colspan="2">المبيعات</th>
                                          
                                            <th class="text-center" colspan="1">الضريبة المستحقة</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center-important" colspan="2">ضريبة القيمة المضافة</td>
                                            <td class="text-center-important" colspan="2">{{sales}}</td>
                                       
                                            <td class="text-center-important" colspan="4">{{salestax}}</td>
                                        </tr>


                                        <tr class="text-bold" style="    font-weight: 700;">
                                            <td class="text-center-important" colspan="2">المجموع</td>
                                            <td class="text-center-important" colspan="2">ر.س{{sales}}</td>
                                            
                                            <td class="text-center-important" colspan="4">ر.س{{salestax}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive manage-currency-table reports-table text-center">
                                <table class="table cf table-bordered inventary-table">
                                    <thead class="cf">
                                        <tr>
                                            <th class="text-center" colspan="2">الضريبة</th>
                                            <th class="text-center" colspan="2">المشتريات</th>
                                         
                                            <th class="text-center" colspan="1">الضريبة المدفوعة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center-important" colspan="2">ضريبة القيمة المضافة</td>
                                            <td class="text-center-important" colspan="2">{{purchase_order}}</td>
                                            
                                            <td class="text-center-important" colspan="4">{{purchase_ordertax}}</td>
                                        </tr>

                                

                                        <tr class="text-bold" style="    font-weight: 700;">
                                            <td class="text-center-important" colspan="2">المجموع</td>
                                            <td class="text-center-important" colspan="2">ر.س{{purchase_order}}</td>
                                           
                                            <td class="text-center-important" colspan="4">ر.س{{purchase_ordertax}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div class="table-responsive manage-currency-table reports-table ">
                                    <table class="table cf table-bordered inventary-table">
                                        <thead class="cf">
                                        </thead>
                                        <tbody style="border-top: 0px ">
                                            <tr class="text-bold" style="font-weight: 700; ">
                                                <td class="text-center-important">إجمالي ضريبة القيمة المضافة المستحقة عن الفترة الضريبية</td>
                                                <td class="text-center-important">ر.س{{summary}}</td>
                                            </tr>
                                            <tr class="text-bold" style="font-weight: 700;">
                                              
                                                    <input name="utf8" type="hidden" value="&#x2713;" />
                                                    <input type="hidden" name="authenticity_token" value="ofkiDJmNL9CUVX113z7LvdZcC+V7FkYT2582XHleoNPm8UkqnS9wfQE+XLuPYXuViBiTt23ZHtHDRn0Mq4dVKg==" />
                                                    <td class="text-center-important">ضريبة القيمة المضافة التي تم ترحيلها من الفترة/الفترات السابقة</td>
                                                    <td class="text-center-important" lang="en">
                                                        <input style=" padding:3px 15px; " class="text-center" value="0.0" type="" name="previous_period[previous_period_value]" id="previous_period_previous_period_value" /></td>
                                            </tr>
                                            <tr class="text-bold" style=" font-weight: 700;">
                                                <td class="text-center-important">
                                                    <div id="corrections_previous_statement">التصحيحات من الفترات السابقة (-٥٠٠٠ إلى ٥٠٠٠)</div>
                                                </td>
                                                <td class="text-center-important" lang="en">
                                                    <input style=" padding:3px 15px; " class="text-center" value="0.0" type="" name="previous_period[correction_previous_period]" id="previous_period_correction_previous_period" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold text-center-important" style="background: #E8F0F2;color: #3c8dbc; font-weight: 700;">صافي القيمة المستحقة (أو المستردة)</td>
                                                <td class="text-bold text-center-important">
                                                    <div class="form_field center-block" lang="en">
                                                        <input style="cursor:not-allowed  ;    
                                                        width: 35%;
                                                        border: 1px solid #DFDFDF;
                                                        border-radius: 3px;
                                                        box-shadow: 0.5px 0 3px 0 #dfdfdf;
                                                        padding: 5px 8px;
                                                        color: #333;
                                                        font-size: 0.95em;
                                                        font-style: normal;
                                                        position: relative;" disabled readonly="readonly" value="0" class="text-center-important" type="number" name="previous_period[net_vat_value]" id="previous_period_net_vat_value" /></div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                  
                                </div>


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
data:{
},
offerpaid:[],
purchase_orders:[],

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
	'url':'/managers/taxreportjson',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{

	
  this.offerpaid = res.data.data.offerpaid
this.purchase_orders = res.data.data.purchase_order



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

      sales: function () {
     var sum = 0

this.offerpaid.forEach(offer=>{



sum = (Number(sum) + Number(offer.overall))



    
       })

return sum

    },

    salestax: function () {
     var sum = 0

this.offerpaid.forEach(offer=>{



sum = (Number(sum) + Number(offer.tax))



    })
     

return sum

    },

  purchase_order: function () {
     var sum = 0

this.purchase_orders.forEach(offer=>{



sum = (Number(sum) + Number(offer.overall))



    
       })

return sum

    },
      purchase_ordertax: function () {
     var sum = 0

this.purchase_orders.forEach(offer=>{



sum = (Number(sum) + Number(offer.tax))



    })
       

return sum


    },




summary: function(){

    return (Number(this.salestax) - Number(this.purchase_ordertax)) ?? 0
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