<template>
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <button type="button" @click="create()" class="btn btn-primary">
                  create
                  </button>
                  <table class="table datatable-button-print-basic">
                     <thead>
                        <tr>
                       
                           <th><strong>name</strong></th>
                                 <th><strong>budget</strong></th>
                                   <th><strong>expenses</strong></th>
                                     <th><strong>Net profit</strong></th>

                                   


                            <th><strong>project</strong></th>
                          
             
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(data) in datas.data "  :key="data.id">
                       
                           <td data-table="name">{{data.name}}</td>
                             <td data-table="budget" >{{data.budget}}</td>
                                 <td data-table="budget" >{{data.expenses}}</td>
                                   <td data-table="Net profit" >{{data.budget  - data.expenses}}</td>
  <td data-table="project" v-if="data.project">{{data.project.name}}</td>
                 
                        </tr>
                     </tbody>
                  </table>
                  <pagination :data="datas" @pagination-change-page="getResults"></pagination>
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
name:'',
project_id:'',
projects:[],
lat:'',
log:'',
updating:{},
}

        },

        methods:{
         

                             getCostCenterSelectBoxwithoutprameter(){
   
   axios({
   url:'/getCostCenterSelectBoxwithoutprameter',
   method:'get',
   }).then(res=>{
   
   	 if(Array.isArray(res.data.data)){
    
   
                   res.data.data.forEach(n=>{
                        n.forEach(z=>{
   this.cost_center.push(z)
                   })
                       })
                }else{
   
   let vm = []
   
                  Object.keys(res.data.data).map((n)=>{
   
               this.cost_center.push(res.data.data[n])
                    })
   
                }
   
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

create(){
  window.$("#adz").modal("show"); 
},

open(data){

this.updating = data
  window.$("#deathEmployeeModal").modal("show"); 

},
dele(data,index){

      if(confirm("Do you really want to delete?")){

axios({
    url:'/admin/delete_project/'+data.id,
    method:'post',
}).then(res=>{
this.datas.data.splice(index,1)
 
})

      }
},
    getResults(page = 1) {
		axios({
  method: 'post',
  url: '/jsoncostcenter?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'post',
  url: '/jsoncostcenter' ,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },


submit(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.name){
	 formData.append('name', this.name);
}

if(this.budget){
	 formData.append('budget', this.budget);
}

if(this.project_id){
	 formData.append('project_id', this.project_id);
}

  
    axios.post('/recordcostcenter',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
      
       this.datas.data.push(res.data.data)
     
 window.$("#adz").modal("hide"); 
    })
},
submit1(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();


if(this.updating.name){
	 formData.append('name', this.updating.name);
}

if(this.updating.project_id){
	 formData.append('project_id', this.updating.project_id);
}


  
if(this.updating.budget){
	 formData.append('budget', this.updating.budget);
}

axios.post('/costcenterupdate/'+this.updating.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
       this.name = ''
             window.$("#deathEmployeeModal").modal("hide"); 

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
     this.project()
     this.getCostCenterSelectBoxwithoutprameter()
        },
      
    }
</script>
