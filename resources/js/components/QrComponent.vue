<template>

  <div>
        
            <button   class="btn btn-light" v-print="'#printMe'">Print </button>


   <div class="container" id="printMe">

 <header >
  <img src="/img/275129174_711180993589195_571670907052531278_n.jpg"  style="height: 120px;" class="rounded d-block img-fluid" alt="Header">
</header>



<div class="details mt-2">
       
          <div class="mb-3 row align-items-center">
            <h1 class="title col-6 col-sm-1">Date</h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
            {{moment().format('MMMM Do YYYY, h:mm:ss a')}}
        
                     </div>
  
          </div>
     
    
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">Project</h1>
       <span class="t-points">  : </span>
            <div class="col-8">
                <span class="text-decoration-underline fw-md">{{project.name }}</span>
            </div>
          </div>
    </div>


<div class="row align-items-center">


<div class="qr row pt-4 pb-4">
  <div class="col-12">
   
  </div>
    <div class="col-12 border">
 <div class="tab p-2">

  <qrcode-vue :value="this.route" size="250" level="L" />

 </div>
</div>

   <div class="  row mt-3"
  >
        

          
                              
                                
                 

  </div>


</div>




</div>


</div>    

</div>
</template>

<script>
import QrcodeVue from 'qrcode.vue'
import moment from 'moment';
export default {
    components: {
QrcodeVue,
},

  props:['route','project'],
  data(){
return{
  moment: moment,
}

  },

  methods:{

        print () {

this.$htmlToPaper('printMe');
console.log( this.$htmlToPaper('printMe'))
},



},
  mounted() {
      console.log('Component mounted.')
  },

}
</script>
