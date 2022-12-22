<template>
  <div class="container">

        <section class="content" id="account-summary">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-wraper" action="/tenant/reports/general_ledgers/no_id/account_summary" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
                    <div class="form-content">
                        <div class="form_row">
                            <div class="form_field account_field">
                                                                   <span class="form-select" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

    <span class=" col-form-label col-form-label-sm text-end">
{{account.name}}
  </span>



</span>




  <ul dir="rtl" class="dropdown-menu dropdown-menu-large"  style="height: 200px; width:25%;overflow-y:scroll; overflow-x: hidden;   text-align: start !important;
  float: right !important;
  left: initial !important;
  right: 0 !important;
  
  " aria-labelledby="dropdownMenuButton1">
  <li    >  <input type="text" class="form-control" v-model="searchQuery2" > </li>

 
    <ul  dir="rtl" >
       <ul v-for=" t in accounts"  :key="t.id">
 
       
       <li >
<a @click="updateaccount4(t)"  class="dropdown-item" href="#">{{t.name}}</a>
         </li>

<li   v-for="u in t.subaccount1" :key="u.id"  >
<a @click="updateaccount4(u)" class="dropdown-item" href="#">{{u.name}} - {{u.code}}</a>

<ul dir="rtl"
>
<li   v-for="z in u.sub_account3" :key="z.id"   ><a @click="updateaccount4(z)"  class="dropdown-item" href="#">{{z.name}} - {{z.code}}</a>
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
                   

                          <div class="form_row">
                        <label for="">من</label>
                        <div class="form_field ">
                            <div class="input-group mb-3">
                                <input type="date" 
                                v-model="from"
                                value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1"/>
                             
                            </div>


                        </div>
                    </div>
                    <div class="form_row">
                        <label for="">إلى</label>
                        <div class="form_field ">
                            <div class="input-group mb-3">
                                <input type="date" 
                                

