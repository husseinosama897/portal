<template>
 
<div >
<div class="row" >
 <div class="card  mt-3">
                                  <div class="card-body">
                                    <form class=" align-items-center">
                                        <div class="row ">
                                          
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">ytask </label>
                                                <input   v-model="name" type="text" id="birthday" name="birthday" class="form-control">

                                            </div>

                                                  <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">dis </label>
                                                <input   v-model="dis" type="text" id="birthday" name="birthday" class="form-control">

                                            </div>
                                   

                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">from</label>
                                                <input  v-model="start_at"  type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label>to</label>
                                                <input v-model="expires_in"  type="date" id="birthday" name="birthday" class="form-control">

                                            </div>
                                       
                                           <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label>points</label>
                                                <input v-model="point"  type="text" id="birthday" name="birthday" class="form-control">
                                            </div>
                                       
                              
                                     
                                       </div>
                                    </form>
                                </div>
                                  </div>
  </div>

     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
        
                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>name</strong></th>
                                     
                                                <th><strong>DESCRIPTION</strong></th>
                          <th><strong>start_at</strong></th>
                            <th><strong>expires_in</strong></th>
                             <th><strong>point</strong></th>
                               <th><strong>status</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data "  :key="data.id">
                                      
                                                <td data-table="CODE">{{data.name }}</td>
                                          
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>
                                                        
                                                                                                            
                                                <td data-table="start_at" v-if="today > data.start_at ">{{data.start_at}}</td>
                                                  <td data-table="start_at" v-if="today < data.start_at "><span class="badge bg-warning border-0">Coming SOON</span></td>
                                                     

   <td data-table="expires_in">{{data.expires_in}}</td>
                                                     

                                                <td data-table="POINT">{{data.point}}</td>
                                                        
                                                     
                                                        

                         <td data-table="status" v-if=" data.status == 0  "><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="status" v-if=" data.status == 1  "><span class="badge bg-success border-0">processing</span></td>

                                                <td data-table="status" v-if=" data.status == 3  "><span class="badge bg-success border-0">closed</span></td>

                  <td data-table="status" v-if=" data.status == 2  "><span class="badge bg-danger border-0">rejected</span></td>

                             
                                                 <td  data-table="ACTION">
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

      <a class="dropdown-item" :href="'/task/editTask/'+data.id" >update</a>
    

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
  <h4 class="alert-heading">تم العمليه بنجاح !</h4>
  <p> لقد نجحت في بمكانك اللقاء نظره</p>
  <hr>
<input type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
</div>
      </div>
    </div>
  </div>


    <div id="deathEmployeeModal" class="modal fade" >
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
              </div>

</template>

<script>
  import moment from 'moment'

    export default {
   
        data(){
return{

datas:{},
   start_at:'',
   expires_in:'', 
    dis:'',
   point:'',
   name:'',
images:[],
today:'',
allerros:[],
}

        },

        methods:{
 

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
  method: 'post',
  url: '/task/JsonTaskData?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/task/JsonTaskData' ,
  data:{
    name:this.name,
    dis:this.dis,
      start_at:this.start_at,
   expires_in:this.expires_in, 
   point:this.point,
  }

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

 watch:{

"name":function(){
  this.datajson()
},
"expires_in":function(){
  this.datajson()
},
"start_at":function(){
  this.datajson()
},
"point":function(){
  this.datajson()
},
"dis":function(){
  this.datajson()
}

 },
        mounted() {
              this.today = moment().format('DD/MM/YYYY');
     this.datajson()
        },
      
    }
</script>
