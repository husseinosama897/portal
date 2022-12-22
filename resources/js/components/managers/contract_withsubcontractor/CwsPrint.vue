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
   
  
    <div class="mb-2 row align-items-center">
      <h1 class="title col-4 col-sm-1">Project</h1>
 <span class="t-points">  : </span>
      <div class="col-8">
          <span class="text-decoration-underline fw-md" v-if="data2.project">{{data2.project.name }}</span>
      </div>
    </div>
</div>

<div class="matrials">
  <p class="ms-5 text-decoration-underline fw-md">conditions : </p>
  <div class="table-responsive-sm">
  <table class="table table-bordered border-primary mb-2">
      <thead>
          <tr class="fw-md">

               <th scope="col" class="fw-md fs-6" >No</th>

              <th scope="col" class="fw-md fs-6">condition</th>
            </tr>
        </thead>
        <tbody>
<tr  v-for=" (condition,index) in  data2.condition" :key="condition.id">
                      <td class="text-center fs-6">{{index + 1}}</td>
                      <td class="text-center fs-6">{{condition.condition}}</td>
          </tr>
        </tbody>
  </table>
  </div>
</div>

<div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md">conditions : </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                    <th scope="col" class="fw-md fs-6" >No</th>
                    <th scope="col" class="fw-md fs-6">Description</th>
                    <th scope="col" class="fw-md fs-6">Qty</th>
                    <th scope="col" class="fw-md fs-6">unit</th>
                    <th scope="col" class="fw-md fs-6">Unit Price</th>
                    <th scope="col" class="fw-md fs-6">Amount (SAR)</th>
                    
                  </tr>
              </thead>
              <tbody>
                <tr  v-for=" (product,index) in  scaling" :key="product.id">
                            <td class="text-center fs-6">{{index + 1}}</td>
                <td class="text-center fs-6">{{product.name ? product.name : product.dis }}</td>
                  <td class="text-center fs-6">{{product.expctedqty}}</td>
                  <td class="text-center fs-6">{{product.unit}}</td>
                  <td class="text-center fs-6">{{product.unit_price}}</td>
                  <td class="text-center fs-6">{{product.total}}</td>

                </tr>
                <tr>
                    <td colspan="5" class="text-center fs-6">Total Cost</td>
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
        
  <div :key="data.id"  class="col-2"  v-for="data in data2.contract_withsubcontractor_cycle" >
              
                     <template v-if="data.comment_contract_withsubcontractor_cycle">
                                     <div class="col-2">
    <img :src="'/uploads/sign/'+data.comment_contract_withsubcontractor_cycle.user.sign" alt="" width="80">
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

quotation:'',
project_id:1,
products:[{}],
allerros:[],
payment:[{}],
data2:this.data,
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
            if(Object.keys(this.data2).length > 0){

this.data2 = this.data

}
 else{
    this.data2 =  this.$cookies.get('petty');


 }
  },

  
  computed:{

scaling(){
var data =[]

this.data2.attributes.forEach(e=>{

            data.push({name: e.name ? e.name : e.dis ,  
               unit:e.unit,
              unit_price:e.unit_price,
              expctedqty:e.expctedqty,
              total:e.expctedqty * e.unit_price
            })
})

return data
}

  }


}
</script>
