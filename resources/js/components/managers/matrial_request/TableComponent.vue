<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                    
                           
                           <a href="/managers/workflowmatrial_request" class="btn btn-primary" >

Setting

</a>

                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                             
                                                <th><strong>STATUS</strong></th>
                                                <th><strong>USER</strong></th>
                                                <th><strong>PROJECT</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.matrial_request">  
                                                <td data-table="CODE">{{data.matrial_request.ref}}</td>
                                                <td data-table="DATE">{{data.matrial_request.date}}</td>
                                                <td data-table="DESCRIPTION">{{data.matrial_request.subject}}</td>
                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="USER" v-if="data.matrial_request.user" >{{data.matrial_request.user.name}}</td>
                                                <td  v-else>UNKNOWN</td>
                                                    <td data-table="TOTAL"   v-if="data.matrial_request.project" >{{data.matrial_request.project.name}}</td>
                                                    <td  v-else >UNKNOWN</td>
                                                 <td  data-table="ACTION">
												
                                                  
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/matrial_requestreturn/'+data.matrial_request.id">preview</a>
      <a class="dropdown-item" :href="'/managers/update_matrial/'+data.matrial_request.id">update</a>

      <a class="dropdown-item" @click="forwardToPo(data.matrial_request.id)" href="#">forwardToPo</a>
      
      <a class="dropdown-item" @click="forwardToPetty_cash(data.matrial_request.id)" href="#">forwardToPC</a>
      
      


    <a class="dropdown-item" @click="dele(data,index)"  href="#">delete</a>

  </div>
</div>
												</td>
                        </template>
                                            </tr>
								
					

                                        </tbody>
                                    </table>
                                      <pagination :data="datas" @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg"  id="preview" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <img src="/Tiny.jpg" class="img-fluid" alt="Responsive image">

    </div>
  </div>
</div>
				
            
       


    <div id="deathEmployeeModal" class="modal fade"   >
    <div class="modal-dialog ">
      <div class="modal-content" style="overflow:auto;">
     
      <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading"> فشلت العمليه  !</h4>
  <p>    :  لقد فشلت العمليه للاسباب التاليه </p>
    <p v-for="(err,index)  in allerros" :key="index"> {{err}}</p>
  <hr>


<input type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
</div>
      </div>
    </div>

              
                
                   </div>
                  
                </div>

</template>

<script>
    export default {
        props:['matrial_request'],
        data(){
return{

datas:{},
allerros:[],
}

        },

        methods:{
           
          forwardToPetty_cash(id){
            axios({
              method:'post',
              url:'/managers/forwardToPetty_cash/'+id,
            }).then(res=>{
              window.$("#preview").modal("show");
            })
          },

          forwardToPo(id){
            axios({
              method:'post',
              url:'/managers/forwardToPo/'+id,
            }).then(res=>{
              window.$("#preview").modal("show");
            })
          },
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_matrial_request_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/returnjsonmatrial?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'get',
  url: '/managers/returnjsonmatrial/' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },



addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 
 addpayment(){
    this.payment.push({})
},
removepayment(index){
this.payment.splice(index,1)
}
 
 },
        mounted() {
     this.datajson()
        },
        computed:{
                totalAmount: function () {
                  var sum = 0;
if(this.products.length > 0){
   this.products.forEach(e=>{
if( ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) > 0){
sum =  ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) 
}else{
    sum = (Number(0) + Number(sum))
}


                 
                 })

}

return sum
    },
                    Vat: function () {
                  var sum = 0;
sum = (Number(15) * Number(this.totalAmount) / Number(100)) ?? 0

return sum
    },
        }
    }
</script>
