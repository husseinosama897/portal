<template>
<div class="row" >
 <div class="card  mt-3">
                                  <div class="card-body">
                                    <form class=" align-items-center">
                                        <div class="row ">
                                          
                                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-12">
                                                <label for="birthday">task</label>
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


     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                              
                              <a class="btn btn-primary" href="/managers/task/Create">

Create

</a>
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
                                            <tr v-for="(data,index) in datas.data "  :key="data.id">
                                      
                                                <td data-table="CODE">{{data.name}}</td>      
                                                <td data-table="DESCRIPTION">{{data.subject}}</td>                          
                                                <td data-table="start_at">{{data.start_at}}</td>
                                                     
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
  
      <a class="dropdown-item" :href="'/managers/task/editTask/'+data.id">update</a>
      <a class="dropdown-item" @click="dele(data,index)" >delete</a>
     

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
allerros:[],
}

        },

        methods:{
   onImageChange(e,data) {   
    console.log('hhhhhh')
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
    url:'/managers/task/delete/'+data.id,
    method:'post',
}).then(res=>{

this.$delete(this.datas.data, index)
})

      }
},
   

    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/JsonTaskData?page='+page,
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/managers/JsonTaskData' ,
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
     this.datajson()
        },
      
    }
</script>
