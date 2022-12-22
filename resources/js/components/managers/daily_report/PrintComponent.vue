<template>

        <div>
               <button   class="btn btn-light" v-print="'#printMe'">Print </button>


         <div class="container"  id="printMe">

               <header dir="ltr"  >
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
            <h1 class="title col-6 col-sm-1">التاريخ</h1>
          <span class="t-points">  :  </span>
           <div class="col-6 col-sm-4">
         {{data2.date}}
        
                     </div>
  
          </div>
          <div class="mb-3 row align-items-center">
            <h1 class="title col-4 col-sm-1">عدد العمال</h1>
               <span class="t-points">  : </span>
            <div class="col-6 col-sm-4 fw-md">
                <span>{{data2.number_of_staff}}</span>
            </div>
          </div>

          <div class="mb-3 row align-items-center">
            <h1 class="title col-4 col-sm-1"> مكان العمل </h1>
               <span class="t-points">  : </span>
            <div class="col-6 col-sm-4 fw-md">
                <span>{{data2.workplace}}</span>
            </div>
          </div>

          <div class="mb-3 row align-items-center">
            <h1 class="title col-4 col-sm-1">  مشرف العمل  </h1>
               <span class="t-points">  : </span>
            <div class="col-6 col-sm-4 fw-md">
                <span>{{data2.supervisor.name}}</span>
            </div>
          </div>


          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">نطاق العمل </h1>
                     <span class="t-points">  : </span>
         
            <div class="col-8">
               <span class="text-decoration-underline fw-md">{{data2.The_scope_of_work}}</span>
            </div>
          </div>
          <div class="mb-2 row align-items-center">
            <h1 class="title col-4 col-sm-1">المشروع</h1>
       <span class="t-points">  : </span>
            <div class="col-8">
                <span class="text-decoration-underline fw-md" v-if="data2.project">{{data2.project.name }}</span>
            </div>
          </div>
    </div>
  
   
    <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md"> :الانتجايه اليوميه </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                     <th scope="col" class="fw-md fs-6" >م</th>
                    <th scope="col" class="fw-md fs-6">بيان</th>
                    <th scope="col" class="fw-md fs-6">العدد</th>
                    <th scope="col" class="fw-md fs-6">الوحده</th>
                   
                  </tr>
              </thead>
              <tbody>
 <tr  v-for=" (product,index) in  data2.daily_productivity" :key="product.id">
                            <td class="text-center fs-6">{{index + 1}}</td>
               <td class="text-center fs-6">{{product.item }}</td>
                  <td class="text-center fs-6">{{product.quantity}}</td>
                  <td class="text-center fs-6">{{product.unit}}</td>
                 
                </tr>


           
              </tbody>
        </table>
        </div>
    </div>

    <div class="matrials">
        <p class="ms-5 text-decoration-underline fw-md"> : العماله </p>
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                     <th scope="col" class="fw-md fs-6" >م</th>
                    <th scope="col" class="fw-md fs-6">الاسم</th>
                    <th scope="col" class="fw-md fs-6">الالتزام</th>
                    <th scope="col" class="fw-md fs-6">الاداء</th>
                   
                  </tr>
              </thead>
              <tbody>
 <tr  v-for=" (user,index) in  data2.users" :key="user.id">
                            <td class="text-center fs-6">{{index + 1}}</td>
               <td class="text-center fs-6">{{user.name }}</td>
                  <td class="text-center fs-6">{{user.pivot.commitment}}</td>
                  <td class="text-center fs-6">{{user.pivot.performance}}</td>
                 
                </tr>


           
              </tbody>
        </table>
        </div>
    </div>

    <div class="matrials">
    
        <div class="table-responsive-sm">
        <table class="table table-bordered border-primary mb-2">
            <thead>
                <tr class="fw-md">
                     <th scope="col" class="fw-md fs-6" >ملاحظات و اقترحات و مشاكل</th>
                  </tr>
              </thead>
              <tbody>
 <tr  >
                            <td class="text-center fs-6">{{data2.note}}</td>
         
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
     
        <div :key="data.id"  class="col-2"  >
                    
                           <template v-if="data.status == 1">
                                           <div class="col-2">
          <img :src="'/uploads/sign/'+sign.sign" alt="" width="80">
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

 
 },
        mounted() {
                  if(Object.keys(this.data2).length > 0){

 this.data2 = this.data

}
       else{
          this.data2 =  this.$cookies.get('petty');


       }
        },
  
    }
</script>
