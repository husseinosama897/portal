<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                    
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                                <th><strong>user</strong></th>
                                                <th><strong>project</strong></th>
                                                <th><strong>STATUS</strong></th>
                                           
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                                  <template v-if="data.employee">  
                                                <td data-table="CODE">{{data.employee.ref}}</td>
                                                <td data-table="DATE">{{data.employee.date}}</td>
                                                <td data-table="DESCRIPTION">{{data.employee.subject}}</td>
                                                <td data-table="user" v-if="data.employee.user" >{{data.employee.user.name}}</td>
                                                <td data-table="user" v-else>unknown</td>
                                                <td data-table="project" v-if="data.employee.project" >{{data.employee.project.name}}</td>
                                                <td data-table="user" v-else>unknown</td>
                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                   
                                                 <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/employeereturn/'+data.employee.id">preview</a>
      <a class="dropdown-item" :href="'/managers/update_employee/'+data.employee.id">update</a>
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
allerros:[],
}

        },

        methods:{

dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/user/delete_employee_data/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/returnjsonemployee?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'get',
  url: '/managers/returnjsonemployee/' ,

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
