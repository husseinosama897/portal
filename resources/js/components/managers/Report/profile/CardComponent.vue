<template>
    <div>
      <!-- ROW-1 OPEN -->
  <div class="row" id="user-profile">
   <div class="col-2">
    <button   class="btn btn-light" v-print="'#printMe'">Print </button>

   </div>
    


    <div class="row" id="printMe">
        <div class="row justify-content-center">
        <div class="col-4" >
        <div class="card">
                    <div class="card-header">
                        <div class="card-title">

                            <img src="/img/275129174_711180993589195_571670907052531278_n.jpg"  style="height: 120px;" class="rounded d-block img-fluid" alt="Header">
            
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="avatar avatar-xxl bradius cover-image"  v-if="data.image"  :data-bs-image-src="'/uploads/images/users/'+data.image"></span>
                        <span class="avatar avatar-xxl bradius cover-image"  v-else data-bs-image-src="/uploads/image/391529-PCODOG-695.jpg"></span>
                        <hr>
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                               name
                            </div>
                            <div>
                                <strong>{{data.name }} </strong>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                                <span><i class="fe fe-briefcase fs-20"></i></span>
                            </div>
                            <div>
                                <strong>{{data.role ?  data.role.name : '' }} </strong>
                            </div>
                        </div>
       


                 

                        <div class="qr row pt-4 pb-4">
        <div class="col-6">
          <qrcode-vue :value="this.url" size="90" level="L" />
        </div>
   
     
   
    
    </div>
      




                    </div>
                </div>
            </div>

        </div>
    
    </div>






          
        </div>
    </div>
    <!-- COL-END -->


</template>

<script>
import QrcodeVue from 'qrcode.vue'
export default {
    components: {
      QrcodeVue,
    },
props:['data','url'],
    data(){
        return {

        }
    },

    methods:{
        print () {
     
     this.$htmlToPaper('printMe');

   },

    }
}
</script>

