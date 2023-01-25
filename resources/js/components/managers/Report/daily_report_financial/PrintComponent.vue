<template>

        <div>
            	
                  <button   class="btn btn-light" v-print="'#printMe'">Print </button>


         <div class="container" id="printMe">

       <header >
        <img src="/img/275129174_711180993589195_571670907052531278_n.jpg"  style="height: 120px;" class="rounded d-block img-fluid" alt="Header">
    </header>
    
  <div class="details mt-2">
        <div class="mb-2 row align-items-center">
            <h1 class="title col-6 col-sm-1">Ref 
            </h1>
            
       
                  <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
{{data.ref}}
        
                     </div>
         
          </div>
          <div class="mb-3 row align-items-center">
            <h1 class="title col-6 col-sm-1">Date</h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
         {{data.date}}
        
                     </div>
  
          </div>
       
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">Subject</h1>
                     <span class="t-points">  : </span>
         
            <div class="col-8">
               <span class="text-decoration-underline fw-md">daily payment list</span>
            </div>
          </div>
        
    </div>
 

    <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md">payment : </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
               
            
                    <th   scope="col" class="fw-md fs-6">item</th>
                                                  <th  scope="col" class="fw-md fs-6" >supplier</th>
                                                

                                                  <th  scope="col" class="fw-md fs-6">PAY</th>
                                                  <th  scope="col" class="fw-md fs-6">PAID</th>
                                                  <th  scope="col" class="fw-md fs-6">TOTAL</th>

                                                   
                                                  <th  scope="col" class="fw-md fs-6">remaining amount</th>

                  </tr>
              </thead>
              <tbody>
            
           

             
              
                <tr v-for="data in customising "  :key="data.id">
                                   


                                   <td v-if="data.petty_cash"
                                   
                                   class="text-center fs-6"
                                   >
                                     {{ data.petty_cash.ref     }}
                                   </td>
                                   
                                   <td v-if="data.purchase_order"
                                   
                                   class="text-center fs-6"
                                   >
                                     {{ data.purchase_order.ref     }}
                                   </td>
                                   
                                   
                                   
                                   <td v-if="data.subcontractor"
                                   class="text-center fs-6"
                                   >
                                     {{ data.subcontractor.ref     }}
                                   </td>
                                   
                                   
                                   
                                   <td v-if="data.purchase_order  &&   data.purchase_order.project  "
                                   
                                   class="text-center fs-6"
                                   >
                                     {{ data.purchase_order.project     }}
                                   </td>
                                   
                                   
                                   <td v-if="data.petty_cash  &&   data.purchase_order.petty_cash  "
                                   
                                   class="text-center fs-6"
                                   >
                                     {{ data.petty_cash.project     }}
                                   </td>
                                   
                                   <td v-if="data.subcontractor  &&   data.purchase_order.subcontractor  "
                                   class="text-center fs-6"
                                   
                                   >
                                     {{ data.subcontractor.project     }}
                                   </td>
                                   
                                   
                             
                                   
                                   
                                   
                                   <td v-else>
                                     unknown
                                   </td>
                                   
                                   
                                   
                                   
                                   <td v-if="data.supplier"
                                   class="text-center fs-6"
                                   >
                                   {{ data.supplier.comp ?  data.supplier.comp : data.supplier.supplier_name }}
                                   
                                
                            
                                </td>
                                <td v-else>
                                     unknown
                                   </td>
                                                
                                     <td data-table="PAY" class="text-center fs-6" >
                                   
                              
                                   <p   v-if="data.pay"  >{{ data.pay }}</p>
                                   

                                     </td>
                                   
                                     <td data-table="Paid"  class="text-center fs-6" v-if="data.purchase_order">
                              
                                   <p   v-if="data.purchase_order"  >{{ data.purchase_order.paid }}</p>
                                   

                                     </td>
                                   
                                   
                                     <td data-table="Paid" class="text-center fs-6"  v-if="data.petty_cash">
                                   
                                 
                                   <p   v-if="data.petty_cash"  >{{ data.petty_cash.paid }}</p>
                                   
                                     </td>
                                   
                                     
                                     <td data-table="Paid"  class="text-center fs-6" v-if="data.subcontractor">
                                   
            
                                   <p   v-if="data.subcontractor"  >{{ data.subcontractor.paid }}</p>
                                   
                                     </td>
                                   
                                     <td data-table="TOTAL" class="text-center fs-6" >
                                   
                                     
                                       <p   v-if="data.purchase_order"  >{{ data.purchase_order.total }}</p>
                                   
                                   
                                   <p   v-if="data.petty_cash"  >{{ data.petty_cash.total }}</p>
                                   

                                   
                                   <p   v-if="data.subcontractor"  >{{ data.subcontractor.total }}</p>
                                   
                                     </td>
                                   
                                  
                                   
                                   
                                                     
                                                                                 </tr>

                <tr>
                    <td colspan="4" class="text-center fs-6">Total Cost</td>
                    <td class="text-center fs-6">{{data.total}}</td>
                </tr>
         
              </tbody>
        </table>
        </div>
    </div>

  <div class="row align-items-center">
   

      <div class="qr row pt-4 pb-4">
        <div class="col-6">
          <qrcode-vue :value="this.route" size="90" level="L" />
        </div>
    

    
    </div>
    

  

    </div>
    

</div>    

</div>
</template>

<script>
import QrcodeVue from 'qrcode.vue'
    export default {
          components: {
      QrcodeVue,
    },

        props:['data','route'],
        data(){
return{

quotation:'',
project_id:1,
products:[{}],
allerros:[],
payment:[{}],
date:'',
subject:'',
order_for:'',
cc:'',
ref:'',

item:[],
}

        },

        methods:{

              print () {
     
      this.$htmlToPaper('printMe');

    },



 
 },
     
 computed:{
    customising(){
    this.item.forEach(e=>{
        var value = Number(
          e.purchase_order ? e.purchase_order.paid   : 
      
        e.petty_cash ? e.petty_cash.paid :  
        
        e.subcontractor ? e.subcontractor.paid  : 0
        
        ) + Number(e.pay)
        e.remaining_amount = (  Number(e.purchase_order ? e.purchase_order.total :
       
        e.petty_cash ? e.petty_cash.total  ?? e.petty_cash.expected_amount : e.subcontractor ? e.subcontractor.total : 0

         
        )  - Number(value) )
    })

    return this.item
    },
 },
 mounted() {
       
       this.item = this.data.item
                 },
  
    }
</script>
