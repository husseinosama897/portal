<template>

    <div>
              <button   class="btn btn-light" v-print="'#printMe'">Print </button>

     <div class="container" id="printMe">
<header >
    <img src="/img/275129174_711180993589195_571670907052531278_n.jpg"  style="height: 120px;" class="rounded d-block img-fluid" alt="Header">
</header>


<div class="matrials">
    <p class="ms-5 text-decoration-underline fw-md">subcontractor : </p>
    <div class="table-responsive-sm">
    <table class="table table-bordered border-primary mb-2">
        <thead>
            <tr class="fw-md">
            
                <th scope="col" class="fw-md fs-6">REF</th>
                <th scope="col" class="fw-md fs-6">DATE</th>
                <th scope="col" class="fw-md fs-6">STATUS</th>
                <th scope="col" class="fw-md fs-6">USER</th>
                <th scope="col" class="fw-md fs-6">PROJECT</th>
                <th scope="col" class="fw-md fs-6">VAT</th>
                   <th scope="col" class="fw-md fs-6">TOTAL </th>
         
              </tr>
          </thead>
          <tbody>
        
            <tr  v-for=" subcontractor in  scailing" :key="subcontractor.id">
           
              <td class="text-center fs-6">{{subcontractor.ref}}</td>
              <td class="text-center fs-6">{{subcontractor.date}}</td>
              <td class="text-center fs-6" v-if="subcontractor.status == 1">accepted</td>
              <td class="text-center fs-6" v-if="subcontractor.status == 2">rejected</td>
              <td class="text-center fs-6" v-if="subcontractor.status == 0">binding</td>
              <td class="text-center fs-6" v-if="subcontractor.user">{{subcontractor.user.name}}</td>
              <td class="text-center fs-6" v-else>unknown</td>
              <td class="text-center fs-6" v-if="subcontractor.project">{{subcontractor.project.name}}</td>
              <td class="text-center fs-6" v-else>unknown</td>
               <td class="text-center fs-6">{{subcontractor.vat}}</td>
              <td class="text-center fs-6">{{subcontractor.total }}</td>
            </tr>
            
     
      
          </tbody>
    </table>
    </div>
</div>


</div>    

</div>
</template>

<script>

export default {

    props:['data'],

    data(){
return{



}

    },

    methods:{

          print () {
 
  this.$htmlToPaper('printMe');

},











},

computed:{

    scailing(){
        var data2 = []
       this.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
data2.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

            data2.push(n[e])
                     })

                 }
                        })
     
                        return data2

    }
 

},
 
mounted(){
this.print()
}

}
</script>
