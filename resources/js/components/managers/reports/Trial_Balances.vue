<template>

   <div class="container">
        <section class="content">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">

                    <section class="form-content">
                        <form class="form" action="#" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                            <div class="group-one">
                                <div class="flow-right">
                                    <div class="form_row">

                                        <div class="form_field ">
                                            <div class="input-group mb-3">
                                                <input type="date" v-model="from" value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                            
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form_row">

                                        <div class="form_field ">
                                            <div class="input-group mb-3">
                                                <input type="date" v-model="to" value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                              
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <select class="form-select form-select-sm" id="inputGroupSelect04">
                                                    <option value="" selected>Group by</option>
                                                            <option value="1">عرض نوع الحساب فقط</option>
                                                            <option value="2">المستوى 2</option>
                                                            <option value="3">المستوى 3</option>
                                                            <option value="4">المستوى 4</option>
                                                            <option value="5">المستوى 5</option>
                                                            <option value="6">المستوى 6</option>
                                                </select>
                                    </div>
                                </div>
                          
                            </div>
                       



                       
                            <br>

                            <!-- begin toggle markup	 -->
                            <label class="toggle" for="uniqueID">
                            <b style="font-weight: normal;">إظهار الحسابات التفصيلية (العملاء، الموردين، الموظفين) </b>
                            <input type="checkbox" class="toggle__input" id="uniqueID" />
                            <span class="toggle-track">
                                <span class="toggle-indicator">
                                    <!-- 	This check mark is optional	 -->
                                </span>
                            </span>
                        </label>
                            <!-- end toggle markup	 -->

                            <div class="form_row search  ">
                                <input type="hidden" name="filter" id="filter" value="true">
                                <button name="button" type="submit" class="btn filter-btn">
                <i class="fas fa-filter"></i> بحث</button>
                                <a class="btn products-reset-btn">
                                    <i class="fa fa-undo"></i>إعادة تعيين
                                </a>
                            </div>

                        </form>
                    </section>

                    <div class="inner-block-reports col-md-12 col-sm-12 col-xs-12 clearfix">
                        <div class="reports-header text-center">
                            <h3>
                                ميزان المراجعة
                            </h3>
                     
                            <h6></h6>
                            <h5>
                                من
                                <span>{{from}}</span> إلى
                                <span>{{to}}</span>
                            </h5>
                        </div>
                        <div class="table-responsive manage-currency-table reports-table tree-table tree" style="width: 124%; margin-right: -150px;">
                            <table class="table cf">
                                <thead class="cf">
                                    <tr>
                                        <th rowspan="2" colspan="3" style="text-align: center;">
                                            الحساب
                                        </th>
                                        <th colspan="2" style="text-align: center;">الرصيد الإفتتاحي</th>
                                        <th colspan="2" style="text-align: center;">الحركة</th>
                                        <th colspan="2" style="text-align: center;">صافي الحركة</th>
                                        <th colspan="2" style="text-align: center;">الرصيد الختامي</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">مدين</th>
                                        <th style="text-align: center;">دائن</th>
                                        <th style="text-align: center;">مدين</th>
                                        <th style="text-align: center;">دائن</th>
                                        <th style="text-align: center;">مدين</th>
                                        <th style="text-align: center;">دائن</th>
                                        <th style="text-align: center;">مدين</th>
                                        <th style="text-align: center;">دائن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                             
                                    <tr v-for="(data,index) in newdata" :key="index" v-bind:class="{ dark_row:data.dark == 1 }" >
                                        <td colspan="3" :class="'padleftindex-'+data.level">
                                           {{data.name}}  -  {{data.code}}
                                        </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2020-12-31&quot;,&quot;from&quot;:&quot;2021-11-05&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;debit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            0.00 ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2020-12-31&quot;,&quot;from&quot;:&quot;2021-11-05&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;credit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            0.00 ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-01-01&quot;,&quot;amount_type&quot;:&quot;Debit&quot;,&quot;balance&quot;:null,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            {{data.debtor}} ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-01-01&quot;,&quot;amount_type&quot;:&quot;Credit&quot;,&quot;balance&quot;:null,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            {{data.creditor}} ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-01-01&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;debit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            {{data.net_debtor}} ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-01-01&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;credit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            {{data.net_creditor}} ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-11-05&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;debit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
         {{data.closing_balance_debtor}} ر.س
            </span> </td>
                                        <td>
                                            <span class="amount-popup underline" data-account-id="29" data-query="{&quot;account_id&quot;:29,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-11-05&quot;,&quot;amount_type&quot;:null,&quot;balance&quot;:&quot;credit&quot;,&quot;actual_to_date&quot;:&quot;2021-11-30&quot;,&quot;is_trial_balance&quot;:true,&quot;fiscal_date&quot;:&quot;2021-01-01&quot;,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null}}">
            {{data.closing_balance_creditor}} ر.س
            </span> </td>
                                    </tr>
                            
                         
                            
                          
                                    <tr class="reports-total">
                                        <td colspan="3" data-title="Account">المجموع</td>
                                        <td data-title="Debit">
                                            0.00 ر.س
                                        </td>
                                        <td data-title="Credit">
                                            0.00 ر.س
                                        </td>
                                        <td data-title="Debit">
                                            {{depetor}} ر.س
                                        </td>
                                        <td data-title="Credit">
                                            {{creditor}} ر.س
                                        </td>
                                        <td data-title="Debit">
                                            {{net_debtor}} ر.س
                                        </td>
                                        <td data-title="Credit">
                                            {{net_creditor}} ر.س
                                        </td>
                                        <td data-title="Debit">
                                            {{closing_balance_debtor}} ر.س
                                        </td>
                                        <td data-title="Credit">
                                           {{closing_balance_creditor}} ر.س
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="report-bottom" style="margin-left: 0; margin-bottom: -60px;">
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
	'url':'/managers/ledger',
  data:{
from:this.from,
to:this.to,

  }
}).then(res=>{
this.newdata = []
this.data = res.data.data

this.data.forEach(e=>{

this.newdata.push({creditor:e.creditor,debtor:e.debtor,name:e.name,code:e.code,level:e.level,
    
    creditor:0,debtor:0,net_debtor:0,net_creditor:0
    })
e.creditor = 0
e.debtor = 0
e.net_debtor = 0
e.net_creditor = 0
e.closing_balance_creditor = 0
e.closing_balance_debtor = 0

e.subaccount1.forEach(z=>{
    z.creditor = 0
z.debtor = 0
z.net_debtor = 0
z.net_creditor = 0
z.closing_balance_creditor = 0
z.closing_balance_debtor = 0
  this.newdata.push({name:z.name,code:z.code,id:z.id,level:z.level,creditor:0,debtor:0,net_creditor:0,
  
  net_debtor:0
  })



  z.sub_account3.forEach(f=>{

 f.creditor  = 0
f.debtor = 0   
f.net_debtor = 0
f.net_creditor = 0
f.closing_balance_creditor = 0
f.closing_balance_debtor = 0
 if(f.sub_account4.length > 0){
  this.newdata.push({name:f.name,code:f.code,id:f.id,level:f.level,creditor:0,debtor:0,net_creditor:0,net_debtor:0})
 }
 

if(f.sub_account4.length > 0){


 f.sub_account4.forEach(g=>{

g.creditor  = 0
g.debtor = 0
g.net_debtor = 0
g.net_creditor = 0
g.closing_balance_creditor = 0
g.closing_balance_debtor = 0


if(g.manule_creditor_sub_account4.length > 0){
  g.manule_creditor_sub_account4.forEach(manule_creditor4=>{

g.creditor = (Number(g.creditor)   + Number(manule_creditor4.value) )

     })
}




if(g.manule_debtor_sub_account4.length > 0){

      g.manule_debtor_sub_account4.forEach(manule_debtor4=>{

g.debtor = (Number(g.debtor)   + Number(manule_debtor4.value) )

     })

}












 ( Number(g.debtor) -   Number(g.creditor)   +  Number(g.net_debtor)  ) > 0 


 ?    g.net_debtor =  ( Number(g.debtor) -   Number(g.creditor)   +  Number(g.net_debtor)  )



 :  g.net_creditor =  (     Number(g.creditor)   - Number(g.debtor)   +  Number(g.net_creditor)  )


g.closing_balance_debtor = g.net_debtor
g.closing_balance_creditor = g.net_creditor


    
  f.net_debtor = ( Number(f.net_debtor) +   Number(g.net_debtor)     ) 
 
 

     f.net_creditor = (     Number(f.net_creditor)   + Number(g.net_creditor)   )

f.closing_balance_debtor = f.net_debtor
f.closing_balance_creditor = f.net_creditor



f.creditor = (Number(g.creditor)   +  Number(f.creditor)   )  

f.debtor = (Number(g.debtor)   +  Number(f.debtor)   ) 

 
 





  this.newdata.push(g)



})







}
   


if(f.manule_creditor_sub_account3.length > 0){

f.manule_creditor_sub_account3.forEach(e=>{

     f.creditor  = (Number(e.value) + Number(f.creditor))

})

}

if(f.manule_debtor_sub_account3.length > 0){

f.manule_debtor_sub_account3.forEach(e=>{

     f.debtor  = (Number(e.value) + Number(f.debtor))

})

}

if(f.manule_creditor.length > 0){

f.manule_creditor.forEach(e=>{

     f.creditor  = (Number(e.value) + Number(f.creditor))

})

}






 

 


if(f.sub_account4.length > 0){
  this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,dark:1,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net_creditor :f.net_creditor,net_debtor:f.net_debtor,closing_balance_creditor:f.closing_balance_creditor,
    closing_balance_debtor:f.closing_balance_debtor
    })
}else{

if(( Number(f.debtor) -   Number(f.creditor)    ) > 0 ){
 f.net_debtor =  ( Number(f.debtor) -   Number(f.creditor)    )

f.closing_balance_debtor = f.net_debtor

}else{
 f.net_creditor =  (     Number(f.creditor)   - Number(f.debtor)     )
f.closing_balance_creditor = f.closing_balance_creditor

}


      this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net_creditor :f.net_creditor,net_debtor:f.net_debtor,closing_balance_creditor:f.closing_balance_creditor,
    closing_balance_debtor:f.closing_balance_debtor
    })
}

z.creditor = (Number(z.creditor) + Number(f.creditor))

z.debtor = (  Number(f.debtor) + Number(z.debtor))

  z.net_debtor = ( Number(f.net_debtor) +   Number(z.net_debtor)     ) 
 
 

     z.net_creditor = (     Number(f.net_creditor)   + Number(z.net_creditor)   )
     
z.closing_balance_debtor =  z.net_debtor
z.closing_balance_creditor = z.net_creditor


})

this.newdata.push({creditor:z.creditor,debtor:z.debtor,name:z.name,code:z.code,dark:1,level:z.level,
    
    creditor:z.creditor,debtor:z.debtor,net_debtor:z.net_debtor,net_creditor:z.net_creditor,


    closing_balance_creditor:z.closing_balance_creditor,
    closing_balance_debtor:z.closing_balance_debtor


    })






e.debtor = (  Number(e.debtor) + Number(z.debtor))
e.creditor = (  Number(e.creditor) + Number(z.creditor))

e.net_debtor = ( Number(z.net_debtor) +   Number(e.net_debtor)     ) 
 e.net_creditor = (     Number(e.net_creditor)   +  Number(z.net_creditor)   )



e.closing_balance_debtor =   (     Number(e.closing_balance_debtor)   + Number(z.closing_balance_debtor)   )
e.closing_balance_creditor =  (     Number(e.closing_balance_creditor)   + Number(z.closing_balance_creditor)   )





})

 


this.newdata.push({creditor:e.creditor,debtor:e.debtor,name:e.name,code:e.code,dark:1,level:e.level,net_creditor:e.net_creditor,

net_debtor:e.net_debtor,
    
    creditor:e.creditor,debtor:e.debtor,net:e.net,
    closing_balance_creditor:e.closing_balance_creditor,
    closing_balance_debtor:e.closing_balance_debtor
    })



})


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

      creditor: function () {
     var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.creditor)    +    Number(sum))


}

    })

return sum

    },


net_debtor:function(){
 
  var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.net_debtor)    +    Number(sum))


}

    })

return sum


    },
    net_creditor:function(){
 
  var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.net_creditor)    +    Number(sum))


}

    })

return sum


    },

      closing_balance_creditor:function(){
 
  var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.closing_balance_creditor)    +    Number(sum))


}

    })

return sum


    },
        closing_balance_debtor:function(){
 
  var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.closing_balance_debtor)    +    Number(sum))


}

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
