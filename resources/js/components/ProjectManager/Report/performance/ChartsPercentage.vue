<template>

    <div id="chart">
      <h3   :class="output >= 50 ? 'text-success' :  'text-danger' " > KPI ({{ output }} % ) </h3>  

<h3   :class="growth_rate >= 0.5 ? 'text-success' :  'text-danger' " > growth_rate ({{ growth_rate }}  % ) </h3>  

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
  growth_rate:'',
  output:'',
    series: [{
              name: "Desktops",
              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
          }],
          chartOptions: {
            colors: ['#e80966'],
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
              text: 'performance percentage',
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


var actual = 0
  this.data.forEach(e=>{
   
        if(e.percentage_performance !== null && e.percentage_performance >= 0 ){
         
        this.series[0].data.push(e.percentage_performance)
        
      }else{
        this.series[0].data.push(0)
      }
    

      this.chartOptions.xaxis.categories.push(moment(e.date).format('MMMM  yyyy'))
      

      actual = (Number(e.percentage_attendance) + Number(actual))

var   overall = (this.series[0].data.length * 100)
           
           this.output = actual / overall * 100    


           this.output = this.output.toFixed(2)
          var exponent = (1 / this.series[0].data.length)

          var st = this.series[0].data[0] / this.series[0].data[this.series[0].data.length - 1]

      this.growth_rate =     Math.pow(st,exponent) - 1 

      this.growth_rate =   (this.growth_rate * 100)

      this.growth_rate = this.growth_rate.toFixed(2)

      if(this.output < 50){
       this.chartOptions.colors[0] = '#fa111d'
   
      }else{
       this.chartOptions.colors[0] = '#49e00d'
   
      }

  

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