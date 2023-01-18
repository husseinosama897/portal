<template>
    <div>
        
         <div class="row" v-for="data in datas.data" :key="data.id">

           <table-performance-project  :data="data" ></table-performance-project >

</div>  
         


                 
               </div>

</template>

<script>
 import moment from 'moment'
import Vue from 'vue'
   export default {
     
       data(){
return{
 
projects:[],
project_id:'',
employee:'',
working_day:'',
from:'',
to:'',
userapprovel:{},
divide:'',

datas:{

},
allerros:[],

attending_leaving:'',
attending_time:'',


}

       },


       methods:{


   datajson() {
       axios({
 method: 'post',
 url: '/managers/report/performance/jsonproject' ,
 data:{

from:this.from,
to:this.to,

}
})		.then(response => {
                   
             this.datas =  response.data
           
               })
   },





},
       mounted() {
        this.from = moment().startOf('month').format('YYYY-MM-DD');
 this.to = moment().endOf('month').format('YYYY-MM-DD');
this.working_day = moment.duration(moment(this.to).diff(moment(this.from)));
this.working_day = (parseInt(this.working_day.asDays()) + 1)
    this.datajson()

       },
  
    
   }
</script>
