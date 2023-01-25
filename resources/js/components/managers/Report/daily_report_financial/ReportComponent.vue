<template>
    <div >
      <div class="card">
  <div class="card-body">
    <div class="row">
  <div class="col-4">
    <label for="password" class="form-label">
      ref
    </label>
    <input type="text" class="form-control input-default " v-model="ref" placeholder="PO..">
  </div>
  
  <div class="col-4">
    <label for="password" class="form-label">
     from 
    </label>
    <input type="date" class="form-control input-default " v-model="from" placeholder="to">
  </div>
  <div class="col-4">
    <label for="password" class="form-label">
     to
    </label>
    <input type="date" class="form-control input-default " v-model="to" placeholder="to">
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
                      

  
  
                                  <div class="table-responsive">
                                      <table class="table datatable-button-print-basic">
                                          <thead>
                                              <tr>
                                                  <th><strong>CODE</strong></th>
                                                  <th><strong>DATE</strong></th>
                                             
                                                  <th><strong>STATUS</strong> </th>
                                                  
                                                  <th><strong>TOTAL</strong></th>
                                                  <th></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr v-for="data in datas.data "  :key="data.id">
                                                  
                                                      <td data-table="CODE">  
  
  
  {{data.ref}}</td>

  
  <td data-table="DATE">  
  
  
  {{data.date}}</td>
                       

  
  <td data-table="STATUS" v-if="data.status == 2">
                              <button type="button"   class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh">
                              REJECTED
                              </button>
                           </td>
                           <td data-table="STATUS"  v-if="data.status == 1">
                              <button type="button"  class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">
                              ACCEPTED
                              </button>
                           </td>
                           <td data-table="STATUS" v-if="data.status == 0">
                              <button type="button"     class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">
                              BENDING
                              </button>
                           </td>
                           <td data-table="STATUS" v-if="data.status == 3">
                              <button type="button"    class="badge bg-secondary  border-0" >
                              draft
                              </button>
                           </td>
                             
  <td data-table="TOTAL">{{data.total}}</td>
                                                   <td  data-table="ACTION">
                                                  
    
  <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     ACTION
    </a>
  
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" :href="'/managers/report/daily/financial/preview/'+data.id">preview</a>

      <a class="dropdown-item" :href="'/managers/report/daily/financial/update/'+data.id">update</a>

      
    
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
  
      
  
  
                </div>
  
  </template>
  
  <script>
  import moment from 'moment'
  
      export default {
        
          data(){
  return{
  
  datas:{},

  ref:'',

  to:'',

  total:'',
  users:[],
  user_id:'',

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
  
                        }else{
                          Object.keys(n).map((z)=>{
      
      this.users.push(n[z])
           })
                        }
                          
                              })
                     
      
      })
      },
  

 

      getResults(page = 1) {
  
        
        let formData = new FormData();
  

  

  if(this.ref){
       formData.append('ref', this.ref);
  }
  
  if(this.user_id){
       formData.append('user_id', this.user_id);
  }
  
    
  if(this.to){
       formData.append('to', this.to);
  }
  
  
  if(this.from){
       formData.append('from', this.from);
  }

  

  axios.post('/managers/report/daily/financial/json?page='+page,formData, {
                      headers: {
                          'Content-Type': 'multipart/form-data' },
  }).then(response => {
                      
                this.datas =  response.data.data
              
                  })
      },
  
      datajson(){
  
        let formData = new FormData();
  

  
  if(this.to){
       formData.append('to', this.to);
  }
  
  
  if(this.from){
       formData.append('from', this.from);
  }

  

  
  if(this.ref){
       formData.append('ref', this.ref);
  }
  
  if(this.user_id){
       formData.append('user_id', this.user_id);
  }
  
  axios.post('/managers/report/daily/financial/json',formData, {
                      headers: {
                          'Content-Type': 'multipart/form-data' },
  })
  
      .then(response => {
                      
                this.datas =  response.data.data
              
                  })
      },
  
  
  


   },
          mounted() {
       
       this.datajson()
   
       this.user()

     
          },
        
          watch:{
            'ref':function(){
              this.datajson()
            } ,
  'to':function(){
              this.datajson()
            } ,
            'from':function(){
              this.datajson()
            } ,


  'user_id':function(){
              this.datajson()
            } ,

          },
      
      }
  </script>
  