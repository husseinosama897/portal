<template>
    <div class="row">


           

                   <div class="col-6">
           
                       <div class="card">
                           <div class="card-body">

                             
                            <h5 class="card-title">{{data.name   }} - {{ data.number }}</h5>
  

                               <div class="table-responsive">
                                   <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                       <thead>
                                           <tr> 
                                            <th><strong>Name</strong></th>      
                                               <th><strong>Time</strong></th>   
                                               <th><strong>Amount</strong></th>   
                                               <th></th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr v-for="(da,index) in customizing " :key="index">
                                             
                                         
                                           
                                            <td data-table="Working Hour" >{{

da.name 
           }}</td>


                                               <td data-table="Working Hour" >{{

                                    da.time 
                                               }}</td>

                   
                                              
                                                <td data-table="Amount" >{{da.amount}}</td>
       
                                        
                                          
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
                            <chart-timesheet-performance  :data2="this.classificationAndcleaingdata" ></chart-timesheet-performance>


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
 
data2:this.data.data,


}

       },computed:{

        customizing(){
var  newData  = this.data2.sort(function(a, b){return a.time - b.time});
return newData
        },

classificationAndcleaingdata(){
var newData = []
this.data.data.forEach(e=>{

     let item  = newData.find(user=>
this.data.name == user.name
)

var newTime = (Number(e.time ?? 0) + Number(e.over_time ?? 0)) 
if(item == undefined){
newData.push({
name:this.data.name ,
data:[

[newTime,e.amount] 

]
})

}else{
item.data.push([  newTime,e.amount ])
}

})


return newData

},




},




  
   }
</script>
