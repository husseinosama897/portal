<template>
  <div >
    <div class="card">
<div class="card-body">
  <div class="row">
<div class="col-4">
  <label for="password" class="form-label">
    PO
  </label>
  <input type="text" class="form-control input-default " v-model="ref" placeholder="to">
</div>

<div class="col-4">
  <label for="password" class="form-label">
   date 
  </label>
  <input type="date" class="form-control input-default " v-model="date" placeholder="to">
</div>



<div class="col-4">
  <label for="password" class="form-label">
    project  
  </label>
  <select  class="form-select select2" v-model="project_id">
    <option ></option>
  <option v-for="proj in projects"  :value="proj.id" :key="proj.id">{{proj.name}}</option>
  </select>
</div>

<div class="col-4">
  <label for="password" class="form-label">
    user  
  </label>
  <select  class="form-select select2" v-model="user_id">
    <option ></option>
  <option v-for="user in users" :value="user.id" :key="user.id">{{user.name}}</option>
  </select>
</div>



</div>

</div>

    </div>

     <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                    <a href="/managers/workflowpetty_cash" class="btn btn-primary" >

                      Setting

                    </a>
                    <a href="/managers/Export/petty_cash" class="btn btn-primary" >

export 

</a>

                                <div class="table-responsive">
                                    <table class="table datatable-button-print-basic">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>CODE</strong></th>
                                                <th><strong>DATE</strong></th>
                                                 <th><strong>User</strong></th>
                                                <th><strong>DESCRIPTION</strong></th>
                                                      
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
                                                  <template v-if="data.petty_cash">  
                                                <td data-table="CODE">{{data.petty_cash.ref}}</td>
                                                <td data-table="DATE">{{data.petty_cash.date}}</td>
                                                                              <td data-table="USER" v-if=" data.petty_cash.user ">{{data.petty_cash.user.name}}</td>
                                                <td data-table="DESCRIPTION">{{data.petty_cash.subject}}</td>
                        <td data-table="Delivery feedback" v-if=" data.petty_cash.closed !== '1'  "><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="Delivery feedback" v-if=" data.petty_cash.closed == '1'  "><span class="badge bg-success border-0">closed</span></td>

                                                        <td data-table="Attachment" > 
                                                             <input type="file" v-if="data.petty_cash.closed !== '1'   "   v-on:change="onImageChange($event,data.petty_cash)" >
                                                      
                                                    </td>

                                                <td data-table="STATUS" v-if="data.status == 2"><span class="badge bg-danger border-0" >REJECTED</span></td>
                                                <td data-table="STATUS"  v-if="data.status == 1"><span class="badge bg-success border-0">ACCEPTED</span></td>
                                                <td data-table="STATUS" v-if="data.status == 0"><span class="badge bg-warning border-0">BENDING</span></td>
                                                <td data-table="VAT">{{data.petty_cash.vat}}</td>
                                                    <td data-table="TOTAL">{{data.petty_cash.total}}</td>
                                                 <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/managers/petty_cashreturn/'+data.petty_cash.id">preview</a>
      <a class="dropdown-item" :href="'/managers/update_petty_cash/'+data.petty_cash.id">update</a>
    
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
				
				
        
                </div>
</div>
</template>

<script>
    export default {
      
        data(){
return{

datas:{},
allerros:[],
images:[],
projects:[],
date:'',
users:[],
project_id:'',
user_id:'',
ref:'',
}

        },

        methods:{
          user(){
    
    axios({
        url:'/CHunking_user',
        method:'get',
    }).then(res=>{
        
         
         
    
                        res.data.data.forEach(n=>{
                          if(Array.isArray(n)){
                             n.forEach(z=>{
    this.users.push(z)
                        })
                      }    else{
    
    let vm = []
    
                       Object.keys(n).map((z)=>{
    
                    this.users.push(n[z])
                         })
    
                     }
                            })
                 
    
    })
    },

          project(){
    
    axios({
        url:'/selectproject',
        method:'get',
    }).then(res=>{
        
      res.data.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
this.projects.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

                this.projects.push(n[e])
                     })

                 }
                        })
   
    })
    },


          getResults(page = 1) {
		axios({
  method: 'post',
  url: '/managers/returnjsonpetty_cash?page=' + page,
  data:{
  ref:this.ref,
date:this.date,

project_id:this.project_id,
user_id:this.user_id,

}
})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/managers/returnjsonpetty_cash' ,
  data:{
  ref:this.ref,
date:this.date,
project_id:this.project_id,
user_id:this.user_id,

}

})		.then(response => {
                    
              this.datas =  response.data.data
            
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

 axios.post('/managers/inv_petty_cash/'+data.id,formData, {
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
this.data.data.splice(index,1)
this.$delete(this.data.data,index)
 
})

      }
},




 

 
 },
        mounted() {
     this.datajson()
     this.user()
     this.project()
        },

        watch:{
          'ref':function(){
            this.datajson()
          } ,
'date':function(){
            this.datajson()
          } ,

'project_id':function(){
            this.datajson()
          } ,
'user_id':function(){
            this.datajson()
          } ,

        }
      
    }
</script>