v-model="to"
                                 class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            
                            </div>


                        </div>
                    </div>

                        <a style="margin-right: -15px;" class="btn products-reset-btn" href="/tenant/reports/general_ledgers/reset_session?form=ledger_summary">
                            <i class="fa fa-undo"></i>إعادة تعيين
                        </a>
                    </div>

                </form>
            </div>
        </section>

        <section class="content" id="account-summary-pdf">

            <div id="chartContainer2" data-highcharts-chart="0">
              
 <apexchart v-if="newdata.net" type="line" height="350" :options="chartOptions" :series="series"></apexchart>

                <div class="inner-block-reports col-md-6 col-md-offset-3 col-sm-12 col-xs-12 clearfix" style="margin: 10px auto;">
                    <div class="reports-header text-center">
                        <h3> ملخص الحساب {{account.name}}- {{account.code}}</h3>
                   
                        <h5>من <span>{{from}} </span> إلى <span> {{to}} </span></h5>
                    </div>
                    <div class="table-responsive manage-currency-table reports-table">
                        <table class="table cf table-bordered">
                            <tbody>
                                <tr>
                                    <th>شهر</th>
                                    <th class="amount">فعلي</th>
                                </tr>

                            </tbody>
                            <tbody>
                                <tr v-for="(data,index) in newdata.net" :key="index" >
                                    <td data-title="Account"> 

                                        {{ data.name | moment(" MMMM  YYYY") }}
                                    </td>
                                    <td data-title="Opening Balance">
                                        <a href="/tenant/reports/general_ledgers/4?from=2021-07-01&amp;to=2021-07-31">{{data.net}} ر.س</a></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="report-bottom">

                        <div class="dropdown pull-right">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">تصدير
                    <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/tenant/reports/general_ledgers/no_id/account_summary.xlsx"><img src="/assets/Exel_icon.png"> اكسل</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="return xepOnline.Formatter.Format('bla', {render:'download', filename:'Account_Summary_wkf_kndl_sd_2021-07-01_To_2022-01-31'})"><img src="/assets/pdf_Icon.png"> PDF</a>
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
  import moment from 'moment'
    export default {
props:['account'],
  mounted() {
 this.from = moment().format("YYYY-MM-DD")
 this.to = moment().format("YYYY-MM-DD")
this.allaccount()

  },
          data() {
    return {
              series: [{
          name: "data",
              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
              }



          ],
      chartOptions: {
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            title: {
              text: 'Product Trends by Month',
              align: 'left'
            },
            grid: {
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
          },
          
          
 type:'',
  name:'',
  array:[],
code:'',
group:'',
measuring:'',
account:{},
data:{},
barcode:'',
to:'',
searchQuery2:'',
from:'',
 dis:'',
buy_price:'',
ulz2:[],
editz:{},
selectedlevel:'',
searchname:'',
supplier_address:'',
code:'',
place:'',
supplier_address:''

,
newdata:{},
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

     allaccount(){
axios({
	method:'get',
	'url':'/allaccount'
}).then(res=>{

	this.ulz2 = res.data.data
})
},
updateaccount4(acc){
this.account = {}

this.account = acc



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
           this.array = []
         
            const monthDifference = moment(new Date(this.to)).diff(new Date(this.from), 'months', true);
            console.log(monthDifference)
         for (let countyear = 0; countyear < monthDifference; countyear++) {
     

this.array.push(moment(this.to).subtract(countyear, 'months').format("YYYY-MM-DD"))
           


           

           
        
         }

axios({
	method:'post',
	'url':'/ledger2',
  data:{
from:
moment(this.from).format("YYYY-MM-DD"),
to:moment(this.to).format("YYYY-MM-DD"),
level:this.account.level,
account:this.account.id
  }
}).then(res=>{
this.newdata = []
this.data = res.data.data.accountbank

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
Vue.set(z,'creditor',[])
Vue.set(z,'debtor',[])
Vue.set(z,'net',[])

  
for (let index = 0; index < this.array.length; index++) {

z.creditor.push({ name:this.array[index] , creditor:0  })

z.debtor.push({ name:this.array[index] , debtor:0  })


z.net.push({ name:this.array[index] , net:0  })

}
  z.sub_account3.forEach(f=>{
Vue.set(f,'creditor',[])
Vue.set(f,'debtor',[])
Vue.set(f,'net',[])
for (let index = 0; index < this.array.length; index++) {


f.creditor.push({ name:this.array[index] , creditor:0  })

f.debtor.push({ name:this.array[index] , debtor:0  })



f.net.push({ name:this.array[index] , net:0  })

}



if(f.sub_account4.length > 0){


 f.sub_account4.forEach(g=>{

Vue.set(g,'creditor',[])
Vue.set(g,'debtor',[])
Vue.set(g,'net',[])


for (let index = 0; index < this.array.length; index++) {

g.creditor.push({ name:this.array[index] , creditor:0  })

g.debtor.push({ name:this.array[index] , debtor:0  })



g.net.push({ name:this.array[index] , net:0  })

}




if(g.manule_creditor_sub_account4.length > 0){
  g.manule_creditor_sub_account4.forEach(manule_creditor4=>{

g.creditor.forEach(creditortest=>{
if(   moment(new Date(manule_creditor4.date)).format("YYYY-MM")  ==     moment(new Date(creditortest.name)).format("YYYY-MM") ){
creditortest.creditor = (Number(creditortest.creditor)   + Number(manule_creditor4.value) )

}


})

     })
}





if(g.manule_debtor_sub_account4.length > 0){

      g.manule_debtor_sub_account4.forEach(manule_debtor4=>{

g.debtor.forEach(debtortest=>{
if(   moment(new Date(manule_debtor4.date)).format("YYYY-MM")  ==   moment(new Date(debtortest.name)).format("YYYY-MM") ){
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
if(fcreditortest.name == creditortest.name    ){
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



 if(g.name == this.account.name){

this.newdata = g

 

}


  


})







}
   

if(f.manule_creditor_sub_account3.length > 0){

f.manule_creditor_sub_account3.forEach(e=>{
 f.creditor.forEach(fcreditortest=>{
if(  moment(new Date(e.date)).format("YYYY-MM")  ==      moment(new Date(fcreditortest.name)).format("YYYY-MM") ){
    fcreditortest.creditor  = (Number(e.value) + Number(fcreditortest.creditor))
}
})

})

}

if(f.manule_debtor_sub_account3.length > 0){

f.manule_debtor_sub_account3.forEach(e=>{
 f.debtor.forEach(fdebtortest=>{

if(   moment(new Date(e.date)).format("YYYY-MM") ==   moment(new Date(fdebtortest.name)).format("YYYY-MM") ){
    fdebtortest.debtor  = (Number(e.value) + Number(fdebtortest.debtor))
}
 })

})

}

if(f.manule_creditor.length > 0){

f.manule_creditor.forEach(e=>{
 f.creditor.forEach(fcreditortest=>{
if(  moment(new Date(e.date)).format("YYYY-MM")  ==   moment(new Date(fcreditortest.name)).format("YYYY-MM") ){
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
   
 

 if(f.name == this.account.name){
     
  this.newdata = {creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,dark:1,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    }
 
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


 

     if(f.name == this.account.name){
     
     this.newdata = {creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    }
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















     if(z.name == this.account.name){
     
this.newdata = {creditor:z.creditor,debtor:z.debtor,name:z.name,code:z.code,dark:1,level:z.level,
    
    creditor:z.creditor,debtor:z.debtor,net:z.net
    }
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
e.net =  (Number(edebtor.debtor) - Number(ecreditor.creditor))

    }

})
     
    


}

   }) 
})








  
     if(e.name == this.account.name){
this.newdata = {creditor:e.creditor,debtor:e.debtor,name:e.name,code:e.code,dark:1,level:e.level,
    
    creditor:e.creditor,debtor:e.debtor,net:e.net
    }
     

     
}





})
if(this.newdata.net){
    this.series[0].data.splice(0)
    this.chartOptions.xaxis.categories.splice(0)
    this.newdata.net.forEach(net=>{

        this.series[0].data.push(net.net)
        
         this.chartOptions.xaxis.categories.push(
         moment(net.name).format("MMMM  YYYY")
         )
    })


   
}

})




},



},computed: {
    

  

 

 accounts: function () {
       if(this.searchQuery2){
           var value = ''





     

    







if(value.length == 0){
   this.ulz2.forEach(e=>{
   e.subaccount1.forEach(z=>{
  if(value.length == 0){
    value = z.sub_account3.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
   })
  
    
   
    
})




}


if(value.length == 0){

   this.ulz2.forEach(e=>{
   e.subaccount1.forEach(z=>{

       z.sub_account3.forEach(a=>{
if(value.length == 0){
    value = a.sub_account4.filter((item)=>{
 return   item.name.startsWith(this.searchQuery2);
    })
       }
       })
  
   })
  
    
   
    
})



}



      return value
      
      
    
      }else{
        return this.ulz2;
      }
    
    },
 
},
watch:{
"from" :function (id){
this.ledgerurl()
},
"to" :function (id){
this.ledgerurl()
},
"account" :function (id){
this.ledgerurl()
}
}		,   

    }
</script>
