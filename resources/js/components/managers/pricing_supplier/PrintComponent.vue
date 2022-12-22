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
          <div class="mb-3 row align-items-center">
            <h1 class="title col-4 col-sm-1">To</h1>
               <span class="t-points">  : </span>
            <div class="col-6 col-sm-4 fw-md">
                <span>{{data.to}}</span>
            </div>
          </div>
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">Subject</h1>
                     <span class="t-points">  : </span>
         
            <div class="col-8">
               <span class="text-decoration-underline fw-md">{{data.subject}}</span>
            </div>
          </div>
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">Project</h1>
       <span class="t-points">  : </span>
            <div class="col-8">
                <span class="text-decoration-underline fw-md" v-if="data.project">{{data.project.name }}</span>
            </div>
          </div>
    </div>
 
    <div class="subject mb-2 lh-base">
    {{data.order_for}}
    </div>
    <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md">MATERIALS : </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                  <th ><strong>No.</strong></th>
                    <th scope="col" class="fw-md fs-6">Description</th>
                    <th scope="col" class="fw-md fs-6">Qty</th>
                    <th scope="col" class="fw-md fs-6">Unit Price</th>
                    <th scope="col" class="fw-md fs-6">Amount (SAR)</th>
                  </tr>
              </thead>
              <tbody>
            
                <tr  v-for=" (product,index) in  data.attributes" :key="product.id">
                 <td class="text-center fs-6">{{index + 1}}</td>
                  <td class="text-center fs-6">{{product.pivot.dis ? product.pivot.dis : product.name }}</td>
                  <td class="text-center fs-6">{{product.pivot.qty ? product.pivot.qty : product.qty }}</td>
                  <td class="text-center fs-6">{{product.pivot.unit_price ? product.pivot.unit_price : product.unit_price}}</td>
                  <td class="text-center fs-6">{{product.pivot.total ? product.pivot.total :  product.pivot.unit_price * product.pivot.qty }}</td>
                </tr>
    
                <tr   v-for=" (product,index) in  data.attributes2" :key="product.id">
                     <td class="text-center fs-6">{{index + 1}}</td>
                  <td class="text-center fs-6">{{product.dis }}</td>
                  <td class="text-center fs-6">{{product.qty }}</td>
                  <td class="text-center fs-6">{{ product.unit_price}}</td>
                  <td class="text-center fs-6">{{ product.unit_price * product.qty }}</td>
                </tr>
           


                     <tr>
                    <td colspan="4" class="text-center fs-6"> VAT</td>
                    <td class="text-center fs-6">{{data.vat}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center fs-6">Total Cost</td>
                    <td class="text-center fs-6">{{data.total}}</td>
                </tr>
         
              </tbody>
        </table>
        </div>
    </div>
    <div class="endsub mt-1 mb-1">
        <p class="text-decoration-underline fw-md"> Payment Terms :</p>
        <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md">MATERIALS : </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                    <th scope="col">installment</th>
                            <th scope="col">percentage</th>
                            <th scope="col">value</th>
                            <th scope="col">Payment details</th>
                            <th scope="col"> date</th>

                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for=" note in data.note" :key="note.id">
                            
                            <td></td>
<td>{{note.name}}</td>

<td>{{note.percentage}}</td>


<td>{{note.amount}}</td>
<td>{{note.dis}}</td>
<td>{{note.date}}</td>
</tr>
                    </tbody>
                    </table>
                    </div>
                    </div>

    

    </div>
  <div class="row align-items-center">
   

      <div class="qr row pt-4 pb-4">
        <div class="col-6">
          <qrcode-vue :value="this.route" size="90" level="L" />
        </div>
          <div class="col-6 border">
       <div class="tab p-2">
           <h6 class="text-start">Accepted on behalf of M/s </h6>
       <div class="mb-1 row align-items-center">
            <h1 class="title col-3">Name</h1>
            <span class="t-points"> : </span>
            <div class="col-6 fw-bold">
                
            </div>
        </div>
        <div class="mb-1 row align-items-center">
            <h1 class="title col-3">Sign & Stamp</h1>
            <span class="t-points"> : </span>
            <div class="col-6 fw-bold">
          
            </div>
        </div>
        <div class="mb-1 row align-items-center">
            <h1 class="title col-3">Date</h1>
            <span class="t-points"> : </span>
            <div class="col-6 fw-bold">
              
            </div>
        </div>

      
     
       </div>
    </div>
     
         <div class="  row mt-3"
        >
              
        <div :key="data.id"  class="col-2" v-for="data in data.pricing_supplier_cycle" >
                                            <template  v-if="data.pricing_supplier_cycle && data.status == 1">
                                                    <div class="col-2">

                      <img :src="'/uploads/sign/'+data.pricing_supplier_cycle.user.sign" alt="" width="80">
                                        </div>
                                            </template>
                                                 <template  v-if="data.pricing_supplier_cycle && data.status == 2">
                                                    <div class="col-2">

                    <p class="text-danger">rejected</p>
                                        </div>
                                            </template>
       
        </div>
                
                                    
                                      
                       

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

        props:['data','sign','route'],
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
userz:[],

choice:[],
to:'',
transportation:'',
delivery_date:'',
material_avalibility:'',
subject:'',
images:[],
}

        },

        methods:{

              print () {
     
      this.$htmlToPaper('printMe');
	  console.log( this.$htmlToPaper('printMe'))
    },

                      onImageChange(e) {     
this.images.push(e.target.files[0])
            },

         deleteuser(index){
                this.userz.splice(index,1)
            }
,
takethischoice(user){
this.userz.push(user)
   this.choice.splice(0)
},

users(){
    this.choice.splice(0)
    axios({
        url:'/user/userautocomplete',
        method:'post',
        data:{
            name:this.cc
        }
    }).then(res=>{
        this.choice = res.data.data
    })
},
reset(){
    
this.quotation = '',
this.project_id = '',
this.products = [{}],
this.allerros = [],
this.payment = [{}],
this.date = '',
this.subject = '',
this.order_for = '',
this.cc = '',
this.ref = '',
this.userz = [],

this.choice = [],
this.to = '',
this.transportation= '',
this.delivery_date = '',
this.material_avalibility = '',
this.subject = ''
},


 },
        mounted() {
            console.log('Component mounted.')
        },
  
    }
</script>
