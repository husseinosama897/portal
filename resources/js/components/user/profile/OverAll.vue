<template>

    <div id="chart">
     
      <h3   :class="output >= 50 ? 'text-success' :  'text-danger' " > KPI ({{ output }} % ) </h3>  

<h3   :class="growth_rate >= 0.5 ? 'text-success' :  'text-danger' " > growth_rate ({{ growth_rate }}  % ) </h3>  

        <apexchart type="line" height="550px" :options="chartOptions" :series="series"></apexchart>

     </div>
 
 </template>
 <script>
 import moment from 'moment'
 
     export default {
 props:['data2'],
 data(){
   return {        
  data:this.data2,
  output:'',
  growth_rate:'',
    series: [{
              name: "Desktops",
              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
          }],
          chartOptions: {
            colors: ['#4de320'],
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

            updatecharts(){
  this.series.push({ name:'project',data:[
    
  ]})


var actual = 0

var overall = 0
  this.data.forEach(e=>{
    var percentage_attendance = 0
    var percentage_performance =0
    var percentage_section = 0
   if('procurement' == this.data.role.section.name ){
    percentage_attendance = (Number(e.percentage_attendance) *   this.data.role.section.percentage_attendance ?? 0.25 )

percentage_performance =  (Number(e.percentage_performance) * this.data.role.section.percentage_performance ?? 0.25 )

percentage_section =   e.percentage_section *  this.data.role.section.percentage_section ?? 0.50 

   }

   if('marketing' == this.data.role.section.name){

    percentage_attendance = (Number(e.percentage_attendance) *   this.data.role.section.percentage_attendance ?? 0 )

percentage_performance =  (Number(e.percentage_performance) * this.data.role.section.percentage_performance ?? 0 )

percentage_section =   e.percentage_section *  this.data.role.section.percentage_section ?? 0.60 

var percentage_deal = e.percentage_deal ?? 0 * this.data.role.section.percentage_deal ?? 0.40

percentage_section = (Number(percentage_deal ) + Number(percentage_section))



   }


   if('user' == this.data.role){

percentage_attendance = (Number(e.percentage_attendance) *   0.50 )

percentage_performance =  (Number(e.percentage_performance) *  0.50 )

}

 
var total = (Number(percentage_performance) + Number(percentage_attendance) + percentage_section)

total = total.toFixed(2)

actual = (Number(total) + Number(actual))



        this.series[0].data.push(total)
        
    
    

      this.chartOptions.xaxis.categories.push(moment(e.date).format('MMMM  yyyy'))
      

      overall = (this.series[0].data.length * 100)
              
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