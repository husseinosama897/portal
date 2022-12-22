<template>
   <div >
      <div class="card">
<div class="card-body">
  <div class="row">
<div class="col-4">
  <label for="password" class="form-label">
    code
  </label>
  <input type="text" class="form-control input-default " v-model="code" placeholder="INV..">
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


</div>

</div>

    </div>

   <div class="row">
    

 
         <div class="card">
            <div class="card-body">

               <a class="btn btn-primary" href="/managers/invoice/create">

Create

</a>


               <div class="table-responsive">
                  <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                     <thead>
                        <tr>
                           <th><strong>Code</strong></th>
                           <th><strong>Date</strong></th>
                           <th><strong>Description</strong></th>
                           <th><strong>project</strong></th>
                           <th><strong>Vat</strong></th>
                           <th><strong>Total</strong></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                           <td data-table="CODE">{{data.code}}</td>
                           <td data-table="DATE">{{data.date}}</td>
                           <td data-table="DESCRIPTION">{{data.description}}</td>
                           <td data-table="porject" v-if="data.project">{{data.project.name}}</td>
                           <td data-table="porject" v-else>unknown</td>
                           <td data-table="VAT">{{data.vat}}</td>
                           <td data-table="TOTAL">{{data.total}}</td>
                           <td  data-table="ACTION">
                              <div class="dropdown">
                                 <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 ACTION
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    
                                    <a class="dropdown-item" :href="'/managers/invoice/edit/'+data.id">update</a>
                                  
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
   </div>
</template>
<script>
export default {
	
	data() {
		return {
			datas: {},
			allerros: [],
		date:'',
      code:'',
      project_id:'',
      projects:[],
		};
	},
	methods: {

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
				method: "post",
				url: "/managers/invoice/jsonInvoice?page=" + page,
            data:{
               date:this.date,
code:this.code, 
project_id:this.project_id
            }
			}).then(response => {
				this.datas = response.data.data;
			});
		},

		datajson() {
			axios({
				method: "post",
				url: "/managers/invoice/jsonInvoice",
            data:{
          date:this.date,
code:this.code, 
project_id:this.project_id
            }
			}).then(response => {
				this.datas = response.data.data;
			});
		},

		addproduct() {
			this.products.push({});
		},
		removeproduct(index) {
			this.products.splice(index, 1);
		},


	},
	mounted() {
		this.datajson();

      this.project()
	},


   watch:{
      "date":function(){
         this.datajson();
      },
      "project_id":function(){
         this.datajson();
      },
      "code":function(){
         this.datajson();
      }
   }
};
</script>
