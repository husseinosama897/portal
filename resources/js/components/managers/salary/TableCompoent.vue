<template>

<div class="row">
  <div class="card">

<div class="card-body">

  <div class="row">
 



<div class="col-3">
  <label for="password" class="form-label">salary_day_from</label>
      <input type="text"     v-model="salary_day_from"   class="form-control" id="myRange">

    </div>

    <div class="col-3">
      <label for="password" class="form-label">salary_day_to</label>
      <input type="text"     v-model="salary_day_to"   class="form-control" id="myRange">

    </div>

    <div class="col-3">
      <label for="password" class="form-label">salary_Hour_from</label>
      <input type="text"     v-model="salary_Hour_from"   class="form-control" id="myRange">

    </div>

    
    <div class="col-3">
      <label for="password" class="form-label">working_hour_from</label>
      <input type="text"     v-model="working_hour_from"   class="form-control" id="myRange">

    </div>

     
    <div class="col-3">
      <label for="password" class="form-label">working_hour_to</label>
      <input type="text"     v-model="working_hour_to"   class="form-control" id="myRange">

    </div>


    <div class="col-3">
      <label for="password" class="form-label">Deduction_from</label>
      <input type="text"     v-model="Deduction_from"   class="form-control" id="myRange">

    </div>


    <div class="col-3">
      <label for="password" class="form-label">Deduction_to</label>
      <input type="text"     v-model="Deduction_to"   class="form-control" id="myRange">

    </div>

    <div class="col-3">
      <label for="password" class="form-label">Amount_from</label>



      <input type="text"     v-model="Amount_from"   class="form-control" id="myRange">

    </div>

    <div class="col-3">
      <label for="password" class="form-label">Amount_to</label>
      <input type="text"     v-model="Amount_to"   class="form-control" id="myRange">

    </div>


  </div>


</div>


  </div>
              
                    <div class="col-lg-12">
            
                        <div class="card">
                            <div class="card-body">

                              

   

                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                             
                                                       <th><strong>name</strong></th>
                                 
                                                <th><strong>Basic Salary</strong></th>   
                                                <th><strong>Salary / Day</strong></th>   
                                                <th><strong>Salary / Hour</strong></th>  
                                                <th><strong>Transportation Allowance</strong></th>
                                                <th><strong>Communication Allowance</strong></th>   
                                                <th><strong>Food Allowance</strong></th>
                                                <th><strong>Other Allowance</strong></th>   
                                                <th><strong>Working Hour on</strong></th>
                                                <th><strong>Working Hour</strong></th> 
                                                <th><strong>Over Time</strong></th> 
                                                <th><strong>Deduction</strong></th> 
                                               
                                                <th><strong>Amount</strong></th>   
                                                <th><strong>Approved by</strong></th>
                                          
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="data in datas.data " :key="data.id">
                                              
                                                <td data-table="name" v-if="data.employee" >{{data.employee.name}}</td>
                                                <td data-table="name" v-else ></td>
                                            
                                                 <td data-table="Basic Salary" >{{data.salary_per_month}}</td>
                                             
                                                 <td data-table="Salary / Day" >{{data.salaryPerDay}}</td>
                                            
                                                 <td data-table="Salary / Hour" >{{data.salaryperHour}}</td>
                     

                                                 <td data-table="Transportation Allowance" >{{data.Transportation_Allowance}}</td>
                                               

                                                 <td data-table="Communication Allowance" >{{data.Communication_Allowance}}</td>



                                                 <td data-table="Food Allowance" >{{data.Food_Allowance}}</td>
                      


                                                 <td data-table="Other Allowance" v-if="data">{{data.Other_Allowance}}</td>
      


                                                 <td data-table="Working Hour on" >{{data.working_hours}}</td>
                                             
                                                <td data-table="Working Hour"   
                                            

                                                >{{

                                     data.time 
                                                }}</td>

