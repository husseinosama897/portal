<template>
    <div >
      <div class="card">
  <div class="card-body">
    <div class="row">
  <div class="col-4">
    <label for="password" class="form-label">
      name
    </label>
    <input type="text" class="form-control input-default " v-model="name" placeholder="Ahmed..">
  </div>

  <div class="col-4">
    <label for="password" class="form-label">
supervisor    </label>
    <input type="text" class="form-control input-default " v-model="supervisor" placeholder="ahmed..">
  </div>

  <div class="col-4">
    <label for="password" class="form-label">
project    </label>
    <input type="text" class="form-control input-default " v-model="project" placeholder="ahmed..">
  </div>
  <div class="col-4">
    <label for="password" class="form-label">
date    </label>
    <input type="date" class="form-control input-default " v-model="date" >
  </div>
  

  


  
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
                                              
                                                
                                                       <th><strong>User</strong></th>
                                                       <th><strong>PROJECT</strong></th>
                                                       <th><strong>attend</strong></th>
                                                       <th><strong>gone</strong></th>
                                                  <th><strong>HOURS</strong></th>
                                         
                                                  <th><strong>scanned_by</strong></th>
                                                  
                                               
  
                                                  <th></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr v-for="data in scaling "  :key="data.id">
                                                  
                                                      <td data-table="NAME">  
                                                        {{ data.user.name }}
  </td>

  <td data-table="PROJECT">  
                                                        {{ data.user && data.user.contract && data.user.contract.project ?  
                                                      data.user.contract.project.name : 'unknown'  
                                                      }}
  </td>


  <td>

    {{ data.attending_time }}
  </td>
  <td>

{{ data.attending_leaving }}
</td>
  <td data-table="Hours">  
                                                        {{ data.hours   }}
  </td>

  <td data-table="scanned_by">  
                                                        {{ data.scanned ? data.scanned.name : 'unknown'   }}
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
                </div>
  
  </template>
  
  <script>
  import moment from 'moment'
  
      export default {
    
          data(){
  return{
  
  datas:{},
  date:'',
  name:'',
  supervisor:'',
  project:''
  }
  
          },
  
          methods:{
 

      getResults(page = 1) {
        
        let formData = new FormData();

if(this.name){
	 formData.append('name', this.name);
}
if(this.supervisor){
	 formData.append('supervisor', this.supervisor);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.project){
	 formData.append('project', this.project);
}
axios.post('/managers/HR/attendance/json?page=' + page,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
}).then(response => {
                      
                this.datas =  response.data.data
              
                  })
      },
  
      datajson(){
        let formData = new FormData();

if(this.name){
	 formData.append('name', this.name);
}
if(this.scanned_by){
	 formData.append('scanned_by', this.scanned_by);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.project){
	 formData.append('project', this.project);
}
axios.post('/managers/HR/attendance/json',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
        		.then(response => {
                      
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
            this.today = moment().format('DD/MM/YYYY');
       this.datajson()

          },
        
          watch:{
          
  'date':function(){
              this.datajson()
            } ,

  'project':function(){
              this.datajson()
            } ,
  'name':function(){
              this.datajson()
            } ,
  'supervisor':function(){
              this.datajson()
            } ,

        

        



          },

              computed:{

              scaling(){
                var newData = []
                if(this.datas && this.datas.data ){
  this.datas.data.forEach(e=>{
                  e.hours = (Number(e.time_difference) / 60)
              
                   e.hours =  e.hours.toFixed(2)

                })

                newData = this.datas.data


                }
          
                return newData
              }

            }
      }
  </script>
  