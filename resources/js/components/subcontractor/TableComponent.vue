<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                              <th><strong>ref</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>invoice #</strong></th>

                                                <th><strong>DESCRIPTION</strong></th>
                                             
                                                <th><strong>STATUS</strong></th>
                                                <th><strong>VAT</strong></th>
                                                <th><strong>TOTAL</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr v-for="data in datas.data" :key="data.id">
                                            <td data-table="CODE">{{data.ref}}</td>
                                            <td data-table="DATE">{{data.date}}</td>
                                            <td data-table="invoice #">{{data.invoice_ON }}</td>
                                           
                                            <td data-table="DESCRIPTION">{{data.subject}}</td>





                                            
                                            <td data-table="STATUS" v-if="data.status == 2">
                                              <button type="button"  @click="syc(data.subcontractor)"  class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh"> REJECTED</button>
                                            </td>
                                            <td data-table="STATUS"  v-if="data.status == 1">
                                              <button type="button"  @click="syc(data.subcontractor)" class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">ACCEPTED</button>
                                            </td>
                                            <td data-table="STATUS" v-if="data.status == 0">
                                              <button type="button"   @click="syc(data.subcontractor)"  class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">BENDING</button>
                                            </td>
                                            <td data-table="VAT">{{data.vat}}</td>
                                            <td data-table="TOTAL">{{data.total}}</td>
                                            <td  data-table="ACTION">
                                                <div class="dropdown">
                                                  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  ACTION
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" :href="'/user/subcontractorreturn/'+data.id">preview</a>

                                                      <a class="dropdown-item" v-if="data.status == 2" :href="'/user/subcontractor/updatepage/'+data.id">update</a>

                                                      <a class="dropdown-item" @click="dele(data,index)"  href="#">delete</a>
                                                  </div>
                                                </div>
                                            </td>
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
                                     <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="hhh" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
    </div>
  </div>
</div>
                </div>

</template>

<script>
export default {
props:['id'],
data(){
return{
datas:{},
allerros:[],
real_cycle:[
  {step:1,name:'Projects Director' ,class:2},
  {step:2,name:"General Manager",class:3},
  {step:3,name:'Financial manager',class:4},
  
],
}
},

methods:{
syc(cycle){

this.real_cycle.forEach(e=>{
cycle.forEach(z=>{

if(z.role.name == e.name){
  console.log(z)
  if(z.status == 1){
 Vue.set(e,'status',1)
  }
   if(z.status == 2){
 Vue.set(e,'status',2)
  }
   if(z.status == 0){
 Vue.set(e,'status',0)
  }
 
}

})


})

},


dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_contractora_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/user/returnsubcontractorasjson/'+ this.id +' ?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson() {
		axios({
  method: 'get',
  url: '/user/returnsubcontractorasjson/'+ this.id ,

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
