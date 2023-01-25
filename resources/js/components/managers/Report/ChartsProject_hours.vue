<template>

    <div id="chart">
     
        <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>

     </div>
 
 </template>
 <script>
 import moment from 'moment'
 
     export default {
 props:['data2'],
 data(){
   return {        
  data:this.data2,
    series: [{
              name: "Desktops",
              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
          }],
          chartOptions: {
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            title: {
              text: 'attendance hours',
              align: 'left'
            },
            grid: {
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
          },
          
          
         }
           
         },
 
         methods:{
          test(data){
   
   this.data  = data.data    



   this.series.splice(0)

this.chartOptions.xaxis.categories.splice(0)

this.updatecharts()

},
          updatechart(){

this.data = this.data2
},


            updatecharts(){
  this.series.push({ name:'project',data:[
    
  ]})



  this.data.forEach(e=>{
   
        if(e.time_attendance !== null && e.time_attendance >= 0 ){
         var time = (e.time_attendance / 60)
        this.series[0].data.push(time.toFixed(2))
        console.log(this.series[0].data)
      }else{
        this.series[0].data.push(0)
      }
    

      this.chartOptions.xaxis.categories.push(moment(e.date).format('MMMM  yyyy'))
      


  

})
  
              
            
          
},
         },
         mounted() {

  

          this.$eventbus.$on('event', this.test);

  

         this.series.splice(0)
  
         this.chartOptions.xaxis.categories.splice(0)

         this.updatecharts()
        },


         
     }
 
     </script>