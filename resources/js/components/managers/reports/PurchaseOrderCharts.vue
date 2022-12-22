
<template>



   <div class="container">
        <section class="content">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">
                    <div class="add_subscription report_subscription">

                        <section class="form-content">
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
                                    <div class="form_field">
                                        <select name="query[dimension][type]" v-model="previous" id="period_dimension_type" class="selectpicker q_dimension_type">
                            <option value="">مقارنة بفترة سابقة</option>
                            <option value="previous_year">السنة الماضية</option>
                            <option value="previous_month">الشهر الماضي</option>
                            <option value="previous_quarter">الربع السابق</option>
                            <option value="previous_week">الأسبوع السابق</option>
                            <option value="previous_day">اليوم السابق</option>
                        </select>
                                    </div>
                                </div>

                                <div class="form_row">
                                    <div class="form_field ">
                                        <select name="query[dimension][query][]" v-model="Period" id="period_dimension_query" class="selectpicker">
                            <option value="">عدد الفترات الزمنية</option>
                            <option selected="selected" value="1">فترة</option>
                            <option value="2">فترتان</option>
                            <option value="3">3 فترات</option>
                            <option value="4">4 فترات</option>
                            <option value="5">5 فترات</option>
                            <option value="6">6 فترات</option>
                            <option value="7">7 فترات</option>
                            <option value="8">8 فترات</option>
                            <option value="9">9 فترات</option>
                            <option value="10">10 فترات</option>
                            <option value="11">11 فترة</option>
                            <option value="12">12 فترة</option>
                            <option value="13">13 فترة</option>
                        </select>
                                    </div>
                                </div>

                                <div class="form_row">
                                    <div class="form_field ">
                                        <select name="category" id="category" class="selectpicker"><option value="">صنف المنتج</option><option value="1">الصنف الأساسي</option></select>
                                    </div>
                                </div>

                                <div class="form_row search  ">
               
                                </div>

                            </form>
                        </section>
                    </div>
                    <div class="reports-header text-center">
                        <h3>تقرير مشتريات المنتجات</h3>
             
                        <h5>
                            في <span> {{from}}</span>
                        </h5>
                        <h5>
                            <h5> جميع الفئات</h5>
                        </h5>
                    </div>
                    <div id="chartContainer2" data-highcharts-chart="0">
                            <apexchart type="scatter" height="350" :options="chartOptions" :series="series"></apexchart>
                </div>
            </div> </div>

        </section>
    </div>


</template>

<script>
          import moment from 'moment'

        export default {
      mounted() {

this.ledgerurl()
this.from = moment().format("YYYY-MM-DD")

  },
  
      data() {
        
    return {
 from:'',
 array:[],
 previous:'',
Period:'',
 data:[],
          series: [{
            name: "SAMPLE A",
            data: [
            [16.4, 5.4]
            ]
          },

          {
            name: "SAMPLE b",
            data: [
            [16.4, 20.4]
            ]
          },


          {
            name: "SAMPLE c",
            data: [
            [16.4, 18.4]
            ]
          },



          ],
          chartOptions: {
            chart: {
              height: 350,
              type: 'scatter',
              zoom: {
                enabled: true,
                type: 'xy'
              }
            },
            xaxis: {
             lines: {
                  show: true
                },
              type: 'datetime'
            },
            yaxis: {
              tickAmount: 7
            }
          },
          
          
      
      
          
          
        
    }
          
        },
          methods: {
            

       ledgerurl(){
this.array = []
         for (let countyear = 0; countyear < this.Period; countyear++) {
           if(this.previous == 'previous_year'){
this.array.push(moment(this.from).subtract(countyear, 'years').format("MM/DD/YYYY"))
           }
   if(this.previous == 'previous_month'){
this.array.push(moment(this.from).subtract(countyear, 'months').format("MM/DD/YYYY"))
           }

             if(this.previous == 'previous_week'){
this.array.push(moment(this.from).subtract(countyear, 'weeks').format("MM/DD/YYYY"))
           }

           
             if(this.previous == 'previous_quarter'){
this.array.push(moment(this.from).subtract(countyear, 'quarter').format("MM/DD/YYYY"))
           }


       if(this.previous == 'previous_day'){
this.array.push(moment(this.from).subtract(countyear, 'days').format("MM/DD/YYYY"))
           }

           

           
        
         }
axios({
	method:'post',
	'url':'/managers/report/purchase_orderjson',
  data:{
from:

moment(this.from).format("MM/DD/YYYY"),
to:this.to,
Period:this.array,
  }
}).then(res=>{

	this.series.splice(0)

this.data = res.data.data.product
 
  

this.updatechart()


})

},


updatechart(){
       var current = 0;
      

 this.data.forEach(e=>{
   
   e.purchase_order.forEach(purchase_order => {

     this.series.forEach(z=>{
       if(z.name == e.name){
         z.data.push( [ moment(purchase_order.date).format(" D  MMM  YY"), e.offerpaid_count])
         current = 1
         console.log(1)
       }
         })
       if(current == 0){
       
         
this.series.push({name:e.name,
data:[

    [ moment(purchase_order.date).format(" D  MMM  YY"), e.purchase_order_count]
]
})
 
       }
             
       
   

   });

 current = 0
})


        

}
  },

  watch:{
  "from" :function (id){
this.ledgerurl()

},
"Period" :function (id){
this.ledgerurl()

},

"previous" :function (id){
this.ledgerurl()

},



}		, 
      }
    </script>