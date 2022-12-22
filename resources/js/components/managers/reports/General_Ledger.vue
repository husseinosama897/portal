<template>


    <div class="container">
        <section class="content">
            <div class="form-content">
                <form class="form" action="#" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                    <div class="form_row">
                        <label for="">من</label>
                        <div class="form_field ">
                            <div class="input-group mb-3">
                                <input type="date" v-model="from" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                           
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
                 
                        <a  @click="reset()" class="btn ledgerurls-reset-btn">
                            <i   class="fa fa-undo"></i>إعادة تعيين
                        </a>
                    </div>
                </form>
                <br>



                <div class="reports-checkbox">
                    <input id="ytd_balance" type="checkbox" name="ytd">
                    <label class="form-checkbox" for="ytd_balance"> عرض صافي الحركة للسنة المالية بتاريخ الرصيد الختامي</label>
                </div>

            </div>
            <div class="reports-header text-center">
                <h3>ملخص دفتر الأستاذ</h3>
           
                <h5>
                    من <span>{{from}}</span> إلى <span>{{to}}</span>
                </h5>
            </div>

            <table class="table table-responsive ">
                <thead class="cf">
                    <tr>
                        <th colspan="3">الحساب</th>
                      
                        <th>مدين</th>
                        <th>دائن</th>
                        <th>صافي الحركة</th>
                     
                    </tr>
                </thead>
                <tbody>
                    
                
                 
                    <tr v-for="(data,index) in newdata" :key="index" v-bind:class="{ dark_row:data.dark == 1 }">
                        <td data-title="Account" colspan="3" :class="'padleftindex-'+data.level">
                            <a :class="'padding-'+data.code" href="#">{{data.name}}  -  {{data.code}}</a>
                        </td>
                  
                        <td data-title="Debit">
                            <a href="#"> {{data.debtor}} </a>
                        </td>
                        <td data-title="Credit">
                            <a :href="'/report/Account_Summary/'+data.level+'/'+data.id"> {{data.creditor}}  ر.س</a>
                        </td>
                        <td data-title="Net Movement">  {{ data.net }}  ر.س</td>
                    
                    </tr>
             
           
                
                   
                    <tr class="reports-total">
                        <td data-title="Account" colspan=" 3">
                            المجموع
                        </td>
                      
                        <td data-title="Debit">
                           {{depetor}} ر.س
                        </td>
                        <td data-title="Credit">
                            {{creditor}} ر.س
                        </td>
                        <td data-title="Net Movement">
                            {{net}} ر.س
                        </td>
               
                    </tr>
                </tbody>
            </table>

            <div class="report-bottom">



                <a  class="send">
        تصدير دفتر الأستاذ بالتفصيل إلى Excel
</a>



          

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


reset(){

 this.to = moment().format("YYYY-MM-DD")
 this.from = moment().subtract(1, 'years').format("YYYY-MM-DD")
}   ,  

       

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
    
    creditor:0,debtor:0,net:0
    })
e.creditor = 0
e.debtor = 0

e.net = 0

e.subaccount1.forEach(z=>{
  this.newdata.push({name:z.name,code:z.code,id:z.id,level:z.level,creditor:0,debtor:0})
z.creditor = 0
z.debtor = 0
z.net = 0
  z.sub_account3.forEach(f=>{

 f.creditor  = 0
f.debtor = 0   
f.net = 0  
 if(f.sub_account4.length > 0){
  this.newdata.push({name:f.name,code:f.code,id:f.id,level:f.level,creditor:0,debtor:0})
 }

if(f.sub_account4.length > 0){


 f.sub_account4.forEach(g=>{

g.creditor  = 0
g.debtor = 0
g.net = 0


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


g.net = ( Number(g.debtor) -   Number(g.creditor)   +  Number(g.net)  )

f.creditor = (Number(g.creditor)   +  Number(f.creditor)   )  

f.debtor = (Number(g.debtor)   +  Number(f.debtor)   ) 

 f.net = (Number(f.net)   +  Number(g.net)   ) 


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

z.creditor = (Number(z.creditor) + Number(f.creditor))

z.debtor = (  Number(f.debtor) + Number(z.debtor))




if(f.sub_account4.length > 0){
  this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,dark:1,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    })
}else{
    if(( Number(f.debtor) -   Number(f.creditor)    ) > 0 ){
 f.net =  ( Number(f.debtor) -   Number(f.creditor)    )



}else{
 f.net =  (     Number(f.creditor)   - Number(f.debtor)     )


}

      this.newdata.push({creditor:f.creditor,debtor:f.debtor,name:f.name,code:f.code,level:f.level,
    
    creditor:f.creditor,debtor:f.debtor, net:f.net
    })
}


})

z.net = (  Number(z.debtor) - Number(z.creditor))  > 0 ?  (  Number(z.debtor) - Number(z.creditor)) :


(    Number(z.creditor) - Number(z.debtor)) 


e.debtor = (Number(z.debtor) + (e.debtor))

e.creditor = (Number(z.creditor) + (e.creditor))





this.newdata.push({creditor:z.creditor,debtor:z.debtor,name:z.name,code:z.code,dark:1,level:z.level,
    
    creditor:z.creditor,debtor:z.debtor,net:z.net
    })

})


e.net = (  Number(e.debtor) - Number(e.creditor))  > 0 ?  (  Number(e.debtor) - Number(e.creditor)) :


(    Number(e.creditor) - Number(e.debtor)) 

this.newdata.push({creditor:e.creditor,debtor:e.debtor,name:e.name,code:e.code,dark:1,level:e.level,
    
    creditor:e.creditor,debtor:e.debtor,net:e.net
    })



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
}
}		,   

    }
</script>
