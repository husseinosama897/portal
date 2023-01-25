<template>
    <div >
 
 
       <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="card">
                   <div class="card-body">
              
                    <div class="table-responsive">
                                      <table class="table datatable-button-print-basic">
                                          <thead>
                                              <tr>
                                               
                                                  <th><strong>item</strong></th>
                                                  <th><strong>project</strong></th>
                                                  <th><strong>supplier</strong></th>
                                                

                                                  <th><strong>PAY</strong></th>
                                                  <th><strong>PAID</strong></th>
                                                  <th><strong>TOTAL</strong></th>

                                                   
                                                  <th>remaining amount</th>

                                                  <th  >action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr v-for="data in customising "  :key="data.id">
                                   


<td v-if="data.petty_cash">
  {{ data.petty_cash.ref     }}
</td>

<td v-if="data.purchase_order">
  {{ data.purchase_order.ref     }}
</td>



<td v-if="data.subcontractor">
  {{ data.subcontractor.ref     }}
</td>



<td v-if="data.purchase_order   ">
  {{ data.purchase_order.project ?  data.purchase_order.project.name : 'unknown'   }}
</td>


<td v-if="data.petty_cash    ">
  {{ data.petty_cash.project  ?  data.petty_cash.project.name : 'unknown'     }}
</td>

<td v-if="data.subcontractor    ">
  {{ data.subcontractor.project ?  data.subcontractor.project.name : 'unknown'     }}
</td>









<td >
{{ data.supplier ?  data.supplier.comp  :  data.supplier ? data.supplier.customer_name : 'unknown'  }}
</td>
 
  <td data-table="PAY">

<input class="form-control" v-model="data.pay">

  </td>

  <td data-table="Paid" v-if="data.purchase_order">

<input class="form-control" readonly :value="data.purchase_order.paid">

  </td>


  <td data-table="Paid" v-if="data.petty_cash">

<input class="form-control" readonly :value="data.petty_cash.paid">

  </td>

  
  <td data-table="Paid" v-if="data.subcontractor">

<input class="form-control" readonly :value="data.subcontractor.paid">

  </td>

  <td data-table="TOTAL">

    <input class="form-control" readonly   v-if="data.purchase_order" :value="data.purchase_order.total">

<input class="form-control"  v-if="data.petty_cash" readonly :value="data.petty_cash.total">


<input class="form-control"  v-if="data.subcontractor" readonly :value="data.subcontractor.total">

  </td>

  <td data-table="rest">

<input class="form-control" readonly :value="data.remaining_amount">

  </td>


  <td ><input type="file"  v-on:change="onImageChange(data,$event)" multiple class="form-control"></td>
                              
  <td >
    <a class="btn btn-danger" v-if="!data.deleted"  @click="deletefile(data)"   href="#"    >delete</a>
                             
                             
    
             

                             <a class="btn btn-primary" v-else  @click="restorefile(data)"   href="#"    >Restore</a>
          
                             <a class="btn btn-primary"  @click="preview(data)"   href="#"    >read attachments</a>
                           
  </td>
                  
                                              </tr>
                                  
                      
  
                                          </tbody>
                                      </table>
                                     
                                  </div>


               
                                  <div class="col" v-if="allowed == 1" >
               <div class="card">
                  <div class="card-header d-block">
                   
                     <p class="m-0 subtitle">Add <code>comments</code> and <code>attachments</code></p>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                 
                        <div class="col-xl-4 mb-2 mt-2">
                        <label for="password" class="col-sm">status</label>
                        <div class="form-group">
                           <select class="form-select select2" aria-label=".form-select-sm example" v-model="status">
                              <option value="1">Accept</option>
                              <option value="2">Reject</option>
                           </select>
                        </div>
                     </div>
                    </div>
                  </div>

               </div>
            </div>

                      </div>
                      </div>
                      <button class="btn btn-primary">submit</button>
                      </form>


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

                    
                                    
                             
                                            
                                            <a  :href="'/uploads/financial_report/'+data.ref+'/'+cycle.path" v-for="cycle in attachment" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
                                                file
                                                </span></a>
                                        
                                    
                         

   </div>
 </div>
</div>


                      </div>
                      </template>
                      <script
                      >

export default {
props:['data','allowed'],
        data(){
return{
item:[],
ref:'',
status:3,
attachment:[],
}
        }
        ,

        methods:{

          preview(attachment){
 this.attachment = attachment
 window.$("#preview").modal("show");
},

          onImageChange(data,e) {    
       data.file ?? Vue.set(data,'file',[])
   data.file.push(e.target.files[0])
           },
          deletefile(file){

Vue.set(file,'deleted',true)

         },

         restorefile(file){

           Vue.set(file,'deleted',false)

         },

submit(){

   let formData = new FormData();
this.item.forEach(e=>{

Vue.set(e,'files',e.file ? e.file.length : 0)
 e.file ? e.file.forEach((element, index, array) => {
   if(element !== undefined){

   formData.append('files-'+e.id, element);
   }
    
   })

   : ''


})

if(this.item){
   formData.append('attributes', JSON.stringify(this.item) );
   }

   if(this.status){
   formData.append('status',this.status);
   }

   if(this.total){
   formData.append('total',this.total);
   }
   


   axios.post('/managers/report/daily/financial/confirm/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})

.then(res=>{
   window.location.href = ('/managers/report/daily/financial')
})
}

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
       
        e.petty_cash ? e.petty_cash.total ?? e.petty_cash.expected_amount : e.subcontractor ? e.subcontractor.total : 0

         
        )  - Number(value) )
    })

    return this.item
    },

    total(){
      var total = 0
    this.item.forEach(e=>{
      
      total = ( Number(total) + Number(e.pay ))
      
     
    })

    return total
    }

},

        mounted() {
       
this.item = this.data.item
          },

    }
                    
                    
                    </script>