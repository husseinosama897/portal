<template>
    <div class="row" >
  <div class="col-6">

<div class="card">
    <div class="card-body">

      
     <h5 class="card-title">{{data.name   }}</h5>


        <div class="table-responsive">
            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr> 
                     <th><strong>Month</strong></th>      
                        <th><strong>Time</strong></th>   
                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(da,index) in customizing " :key="index">
                      
                  
                    
                     <td data-table="Working Hour" >{{

da.date 
}}

</td>


                        <td data-table="Working Hour" >{{

             da.time_attendance 
                        }}</td>


                       
               
                   
                    </tr>
        
        
                </tbody>
            </table>
        
        </div>
    </div>
</div>
</div>

<div class="col-6">
<div class="card">
    <div class="card-body">
     
     </div>
</div>
</div>


</div>
</template>
<script>
 import moment from 'moment'
   export default {
     props:['data'],
       data(){
return{
 
data2:this.data,


}

       },computed:{

        customizing(){
var  newData  = this.data2.project_overall.sort(function(a, b){return a.date  - b.date});
return newData
        },






},




  
   }
</script>
