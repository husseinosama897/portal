<template>
     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                              
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                             
                                           
                                                <th><strong>section</strong></th>
                                                <th><strong>action</strong></th>
                                          
                                          
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data " :key="data.id">
                                              
                                                <td data-table="Role">{{data.name}}</td>
                                                
                                                <td  data-table="ACTION">
                              <div class="dropdown">
                                 <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 ACTION
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" :href="'/managers/department/edit/'+data.id">update</a>
                                   
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
      
                  
                </div>

</template>

<script>
    export default {
  
        data(){
return{

datas:{},
allerros:[],
real_cycle:[

],

}

        },

        methods:{


    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/department/json?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson() {
		axios({
  method: 'post',
  url: '/managers/department/json' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


 

 },
        mounted() {
     this.datajson()
     this.updatedata() 
        },
    
    }
</script>