<td data-table="OverTime" >{{ data.overtime}}</td>
                                           

                                                 <td data-table="Deduction" >{{data.Deduction}}</td>
                                               

                                                 <td data-table="Amount" >{{data.Amount}}</td>

                                                 <td data-table="Aproved by " v-if="data.user_aproved_by" >{{data.user_aproved_by.name}}</td>
                                          
                                         
                                                 <td data-table="Aproved by " v-else ></td>
                                          
                        
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
  import moment from 'moment'
  
      export default {
       
          data(){
  return{
  
  datas:{},
  salary_day_to:'',
        salary_day_from:'',
        salary_Hour_from:'',
        salary_Hour_to:'',
        working_hour_from:'',
        working_hour_to:'',
        Deduction_from:'',
        Deduction_to:'',
Amount_to:'',
Amount_from:'',
  }
  
          },
  
          methods:{
            
 
 
      getResults(page = 1) {
        let formData = new FormData();

        if(this.Amount_from){
	 formData.append('Amount_from', this.Amount_from);
}


if(this.Amount_to){
	 formData.append('Amount_to', this.Amount_to);
}


if(this.Deduction_to){
	 formData.append('Deduction_to', this.Deduction_to);
}

if(this.Deduction_from){
	 formData.append('Deduction_from', this.Deduction_from);
}



if(this.working_hour_to){
	 formData.append('working_hour_to', this.working_hour_to);
}


if(this.working_hour_from){
	 formData.append('working_hour_from', this.working_hour_from);
}


if(this.salary_Hour_to){
	 formData.append('salary_Hour_to', this.salary_Hour_to);
}

if(this.salary_day_to){
	 formData.append('salary_day_to', this.salary_day_to);
}
if(this.salary_day_from){
	 formData.append('salary_day_from', this.salary_day_from);
}

if(this.salary_Hour_from){
	 formData.append('salary_Hour_from', this.salary_Hour_from);
}


        axios.post('/managers/salaries/jsonSalaries?page=' + page,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
		.then(response => {
                      
                this.datas =  response.data.data
              
                  })
  
  

       		
      },
  
      datajson(){
        let formData = new FormData();

if(this.Amount_from){
	 formData.append('Amount_from', this.Amount_from);
}


if(this.Amount_to){
	 formData.append('Amount_to', this.Amount_to);
}


if(this.Deduction_to){
	 formData.append('Deduction_to', this.Deduction_to);
}

if(this.Deduction_from){
	 formData.append('Deduction_from', this.Deduction_from);
}



if(this.working_hour_to){
	 formData.append('working_hour_to', this.working_hour_to);
}


if(this.working_hour_from){
	 formData.append('working_hour_from', this.working_hour_from);
}


if(this.salary_Hour_to){
	 formData.append('salary_Hour_to', this.salary_Hour_to);
}

if(this.salary_day_to){
	 formData.append('salary_day_to', this.salary_day_to);
}
if(this.salary_day_from){
	 formData.append('salary_day_from', this.salary_day_from);
}

if(this.salary_Hour_from){
	 formData.append('salary_Hour_from', this.salary_Hour_from);
}


    axios.post('/managers/salaries/jsonSalaries',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
		.then(response => {
                      
                this.datas =  response.data.data
              
                  })
      },
  
  
 
 
   },
          mounted() {
            this.today = moment().format('DD/MM/YYYY');
       this.datajson()
      

          },
        
          watch:{
 
            'salary_day_to':function(){
              this.datajson()
            } ,
  'salary_day_from':function(){
              this.datajson()
            } ,
  'salary_Hour_from':function(){
              this.datajson()
            } , 
  'salary_Hour_to':function(){
              this.datajson()
            } ,
  'working_hour_from':function(){
              this.datajson()
            } ,
  'working_hour_to':function(){
              this.datajson()
            } ,
            'Deduction_from':function(){
              this.datajson()
            } ,
            'Deduction_to':function(){
              this.datajson()
            } ,
            'Amount_to':function(){
              this.datajson()
            } ,
            'Amount_from':function(){
              this.datajson()
            } 
          }
      }
  </script>
  