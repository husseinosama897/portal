<template>
<div>
   
           
          
             <div class="card-header">

               contractors
             </div>
              <div class="row">

             
                <div class="col-6">
    <ul class="list-group">
  <li class="list-group-item">contractor :  {{data.comp  }} </li>

  <li class="list-group-item">phone :  {{data.phone  }} </li>

  <li class="list-group-item"> address :  {{data.address  }} </li>

  <li class="list-group-item"> country :  {{data.country  }} </li>

  <li class="list-group-item"> total :  {{data.cws_sum_total  }} </li>

    </ul>
    




              </div>

                <div class="col-6">
         
                  <div class="card ">
                  <div class="card-body">

                    <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                     
                                             
                                                 <th><strong>total</strong></th>
                                    
                                                <th><strong>STATUS</strong></th>
                                        
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in data.cws "  :key="data.id">

                                                <td data-table="CODE">{{data.ref}}</td>
                                                <td data-table="DATE">{{data.date}}</td>
                                                   
                                       <td data-table="total" >{{data.total}}</td>

                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>

                                                 <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    
      <a class="dropdown-item" :href="'/managers/update_CWS/'+data.id">update</a>
    

      <a class="dropdown-item" :href="'/managers/preview_CWS/'+data.id">preview</a>
    

      


  </div>
</div>
												</td>
                    
                                            </tr>
								
					

                                        </tbody>
                                    </table>
                                   
                                </div>

                </div>
                </div>
              </div>

     
           
            </div>
            <div class="row">



<div class="col-6">
  <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">

                          <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
<th>file</th>
<th>preview</th>
<th>download</th>
                          </tr>
                          </thead>

                          <tbody>
                            <tr v-for="cycle in data.file" :key="cycle.id" >
                              <td>{{cycle.path}}</td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/contractor/'+cycle.path"   download >download</a></td>

                            </tr>
                          </tbody>
                          </table>

                        
                        </div>
                     </div>
                     </div>

</div>

<div class="modal fade bd-example-modal-xl"  id="preview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
  <div class="modal-dialog modal-xl" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
    <div class="modal-content" style="overflow-y: auto; 
      
      height: auto;
  height: 100vh;
  border-radius: 0;
  border: none; 

      ">
      <iframe :src="'/uploads/contractor/'+path" style="width: 100%; height: 100%"  class="embed-responsive-item" title="Iframe Example"></iframe> 
    </div>
  </div>
</div>

</div>




     
  </div>
</template>

<script>
    export default {
      props:['data'],
  mounted() {


  },
          data() {
    return {

      path:'',
    }

          },


          methods:{

            preview(path){
  this.path = path
  window.$("#preview").modal("show");
},

          }








    }
</script>
