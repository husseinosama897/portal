<template>

    <div class="container">
        <section class="content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="add_subscription_form add-products-form clearfix">
                    <div class="add_subscription report_subscription">
                       <div class="form-content">
                <form class="form" action="#" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                    <div class="form_row">
                        <label for="">من</label>
                        <div class="form_field ">
                            <div class="input-group mb-3">
                                <input type="date" v-model="from" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
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
                                <input type="date" v-model="to" value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
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
                                    <div class="form_field">
                                        <select name="query[dimension][type]" v-model="Period" id="period_dimension_type" class="selectpicker q_dimension_type">
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
                                        <select name="query[dimension][query][]" v-model="previous" id="period_dimension_query" class="selectpicker">
                                        <option value="">عدد الفترات الزمنية</option>
                                        <option selected="selected" value="Period 1">فترة</option>
                                        <option value="Period 2">فترتان</option>
                                        <option value="Period 3">3 فترات</option>
                                        <option value="Period 4">4 فترات</option>
                                        <option value="Period 5">5 فترات</option>
                                        <option value="Period 6">6 فترات</option>
                                        <option value="Period 7">7 فترات</option>
                                        <option value="Period 8">8 فترات</option>
                                        <option value="Period 9">9 فترات</option>
                                        <option value="Period 10">10 فترات</option>
                                        <option value="Period 11">11 فترة</option>
                                        <option value="Period 12">12 فترة</option>
                                        <option value="Period 13">13 فترة</option>
                                    </select>
                                    </div>
                                </div>

                    <div class="form_row search  ">
         
                        <a @click="reset()" class="btn ledgerurls-reset-btn">
                            <i class="fa fa-undo"></i>إعادة تعيين
                        </a>
                    </div>
                </form>
                <br>



                <div class="reports-checkbox">
                    <input id="ytd_balance" type="checkbox" name="ytd">
                    <label class="form-checkbox" for="ytd_balance"> عرض صافي الحركة للسنة المالية بتاريخ الرصيد الختامي</label>
                </div>

            </div>
                    </div>
                    <div class="inner-block-reports col-md-12 col-sm-12 col-xs-12 clearfix">
                        <div class="reports-header text-center">
                            <h3>الميزانية العمومية</h3>
            
                            <h6></h6>
                            <h5>
                                <span>
            
            <span class="titleize">
      {{to}}  الي {{from}} من
            </span>
                                </span>
                            </h5>
                        </div>
                        <div class="table-responsive reports-table tree-table tree">
                            <table class="table cf ">
                                <thead class="cf">
                                    <tr>
                                        <th colspan="3">&nbsp;</th>
                                        <th v-for="(arr,index) in array" :key="index" >
                                  {{arr}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                 
         
                                    <tr v-for="(data,index) in newdata" :key="index" v-bind:class="{ dark_row:data.dark == 1  }">
                                        <td colspan="3" 
                                        v-if="data.level == 1"
                                        
                                        v-bind:class="{ report_table_head:data.level == 1   }"

                                        >


                                         {{data.name}}
                                        </td>


    <td colspan="3" 
                                        v-else
                                        
:class="'padleftindex-'+data.level"

                                        >


                                         {{data.name}}
                                        </td>



                                       
                                        <td  v-for="net in data.net" :key="net.net">
                                            <span class="amount-popup underline" data-account-id="52" data-query="{&quot;account_id&quot;:52,&quot;to&quot;:&quot;2021-11-30&quot;,&quot;from&quot;:&quot;2021-11-05&quot;,&quot;amount_type&quot;:null,&quot;filter&quot;:{&quot;type&quot;:null,&quot;kind&quot;:null},&quot;dimension&quot;:{&quot;type&quot;:null,&quot;query&quot;:[&quot;2021-11-30&quot;],&quot;kind&quot;:null}}">
            ({{net.net}} ر.س)
            </span> </td>
                           

                           
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

        </section>
    </div>

</template>

<script>
  import moment from 'moment'

    export default {
  mounted() {
 this.to = moment().format("YYYY-MM-DD")
 this.from = moment().subtract(1, 'years').format("YYYY-MM-DD")
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
previous:'previous_year',
Period:1,
to:'',
from:'',
 dis:'',
buy_price:'',
editz:{},
selectedlevel:'',
searchname:'',
supplier_address:'',
code:'',
array:[],
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



reset(){
this.previous = '',
this.Period = ''
 this.to = moment().format("YYYY-MM-DD")
 this.from = moment().subtract(1, 'years').format("YYYY-MM-DD")
}   ,    


       ledgerurl(){
           this.array = []
         for (let countyear = 0; countyear < this.Period; countyear++) {
           if(this.previous == 'previous_year'){
this.array.push(moment(this.to).subtract(countyear, 'years').format("YYYY-MM-DD"))
           }
   if(this.previous == 'previous_month'){
this.array.push(moment(this.to).subtract(countyear, 'months').format("YYYY-MM-DD"))
           }

             if(this.previous == 'previous_week'){
this.array.push(moment(this.to).subtract(countyear, 'weeks').format("YYYY-MM-DD"))
           }

           
             if(this.previous == 'previous_quarter'){
this.array.push(moment(this.to).subtract(countyear, 'quarter').format("YYYY-MM-DD"))
           }


       if(this.previous == 'previous_day'){
this.array.push(moment(this.to).subtract(countyear, 'days').format("YYYY-MM-DD"))
           }

           

           
        
         }

axios({
	method:'post',
	'url':'/managers/ledger',
  data:{
from:
moment(this.from).format("YYYY-MM-DD"),
to:moment(this.to).format("YYYY-MM-DD"),

  }
}).then(res=>{
this.newdata = []
this.data = res.data.data

this.data.forEach(e=>{

Vue.set(e,'creditor',[])
Vue.set(e,'debtor',[])
Vue.set(e,'net',[])


for (let index = 0; index < this.array.length; index++) {


e.creditor.push({ name:this.array[index] , creditor:0  })

e.debtor.push({ name:this.array[index] , debtor:0  })



e.net.push({ name:this.array[index] , net:0  })

}

e.subaccount1.forEach(z=>{
z.creditor = []
z.debtor = []
z.net = []
  this.newdata.push({name:z.name,code:z.code,id:z.id,level:z.level,creditor:0,debtor:0})
for (let index = 0; index < this.array.length; index++) {

z.creditor.push({ name:this.array[index] , creditor:0  })

z.debtor.push({ name:this.array[index] , debtor:0  })



z.net.push({ name:this.array[index] , net:0  })

}
  z.sub_account3.forEach(f=>{
f.creditor = []
f.debtor = []
f.net = []
for (let index = 0; index < this.array.length; index++) {


f.creditor.push({ name:this.array[index] , creditor:0  })

f.debtor.push({ name:this.array[index] , debtor:0  })



f.net.push({ name:this.array[index] , net:0  })

}


 if(f.sub_account4.length > 0){
  
  this.newdata.push({name:f.name,code:f.code,id:f.id,level:f.level,creditor:0,debtor:0})
     

 }

if(f.sub_account4.length > 0){


 f.sub_account4.forEach(g=>{
g.creditor = []
g.debtor = []
g.net = []
for (let index = 0; index < this.array.length; index++) {


g.creditor.push({ name:this.array[index] , creditor:0  })

g.debtor.push({ name:this.array[index] , debtor:0  })



g.net.push({ name:this.array[index] , net:0  })

}




if(g.creditor_sub_account4.length > 0){
  g.creditor_sub_account4.forEach(creditor4=>{
g.creditor.forEach(creditortest=>{

if( creditor4.date  <=  creditortest.name   ){
creditortest.creditor = (Number(creditortest.creditor)   + Number(creditor4.value) )
}


})



     })
}

if(g.manule_creditor_sub_account4.length > 0){
  g.manule_creditor_sub_account4.forEach(manule_creditor4=>{

g.creditor.forEach(creditortest=>{
if(manule_creditor4.date <=   creditortest.name   ){
creditortest.creditor = (Number(creditortest.creditor)   + Number(manule_creditor4.value) )

}


})

     })
}


if(g.debtor_sub_account4.length > 0){

      g.debtor_sub_account4.forEach(debtor4=>{


g.debtor.forEach(debtortest=>{
if( debtor4.date <= debtortest.name  ){
debtortest.debtor = (Number(debtortest.debtor)   + Number(debtor4.value) )

}


})


     })

}


if(g.manule_debtor_sub_account4.length > 0){

      g.manule_debtor_sub_account4.forEach(manule_debtor4=>{

g.debtor.forEach(debtortest=>{
if(manule_debtor4.date <=  debtortest.name  ){
debtortest.debtor = (Number(debtortest.debtor)   + Number(manule_debtor4.value) )

}


})



     })

}

g.creditor.forEach(creditortest=>{

g.debtor.forEach(debtortest=>{
    if( creditortest.name ==  debtortest.name ){
        g.net.forEach(nettest=>{
            if(nettest.name == debtortest.name  ){
        
      
nettest.net = ( Number(debtortest.debtor) -   Number(creditortest.creditor)     )
           
      
  
                }
               
        })
    }
})

})

g.creditor.forEach(creditortest=>{
    f.creditor.forEach(fcreditortest=>{
if(fcreditortest.name == creditortest.name){
fcreditortest.creditor = (Number(creditortest.creditor)   +  Number(fcreditortest.creditor)   )  
}

})

})
g.debtor.forEach(debtortest=>{
    f.debtor.forEach(fdebtortest=>{
if(fdebtortest.name == debtortest.name){
    fdebtortest.debtor = (Number(debtortest.debtor)   +  Number(fdebtortest.debtor)   ) 

}

})

})

g.net.forEach(gnet=>{

    f.net.forEach(e=>{

if(e.name == gnet.name){
 e.net = (Number(e.net)   +  Number(gnet.net)   ) 

}


    })
})

if(g.net[0].net > 0){

this.newdata.push(g)

}


  


})







}
   

if(f.manule_creditor_sub_account3.length > 0){

f.manule_creditor_sub_account3.forEach(e=>{
 f.creditor.forEach(fcreditortest=>{
if(e.date <=  fcreditortest.name  ){
  
    fcreditortest.creditor  = (Number(e.value) + Number(fcreditortest.creditor))
}
})

})


}

if(f.manule_debtor_sub_account3.length > 0){

f.manule_debtor_sub_account3.forEach(e=>{
 f.debtor.forEach(fdebtortest=>{

if(e.date <=  fdebtortest.name  ){
   
     fdebtortest.debtor = (Number(e.value) + Number(fdebtortest.debtor))
       console.log(e.value)
}
 })

})

}

if(f.manule_creditor.length > 0){

f.manule_creditor.forEach(e=>{
 f.creditor.forEach(fcreditortest=>{
if(e.date <=  fcreditortest.name  ){
     fcreditortest.creditor  = (Number(e.value) + Number(fcreditortest.creditor))
}
})


})

}

z.creditor.forEach(zcreditor=>{
    f.creditor.forEach(fcreditor=>{
if(fcreditor.name ==  zcreditor.name){
  zcreditor.creditor =    (Number(zcreditor.creditor) + Number(fcreditor.creditor))
}
    })
    
})




z.debtor.forEach(znet=>{
    f.debtor.forEach(fdebtor=>{
        if(fdebtor.name ==  znet.name){
znet.debtor= (  Number(fdebtor.debtor) + Number(znet.debtor))
        }
    })
})








if(f.sub_account4.length > 0){
   
    if(f.net[0].net > 0){

  this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,dark:1,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    })
    }

}else{
  f.debtor.forEach(fdebtor=>{
f.creditor.forEach(fcreditor=>{
    if(fcreditor.name == fdebtor.name){

f.net.forEach(enet=>{

    if(fcreditor.name == enet.name){
 if(( Number(fdebtor.debtor) -   Number(fcreditor.creditor)    ) > 0 ){
 enet.net =  ( Number(fdebtor.debtor) -   Number(fcreditor.creditor)    )
 }else{
enet.net =  (     Number(fcreditor.creditor)   - Number(fdebtor.debtor)     )


}




    }


})




    }

})


  })


 
if(f.net[0].net > 0){
     this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    })
}
     
}

z.debtor.forEach(zdebetor=>{
   z.creditor.forEach(zcreditor=>{
if(zcreditor.name == zdebetor.name){
z.net.forEach(znet=>{
    
    if(znet.name == zdebetor.name){
     if(( Number(zdebetor.debtor) -   Number(zcreditor.creditor)    ) > 0 ){
     znet.net =  (Number(zdebetor.debtor) - Number(zcreditor.creditor))

     }else{
          znet.net =   (Number(zcreditor.creditor) - Number(zdebetor.debtor))
     }
    }
    
})

}

   }) 
})



})


e.creditor.forEach(ecreditor=>{
   z.creditor.forEach(zcreditor=>{
if(zcreditor.name == ecreditor.name){

     ecreditor.creditor =  (Number(zcreditor.creditor) + Number(ecreditor.creditor))

    


}

   }) 
})














if(z.net[0].net > 0){
this.newdata.push({creditor:z.creditor,debtor:z.debtor,name:z.name,code:z.code,dark:1,level:z.level,
    
    creditor:z.creditor,debtor:z.debtor,net:z.net
    })

}

e.debtor.forEach(edebtor=>{
   z.debtor.forEach(zdebtor=>{
if(zdebtor.name == edebtor.name){

     edebtor.debtor =  (Number(zdebtor.debtor) + Number(edebtor.debtor))

    


}

   }) 
})


})


e.debtor.forEach(edebtor=>{
   e.creditor.forEach(ecreditor=>{
if(ecreditor.name == edebtor.name){
e.net.forEach(e=>{
    if(e.name == edebtor.name){
        if((Number(edebtor.debtor) - Number(ecreditor.creditor))   > 0)
        {
e.net =  (Number(edebtor.debtor) - Number(ecreditor.creditor)) 
        }else{
            e.net =  (Number(ecreditor.creditor) -  Number(edebtor.debtor) ) 
        }


    }

})
     
    


}

   }) 
})







if(e.net[0].net > 0){
this.newdata.push({creditor:e.creditor,debtor:e.debtor,name:e.name,code:e.code,dark:1,level:e.level,
    
    creditor:e.creditor,debtor:e.debtor,net:e.net
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

      creditor: function () {
     var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.creditor)    +    Number(sum))


}

    })

return sum

    },


net:function(){
 
  var sum = 0
    this.newdata.forEach(e=>{

if(e.level == 1   && e.dark == 1){

sum = (Number(e.net)    +    Number(sum))


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
},


"previous" :function (id){
this.ledgerurl()
},
"period" :function (id){
this.ledgerurl()
},


}		,   

    }
</script>