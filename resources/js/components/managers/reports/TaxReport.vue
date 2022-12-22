<template>

    <div class="container">
        <section class="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
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




                        <div class="form_row search  ">
                            <input type="hidden" name="filter" id="filter" value="true">
                            <button name="button" type="submit" class="btn filter-btn">
                            <i class="fas fa-filter"></i> بحث</button>
                            <a class="btn products-reset-btn">
                                <i class="fa fa-undo"></i>إعادة تعيين
                            </a>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="inner-block-reports col-md-12  col-sm-12 col-xs-12 clearfix" style="width: 120%; margin-right: -125px;">
                    <div id="inventory_table_data">
                        <div class="reports-header text-center">
                            <h3>تقرير فواتير المشتريات الضريبية</h3>
                           
                            <h5>
                                من
                                <span>{{from}}</span> إلى
                                <span>{{to}}</span>
                            </h5>
                        </div>
                        <div class="table-responsive manage-currency-table reports-table">
                            <table class="table cf table-bordered inventary-table">
                                <thead class="cf">
                                    <tr>
                                        <th class="text-center">مرجع الفاتورة</th>
                                       
                                        <th class="text-center">اسم المورد</th>
                                        <th class="text-center">الرقم الضريبي للمورد</th>
                                        <th class="text-center">تاريخ الإصدار</th>
                                        <th class="text-center">تاريخ الاستحقاق</th>
                                        <th class="text-center">مجموع الفاتورة</th>
                                        <th class="text-center">مجموع الضريبة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="da in data" :key="da.id">
                                        <td :data-title="da.code"> {{da.ref}}</td>
                                  
                                        <td data-title="اسم المورد"  v-if="da.suppiler" > {{da.supplier.supplier_name ? da.supplier.supplier_name : da.supplier.comp}}</td>
                                        <td v-else></td>
                                        <td data-title="الرقم الضريبي للمورد"  v-if="da.suppiler">
                                            
                                            {{da.supplier.tax_number}}
                                             </td>
                                               <td v-else></td>

                                        <td data-title="تاريخ الإصدار"> {{da.date}}</td>
                                        <td data-title="تاريخ الاستحقاق">{{da.due_date}}</td>
                                        <td data-title="مجموع الفاتورة"> {{da.total}} ر.س</td>
                                        <td data-title="مجموع الضريبة">{{da.vat}} ر.س</td>
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
                            <ul class="dropdown-menu text-right" style="min-width: 100px;" aria-labelledby="dropdownMenuButton1">
                                <li style="text-align: right;">
                                    <a class="dropdown-item" href="#"><img src="assets/Exel_icon.png" alt=""> اكسل</a>
                                </li>
                                <li style="text-align: right;">
                                    <a class="dropdown-item" href="#"><img src="assets/pdf_Icon.png" alt=""> PDF</a>
                                </li>
                            </ul>
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
data:{},
barcode:'',
to:'',
from:'',
 dis:'',
buy_price:'',
editz:{},
selectedlevel:'',
searchname:'',
supplier_address:'',
code:'',
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
	'url':'/managers/report_purchase_order',
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

      overall: function () {
     var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.total)    +    Number(sum))




    })

return sum

    },


tax:function(){
 
  var sum = 0
    this.data.forEach(e=>{



sum = (Number(e.vat)    +    Number(sum))




    })

return sum


    }
 
},
watch:{
"from" :function (id){
this.ledgerurl()
},
"to" :function (id){
this.ledgerurl()
}
}		,   

    }
</script>
