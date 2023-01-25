<template>
<div class="card">
    <div class="card-body" id="chart">
     
      <h3   :class="output >= 50 ? 'text-success' :  'text-danger' " > KPI ({{ output }} % ) </h3>  

<h3   :class="growth_rate >= 0.5 ? 'text-success' :  'text-danger' " > growth_rate ({{ growth_rate }}  % ) </h3>  

        <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>

     </div>
    </div>
 
 </template>
 <script>
 import moment from 'moment'
 
     export default {
 props:['data2','bid_value'],
 data(){
   return {        
  data:this.data2,
  output:'',
  scaling:[],
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
        getjson(){
   
        axios({
            url:'/managers/report/department/construction/json',
            method:'post',
            data:{

                from:this.from,
                to:this.to,

            }
        }).then(res=>{


            this.data = res.data.data

             
        this.series.splice(0)
  
  this.chartOptions.xaxis.categories.splice(0)


            this.updatecharts()

        })
 
  
  
},

            updatecharts(){
  this.series.push({ name:'project',data:[
    
  ]})


var actual = 0

var overall = 0
  this.data.forEach(e=>{
   
    e.project_overall.forEach(element=>{

        var percentage_attendance = (Number(element.percentage_attendance) * 0.25 )

var percentage_performance =  (Number(element.percentage_performance) * 0.25 )
var sum = (Number(element.cash_in) - Number(element.cash_out)) 

sum = (Number(sum) * 100 / element.cash_in) 


if(sum > 100){
  sum = 100
}

var comparison = 0
if(sum <= 20  && sum > 0){
  comparison =    sum * 2.5 

}

if(sum > 20){
  comparison =   50 
}

if( sum <= 0 ){
  comparison =   0

}


var project_bid_value = (Number(e.bid_value) * 100 / Number(this.bid_value.bid_value_open)  / 100)



project_bid_value  = project_bid_value.toFixed(2)



        var total = (Number(percentage_performance ?? 0) + Number(percentage_attendance ?? 0) + Number(comparison ?? 0))
     
total = (Number(total) * Number(project_bid_value))




total = total.toFixed(2) 




        let item  = this.scaling.find(data=>
  element.date == data.date
)

if(item !== undefined){
    item.percentage = (Number(total) + Number(item.percentage))
    item.percentage =   item.percentage.toFixed(2)

   

    Vue.set(element,'percentage',item.percentage)

}else{

    this.scaling.push({date:element.date,percentage:total})

}


    })



 
})

this.scaling.sort((a,b) => Date.parse(a.date) - Date.parse(b.date) )
  

this.scaling.forEach(e=>{
   

   
          this.series[0].data.push(e.percentage)
           
       
          actual = (Number(e.percentage) + Number(actual))
   
         
   
        this.chartOptions.xaxis.categories.push(moment(e.date).format('MMMM  yyyy'))
         
   
         overall = (this.series[0].data.length * 100)
                 
                 this.output = actual / overall * 100    
     
                 
   
                 this.output = this.output.toFixed(2)
                var exponent = (1 / this.series[0].data.length)
   

                var st = (Number(this.series[0].data[this.series[0].data.length - 1]) / Number(this.series[0].data[0]  > 0 ? this.series[0].data[0] : 0.01  )   )

          
                
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


           
        

         //   this.$eventbus.$on('event', this.test);

  
      this.series.splice(0)
  
         this.chartOptions.xaxis.categories.splice(0)

         this.getjson()
        },


         
     }
 
     </script>