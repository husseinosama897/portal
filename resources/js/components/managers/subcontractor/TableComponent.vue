<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                              
                              <a href="/managers/workflowsubcontractor" class="btn btn-primary" >
Setting
</a>

<a href="/managers/Export/subcontractor" class="btn btn-primary" >

export 

</a>

                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>invoice #</strong></th>
                                                
                                                <th><strong>DESCRIPTION</strong></th>
                                                <th><strong>CONTRACTOR</strong></th>
                                             
      <th><strong>Delivery feedback</strong></th>
                                               <th><strong>Attachment</strong></th>

                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.subcontractor_real">  
                                                <td data-table="CODE">{{data.subcontractor_real.ref}}</td>
                                               
                                                <td data-table="DATE">{{data.subcontractor_real.date}}</td>
                                                <td data-table="invoice #">{{data.subcontractor_real.invoice_ON }}</td>
        <td data-table="USER" v-if=" data.subcontractor_real.user ">{{data.subcontractor_real.user.name}}</td>
                                                <td data-table="DESCRIPTION">{{data.subcontractor_real.subject}}</td>
                                                <td data-table="CONTRACTOR"  v-if="data.subcontractor_real.contract_withsubcontractor && data.subcontractor_real.contract_withsubcontractor.contractor" >{{data.subcontractor_real.contract_withsubcontractor.contractor.contractor_name}}</td>
                                                        
                                                <td data-table="CONTRACTOR" v-else >unknown</td>

                                                        <td data-table="Delivery feedback" v-if=" data.subcontractor_real.closed !== '1'  "><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="Delivery feedback" v-if=" data.subcontractor_real.closed == '1'  "><span class="badge bg-success border-0">closed</span></td>

                                                        <td data-table="Attachment" > 
                                                             <input type="file" v-if="data.subcontractor_real.closed !== '1'   "   v-on:change="onImageChange($event,data.subcontractor_real)" >   
                                                    </td>

                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="VAT">{{data.subcontractor_real.vat}}</td>
                                                    <td data-table="TOTAL">{{data.subcontractor_real.total}}</td>
                                                 <td  data-table="ACTION">
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/subcontractor_requestreturn/'+data.subcontractor_real.id">preview</a>
      <a class="dropdown-item" :href="'/managers/update_subcontractor/'+data.subcontractor_real.id">update</a>
      <a class="dropdown-item"   href="#" @click="pay(data.subcontractor_real)"> forward to daily report</a>
    
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
				
				
         
                                                  <div id="adz" class="modal fade " style="overflow:auto;">
    <div class="modal-dialog ">
      <div class="modal-content" style="overflow:auto;">
                <button style="color:black" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color:black" aria-hidden="true">&times;</span>
        </button>
     
      <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">???? ?????????????? ?????????? !</h4>
  <p> ?????? ???????? ???? ???????????? ???????????? ????????</p>
  <hr>
<input type="button" class="btn btn-dark" data-dismiss="modal" value="??????????">
</div>
      </div>
    </div>
  </div>


    <div id="deathEmployeeModal" class="modal fade" >
    <div class="modal-dialog ">
      <div class="modal-content" style="overflow:auto;">
     
      <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading"> ???????? ??????????????  !</h4>
  <p>    :  ?????? ???????? ?????????????? ?????????????? ?????????????? </p>
    <p v-for="(err,index)  in allerros" :key="index"> {{err}}</p>
  <hr>


<input type="button" class="btn btn-dark" data-dismiss="modal" value="??????????">
</div>
      </div>
    </div>

              
                
                   </div>
                  
                </div>

</template>

<script>
    export default {
        props:['subcontractor'],
        data(){
return{

datas:{},
images:[],
allerros:[],
}

        },

        methods:{

          pay(subcontractor){
    
    let formData = new FormData();
 
 if(subcontractor.id){
 formData.append('subcontractor_id', subcontractor.id);
 }

 formData.append('type','SI');




 axios.post('/managers/report/daily/financial/insert',formData, {
                 headers: {
                     'Content-Type': 'multipart/form-data' },
 })
 .then(res=>{
  window.$("#succ").modal("show");
  })

  },

   onImageChange(e,data) {   
   
            this.images.splice(0)   
this.images.push(e.target.files[0])

   let formData = new FormData();

if(this.images){
	 formData.append('count', this.images.length);
}

this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });

 axios.post('/managers/inv_subcontractor_request/'+data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
Vue.set(data,'closed',1)
     })


            },

dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_subcontractor_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
   

    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/returnjsonsubcontractor?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'get',
  url: '/managers/returnjsonsubcontractor/' ,

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
      
    }
</script>
