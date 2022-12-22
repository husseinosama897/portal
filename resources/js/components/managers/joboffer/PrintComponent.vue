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
      <h1 class="title col-6 col-sm-1">Career Section 
      </h1>
      
 
            <span class="t-points">  :  </span>
     <div class="col-6 col-sm-4">
{{data2.subject}}
  
               </div>
   
    </div>


    
    <div class="mb-3 row align-items-center">
      <h1 class="title col-6 col-sm-1">Dear Mr</h1>
    <span class="t-points">  :  </span>
     <div class="col-6 col-sm-4">
   {{data2.name}}
  
               </div>

    </div>

    <div class="mb-3 row align-items-center">
      <h1 class="title col-6 col-sm-1">work location</h1>
    <span class="t-points">  :  </span>
     <div class="col-6 col-sm-4">
   {{data2.work_location}}
  
               </div>

    </div>
    <div class="mb-3 row align-items-center">
      <h1 class="title col-6 col-sm-1">contract type</h1>
    <span class="t-points">  :  </span>
     <div class="col-6 col-sm-4">
   {{data2.contract_type}}
  
               </div>

    </div>
 
  
  
</div>



<div class="subject mb-2 lh-base">
{{data2.content}}
</div>




<div class="matrials">
  <p class="ms-5 text-decoration-underline fw-md">Salary & Benefits Details as the following: : </p>

  <ul>
    <template  v-for="(benefits,index) in data2.benefits"  >
<li v-if="index <= 3"  :key="benefits.id">
  
    {{benefits.item}}   : {{benefits.value}}
  


</li>
</template>
<li>salary package : {{data2.salary}}</li>

</ul>  

<ol>    <template  v-for="(benefits,index) in data2.benefits"  >
  <li  v-if="index >= 3" :key="benefits.id">

{{benefits.item}}   : {{benefits.value}}



</li>

</template>


</ol>  

</div>

<div class="matrials">
  <p class="ms-5 text-decoration-underline fw-md">conditions : </p>

  <ol>
<li  v-for="condition in data2.condition"  :key="condition.id" >{{condition.item}}</li>

</ol>  

</div>



<div class="subject mb-2 lh-base">
We are looking forward to you joining the company’s team and receiving
your acceptance of this offer and we wish you all success
</div>


<div class="qr row pt-4 pb-4">
        <div class="col-6">
          <qrcode-vue :value="this.route" size="90" level="L" />
        </div>
        
    </div>
<div class="d-flex  row"
  >
        
  <div  class="col-6"   >
              
                 
                                     <div class="col-6" v-if="data2.status == 1">
    <img src="/signature/signature.jpg" alt="" width="200">
                                     </div>
                      
                      
  </div>
          

  </div>

</div>    

</div>
</template>

<script>

export default {
  
  props:['route','data'],

  data(){
return{

data2:this.data,

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
    this.data2 =  this.$cookies.get('joboffer');


 }
  },



}
</script>
