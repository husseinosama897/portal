<template>
  <div >

            <div class="row" >
         <div class="col-6">
<div class="card">

   <div class="card-body" >
     
               <div class="table-responsive">
                 
                  <table class="table datatable-button-print-basic">
                     <thead>
                        <tr>
                        
                           <th><strong>ref</strong></th>
                       
                              <th>vat</th>
                                    <th>total</th>

                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="po in data" :key="po.id">
                          
                                     
                                                <td data-table="CODE">{{po.ref}}</td>
                                                <td data-table="DATE">{{po.date}}</td>
                                                <td data-table="DESCRIPTION">{{po.subject}}</td>
                                                 <td data-table="STATUS" v-if="po.status == 2"><button type="button"  class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh"> REJECTED</button></td>
                                                                 <td data-table="STATUS"  v-if="po.status == 1"><button type="button"   class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">ACCEPTED</button></td>
                                                                 <td data-table="STATUS" v-if="po.status == 0"><button type="button" class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">BENDING</button></td>
                                                <td data-table="VAT">{{po.vat}}</td>
                                                    <td data-table="TOTAL">{{po.total}}</td>
                                                <td  data-table="ACTION">
												
                    
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ACTION
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" :href="'/user/petty_cashreturn/'+po.id">preview</a>


  </div>
</div>
												</td>
                        </tr>
                     </tbody>
                  </table>
                
               </div>
          
       
       
        
      

        
         </div>
         </div>
         </div>
         
          <div class="col-6">
         <div class="card">

   <div class="card-body" >
     
    
        
        
           <apexchart type="bar" height="250" :options="chartOptions" :series="series"></apexchart>
       
     

        
         </div>
         </div>
       </div>
         </div>
       
 <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                           <h4 class="card-title">total amount with Vat : {{expenses}}</h4>
                     </div>
                  </div>
               </div>
            </div>
</div>


</template>
<script>
    export default {
       
        props:['data','expenses','budget_expenses'],
        data(){
return{

datas:{},
allerros:[],
name:'',
lat:'',
log:'',
updating:{},

           series: [
                    {  name: 'budget',
            data: [this.budget_expenses.petty_cash_budget]
          }, {
            name: 'expenses',
          data: [this.expenses]
          }, 

           ],

 
        chartOptions: {
            chart: {
              type: 'bar',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
              title: {
                text: '$ (thousands)'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return "$ " + val + " thousands"
                }
              }
            }
          },
          
          
          
}

        },

        methods:{

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
  method: 'get',
  url: '/admin/project_json?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                })
    },

    datajson(){
		axios({
  method: 'get',
  url: '/admin/project_json/' ,

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

if(this.lat){
	 formData.append('lat', this.lat);
}

if(this.log){
	 formData.append('log', this.log);
}

  
    axios.post('/admin/post_project',formData, {
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

if(this.updating.lat){
	 formData.append('lat', this.updating.lat);
}


  
if(this.updating.log){
	 formData.append('log', this.updating.log);
}

axios.post('/admin/update_project/'+this.updating.id,formData, {
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
},
 
 scaledata(){




 }
 },
        mounted() {
   this.scaledata()
        },
      
      
    

    }
</script>
