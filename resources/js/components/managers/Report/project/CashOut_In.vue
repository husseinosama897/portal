<template>

    <div id="chart">
        <h3   :class="output >= 50 ? 'text-success' :  'text-danger' " > KPI ({{ output }} % ) </h3>  

<h3   :class="growth_rate >= 0.5 ? 'text-success' :  'text-danger' " > growth_rate ({{ growth_rate }}  % ) </h3>  

        <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>

     </div>
 
 </template>
 <script>
 import moment from 'moment'
 
     export default {
 props:['data2'],
 data(){
   return {     
    output:'',
    growth_rate:'',   
  data:this.data2,
    series: [{
              name: "Desktops",
              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
          }],
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
                text: 'cash out & in'
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
        test(data){
   
        this.data  = data.data    
    

  
        this.series.splice(0)
  
  this.chartOptions.xaxis.categories.splice(0)

  this.updatecharts()
  
},

            updatecharts(){
  this.series.push({ name:'cash_out',data:[
    
  ]},
  
  { name:'cash_in',data:[
    
  ]},

  { name:'net_profit',data:[
    
  ]}

  )


var total = 0 
var actual = 0
var overall = 0
  this.data.forEach(e=>{


var out = (Number(e.cash_out ?? 0) )
out = out.toFixed(2)
var _in =  (Number(e.cash_in ?? 0) )
_in = _in.toFixed(2)
var net_profit = (Number(e.cash_in ?? 0)  -  Number(e.cash_out ?? 0))
net_profit = net_profit.toFixed(2)

        this.series[0].data.push(out)
        
        this.series[1].data.push(_in)
        this.series[2].data.push(net_profit)
    
        actual = (Number(net_profit) + Number(actual))

        overall = (Number(_in) + Number(overall))
              
              this.output = actual / overall * 100    
  

              this.output = this.output.toFixed(2)

             var exponent = (1 / this.series[0].data.length)

             var st = this.series[2].data[2] / this.series[2].data[this.series[2].data.length - 1]

         this.growth_rate =     Math.pow(st,exponent) - 1 

         this.growth_rate =   (this.growth_rate * 100)

         this.growth_rate = this.growth_rate.toFixed(2)


    

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