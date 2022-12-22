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
{{data2.ref}}
        
                     </div>
         
          </div>
          <div class="mb-3 row align-items-center">
            <h1 class="title col-6 col-sm-1">Date</h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
         {{data2.date}}
        
                     </div>
  
          </div>

          <div class="mb-3 row align-items-center">
            <h1 class="title col-6 col-sm-1">created by </h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
         {{data2.user ? data2.user.name : data2.user_name}}
        
                     </div>
  
          </div>


          <div class="mb-3 row align-items-center">
            <h1 class="title col-6 col-sm-1">employee  </h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
         {{ data2.employee.name}}
        
                     </div>
  
          </div>


      
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">Subject</h1>
                     <span class="t-points">  : </span>
         
            <div class="col-8">
               <span class="text-decoration-underline fw-md">{{data2.subject}}</span>
            </div>
          </div>
         
    </div>
  
    <div class="subject mb-2 lh-base">
  {{data2.content}}
    </div>
    <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md">services : </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                     <th scope="col" class="fw-md fs-6" >No</th>
                    <th scope="col" class="fw-md fs-6">Description</th>
                    <th scope="col" class="fw-md fs-6">amount</th>
                    <th scope="col" class="fw-md fs-6">percentage</th>
                    <th scope="col" class="fw-md fs-6">employee_cost</th>
                  </tr>
              </thead>
              <tbody>
 <tr  v-for=" (product,index) in  data2.attributes" :key="product.id">
                            <td class="text-center fs-6">{{index + 1}}</td>
               <td class="text-center fs-6">{{product.item}}</td>
               <td class="text-center fs-6">{{product.amount}}</td>
                  <td class="text-center fs-6">{{product.percentage}}</td>
                  <td class="text-center fs-6">{{product.employee_cost}}</td>
                </tr>
                
                <tr>
                    <td colspan="4" class="text-center fs-6">Total Cost</td>
                    <td class="text-center fs-6">{{data2.total}}</td>
                </tr>
           
              </tbody>
        </table>
        </div>
    </div>
 
    
        <div class="qr row pt-4 pb-4">
        <div class="col-6">
          <qrcode-vue :value="this.route" size="90" level="L" />
        </div>
      
    </div>

 <div class="d-flex  row"
        >
              
        <div :key="data.id"  class="col-2"  v-for="data in data.service_cycle" >
                    
                           <template v-if="data.service_comment_cycle">
                                           <div class="col-2">
          <img :src="'/uploads/sign/'+data.service_comment_cycle.user.sign" alt="" width="80">
                                           </div>
                            </template>
                            
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

        props:['data','sign','route'],

        data(){
return{

project_id:1,
data2:this.data ?? '',
date:'',
subject:'',
order_for:'',
cc:'',
ref:'',

}

        },

        methods:{

              print () {
     
      this.$htmlToPaper('printMe');
	  console.log( this.$htmlToPaper('printMe'))
    },

 },
        mounted() {
          
                  if(Object.keys(this.data2).length > 0){

 this.data2 = this.data

}
       else{
        
          this.data2 =  this.$cookies.get('servicez');


       }
        },
  
    }
</script>
