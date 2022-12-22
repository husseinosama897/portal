<template>

  <div class="container">
        <section class="content">
            <div class="form-content">
                <form class="form" action="#" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                    <div class="form_row">
                        <label for="">من</label>
                        <div class="form_field ">
                            <div class="input-group mb-3">
                                <input type="date" 
                                v-model="from"
                                value="30-11-2021" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        
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

                  
                  
                  
                </form>
                <br>
            </div>


            <div class="inner-block-reports col-lg-12  col-md-10 col-md-offset-1 col-sm-12 col-xs-12 clearfix">
                <div class="reports-header text-center">
                    <h3>دفتر القيود</h3>
               
                    <h5>من <span>{{from}}</span> إلى <span>{{to}}</span></h5>
                </div>
                <div   v-for=" da in data" :key="da.id" class="table-responsive manage-currency-table reports-table">
                    <table class="table cf">
                        <thead class="cf">
                            <tr>
                                <th colspan="2"
                                
                                ><u><a href="/tenant/bills/1"
                                v-if="da.hide == 1"
                                >{{da.dis}}</a>

                                <a href="/tenant/bills/1"
                                v-else
                                >قيد يدوي</a>
                                
                                
                                </u></th>
                                <th>رقم القيد {{da.code}}</th>
                                <th>{{da.date}}</th>
                            </tr>
                            <tr>
                                <th>الحساب</th>
                                <th>مدين</th>
                                <th>دائن</th>
                                <th>التعليقات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-if="da.debtor_sub_account3">
                                <td
                              
                                
                                ><a class=""  key="
                                 " >{{da.debtor_sub_account3.code}} - {{da.debtor_sub_account3.name}} <span> ({{da.debtor_sub_account3.code}})</span></a></td>

                                                              <td
                                                              
                                                              v-if="da.debtor_sub_account4"
                                                              ><a class=""  key="
                                " >{{da.debtor_sub_account4.code}} - {{da.debtor_sub_account4.name}} <span> ({{da.debtor_sub_account4.code}})</span></a></td>

                                <td><a >{{da.value}} ر.س</a></td>
                                <td></td>
                                <td></td>
                            </tr>
                                <tr  v-if="da.debtor_sub_account4">
                                <td
                              
                                
                                ><a class=""  key="
                                 " >{{da.debtor_sub_account4.code}} - {{da.debtor_sub_account4.name}} <span> ({{da.debtor_sub_account4.code}})</span></a></td>

                                             
                                <td><a >{{da.value}} ر.س</a></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr
                            >
                                <td v-if="da.creditor_sub_account3"
                                
                                ><a class=""
                                >{{da.creditor_sub_account3.code}} - {{da.creditor_sub_account3.name}} <span> {{da.creditor_sub_account3.code}}</span></a></td>
                                
                                <td v-if="da.creditor_sub_account4"
                                
                                ><a class=""
                                >{{da.creditor_sub_account4.code}} - {{da.creditor_sub_account4.name}} <span> {{da.creditor_sub_account4.code}}</span></a></td>
                                <td></td>
                                <td><a>{{da.value}} ر.س</a></td>
                                <td></td>
                            </tr>
                          
                            <tr class="reports-total">
                                <td data-title="Account">    </td>
                                <td data-title="Debit">{{da.value}} ر.س</td>
                                <td data-title="Credit">{{da.value}} ر.س</td>
                                <td data-title="comment"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

               <div   v-for=" da in entry_manual_account" :key="da.id" class="table-responsive manage-currency-table reports-table">
                    <table class="table cf">
                        <thead class="cf">
                            <tr>
                                   <th colspan="2"
                                
                                ><a href="/tenant/bills/1"
                               
                                >{{da.dis}}</a>
                                </th>

                                <th>رقم قيد يدوي {{da.code}}</th>
                                <th>{{da.date}}</th>
                            </tr>
                            <tr>
                                <th>الحساب</th>
                                <th>مدين</th>
                                <th>دائن</th>
                                <th>التعليقات</th>
                            </tr>
                        </thead>
                        <tbody>
                                   <tr  v-if="da.sub_account3">
                                   
                                <td><a class=""  key="
                                 " >{{da.sub_account3.code}} - {{da.sub_account3.name}} <span> ({{da.sub_account3.code}})</span></a></td>

                                              <td></td>
                                <td><a    >{{da.value}} ر.س</a></td>
                                <td></td>
                                <td></td>
                            </tr>
                       

                            <tr  v-for="entry in  da.entry_manual_account" :key="entry.id">
    
                                <td
                               v-if="entry.sub_account3" 
                                ><a class=""  key="
                                 " >{{entry.sub_account3.code}} - {{entry.sub_account3.name}} <span> ({{entry.sub_account3.code}})</span></a></td>  



                                <td
                                v-if="entry.sub_account4"
                                ><a class=""  key="
                                 " >{{entry.sub_account4.code}} - {{entry.sub_account4.name}} <span> ({{entry.sub_account4.code}})</span></a></td>  

                           


      <td
     v-if="entry.creditor_sub_account4" 
      ><a class=""  key="
                                 " >{{entry.creditor_sub_account4.code}} - {{entry.creditor_sub_account4.name}} <span> ({{entry.creditor_sub_account4.code}})</span></a></td>  
   
                                <td
                               v-if="entry.creditor_sub_account3" 
                                ><a class=""  key="
                                 " >{{entry.creditor_sub_account3.code}} - {{entry.creditor_sub_account3.name}} <span> ({{entry.creditor_sub_account3.code}})</span></a></td>  


                                <td><a  v-if="entry.sub_account3 || entry.sub_account4 ">{{entry.value}} ر.س</a></td>
                                <td v-if="entry.creditor_sub_account4 || entry.creditor_sub_account3 ">{{entry.value}}</td>
                                <td v-else></td>
                                <td></td>
                            </tr>
                         
                            <tr class="reports-total">
                                <td data-title="Account">    </td>
                                <td data-title="Debit">
                                    {{da.total}} ر.س
                                </td>
                                <td data-title="Credit">{{da.total}} ر.س</td>
                                <td data-title="comment"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
  
   
            
                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">تصدير</button>
                  
                </div>
            </div>



        </section>
    </div>

</template>

<script>
    export default {
  mounted() {
this.ledgerurl()
this.ledgerurl2()
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
	'url':'/managers/easy_restriction_json',
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
       ledgerurl2(){
axios({
	method:'post',
	'url':'/managers/manule_entry_json',
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

                  this.newdata
.push(e[n])
                     })

                 }



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

    

      entry_manual_account: function () {
    
    this.newdata.forEach(z=>{
z.total = 0
  z.entry_manual_account.forEach(e=>{
if(e.debtor_account3_id || e.debtor_sub_account4_id){
z.total = (Number(z.total) + Number(e.value))

}


    })
    }
    )
  

return this.newdata

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
this.ledgerurl2()
},
"to" :function (id){
this.ledgerurl()
this.ledgerurl2()
}
}		,   

    }
</script>