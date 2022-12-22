<template>
   <div class="container">


      <div class="alert alert-danger"  v-if=" projectselected &&   projectselected.subcontractor_budget < totalAmount" role="alert">
 the current budget less than your order 
</div>

      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
            <div class="card" v-if="projectselected">
               <div class="card-body">
                  <table class="table dt-responsive nowrap w-100">
                     <thead>
                        <th>
                           budget
                        </th>
                        <th>
                           {{projectselected.subcontractor_budget}}
                        </th>

                        <th>
                           {{totalAmount}}
                        </th>

                        <th>
                           {{ projectselected.subcontractor_budget - totalAmount }}
                        </th>

                     </thead>
                  </table>
               </div>
            </div>

            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " readonly :value="ref" placeholder="Ref">
                           </div>
                        </div>
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                              <input type="date" lang="en-US" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="subject" placeholder="subject">
                           </div>
                        </div>
                               <div class="col-xl-4 mb-2">
                           <div class="form-group">
                                   <select class="form-select select2" @change="getCostCenter" v-model="project_id">
                              <option  value="0"></option>
                                 <option  v-for="project in projects" :key="project.id" :value="project.id">{{project.name}}</option>
                              </select>
                           </div>
                        </div>
                         <div class="col-xl-4 mb-2">
                           <div class="form-group">
                            

                              <input
                            class="form-control input-default "
                              type="text"
                        
                              placeholder="مصطفي محمد "
                              required
@input="autocomplete()"
                            
v-model="contractor.name"

                            />
                        
                                        	<ul class="list-group" v-if="contractors.length > 0 ">
  <li v-for="pro in contractors" @click="updatecontractor(pro)" :key="pro.id" class="list-group-item">{{pro.comp ? pro.comp : pro.contractor_name}}</li>

</ul>


                           </div>
                        </div>

                     </div>
                     <div class="row">
                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default " v-model="to" placeholder="to">
                           </div>
                        </div>
                         <div class="col-xl-4 mb-2">
                           <div class="form-group">
                              <input type="text" class="form-control input-default "
                                 @input="users()"
                                 v-model="cc" placeholder="cc">
                              <ul  v-if="choice.length > 0" class="list-group">
                                 <li class="list-group-item" @click="takethischoice(cho)" v-for="cho in choice"  :key="cho.id" >{{cho.name}}</li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-xl-4">
                           <button class="btn btn-primary"   type="button" @click="addcc()">
                           add
                           </button>
                        </div>
                     </div>
                     <div class="row justify-content-center">
                        <div class="card" v-if="userz.length > 0">
                           <div class="table-responsive">
                              <table    class="table table-responsive-md">
                                 <thead >
                                    <tr>
                                       <th ><strong>No.</strong></th>
                                       <th style="width:30%;"><strong>name</strong></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr v-for="(user,index) in userz" :key="index">
                                       <td><strong>{{index}}</strong></td>
                                       <td style="width:30%;">
                                          {{user.name}}
                                       </td>
                                       <td>
                                          <a class="btn btn-danger" @click="deleteuser(index)" >
                                          <strong style="color:white;">  Delete</strong>
                                          </a>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="password" class="form-label">conent</label>
                        <textarea class="form-control" v-model="contract_on" rows="6">
                        </textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row ">
            <div class="card">
               <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th >
                              <a @click="addproduct()" class="btn btn-success" > <strong style="color:white;">ADD+</strong>
                              </a>
                           </th>
                           <th ><strong>No.</strong></th>
                           <th style="width:30%;" v-for="(line,index) in lines" :key="index">
                              
                              <textarea v-model="line.a" class="form-control">
                            </textarea>
                        
                                <a href="#deleteEmployeeModal" @click="deletecolumn(line,index)" data-toggle="modal">
<i class="fa fa-trash" aria-hidden="true"></i>

                    </a>
                           </th>
                         
                           <th>      <button type="button" class="btn btn-primary" @click="addcolumn()">
                                 +
                                </button>
                              
                              </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="product in column" :key="">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                  
                 
                           <td v-for="(pro,index) in lines.length"  :key="index">
                           
                              <textarea v-model="product[index+1]" class="form-control">
                              </textarea>
                           </td>


                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">total_amount : {{totalAmount}}</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                         <div class="form-check">
    <input type="checkbox" class="form-check-input"  v-model="no_vat" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1"> included vat</label>
  </div>

                        <h4 class="card-title">VAT : {{Vat}}</h4>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col">
                     <div class="card">
                        <div class="card-header">
                           
                           <button class="btn btn-primary"    type="submit">
                           submit
                           </button>
                           <button class="btn btn-primary" @click="submit2()"  type="button">
                           preview
                           </button>
                           <button   @click="reset()" class="btn btn-danger"  type="button">
                           reset
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
      <div id="editEmployeeModal" class="modal fade bd-example-modal-sm" style="overflow:auto;">
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
               <button style="color:black" type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span style="color:black" aria-hidden="true">&times;</span>
               </button>
               <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Done !</h4>
                  <p>Process has been submitted successfully</p>
                  <hr>
                  <input type="button" class="btn btn-dark" data-dismiss="modal" value="close">
               </div>
            </div>
         </div>
      </div>
      <div id="deathEmployeeModal" class="modal fade bd-example" style="overflow:auto;">
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
               <div class="alert alert-danger" role="alert">
                  <h4 class="alert-heading"> فشلت العمليه  !</h4>
                  <p>    :  لقد فشلت العمليه للاسباب التاليه </p>
                  <p v-for="(err,index)  in allerros" :key="index"> {{err}}</p>
                  <hr>
                  <input type="button" class="btn btn-dark" data-dismiss="modal" value="الغاء">
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
    export default {
        props:['refdata'],
        data(){
return{

quotation:'',
project_id:1,
column:[{}],
projects:[],
allerros:[],
no_vat:false,
payment:[{}],
date:'',
subject:'',
userz:[],
contractor:{},
contract_on:'With reference to the above subject, 6565',
choice:[],
cc:'',
ref:this.refdata,
to:'',
projectselected:{},
transportation:'',
contractors:[],
  cost_centers:[],
  lines:[
   {a:'Item description'}
]
  ,
   cost_center_id:'',
delivery_date:'',
material_avalibility:'',
subject:'',
}

        },


        methods:{
         deletecolumn(line,index){
           this.lines.splice(index,1)
            this.column.forEach(col=>{
         
              
              
               this.lines.forEach(line,index=>{
             
                  Vue.set(col,line.a,line.a)
Vue.set(col,line.a,col[index])
   })
  

            })


         },
         addcolumn(){

            this.lines.push({a:this.lines.length+1})
this.column.forEach(col=>{
   this.lines.forEach(line=>{
Vue.set(col,line.a,line.a)
   })
})
         },
                              
         updatecontractor(p){
this.contractor.id =  p.id
this.contractor.name = p.comp ? p.comp : p.contractor_name

this.contractors = []
},
                
          	autocomplete(){
this.contractors = []
if( this.contractor.name !== null){
	axios({
		method:'post',
		url:'/contractor_autotComplete',
data:{
	name:this.contractor.name,

}
	}).then(res=>{
		this.contractors = res.data.data
	})
}

},  
         	getCostCenter(){

               this.projects.forEach(e=>{
if(e.id == this.project_id){
   this.projectselected = e
}

})


},


                              addcc(){


this.userz.push({name:this.cc, email:this.cc})
this.cc = ''
            },


                        project(){
    
axios({
    url:'/selectproject',
    method:'get',
}).then(res=>{
 
   res.data.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
this.projects.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

                this.projects.push(n[e])
                     })

                 }
                        })
   

})
},

            deleteuser(index){
                this.userz.splice(index,1)
            }
,
takethischoice(user){
this.userz.push(user)
   this.choice.splice(0)
},

users(){
    this.choice.splice(0)
    axios({
        url:'/user/userautocomplete',
        method:'post',
        data:{
            name:this.cc
        }
    }).then(res=>{
        this.choice = res.data.data
    })
},
reset(){
        this.quotation = '',
  this.project_id = '',
  this.column = [{}],
  this.allerros = [],
  this.date= '',
  this.subject= '',
  this.contract_on = '',
  this.to = ''
},
submit(){
          	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.project_id){
	 formData.append('project_id', this.project_id);
}
if(this.date){
	 formData.append('date', this.date);
}
if(this.totalAmount){
	 formData.append('total', this.totalAmount);
}
if(this.Vat){
	 formData.append('vat', this.Vat);
}
if(this.contractor.id){
   formData.append('contractor_id', this.contractor.id);
   }


    if(this.cost_center_id){
   formData.append('cost_center_id', this.cost_center_id);
   }

if(this.subject){
	 formData.append('subject', this.subject);
}
if(this.contract_on){
	 formData.append('contract_on', this.contract_on);
}
if(this.to){
	 formData.append('to', this.to);
}
if(this.column.length > 0){
	 formData.append('attr', JSON.stringify(this.column));
}
if(this.userz.length > 0){
	 formData.append('users', JSON.stringify(this.userz));
}
     axios.post('/user/subcontractorinsrting',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  this.$cookies.remove("subcontractor");

    window.location.href = ('/user/index_subcontractor_inv') 
})
.catch(error=>{
 if (error.response.status == 422){

     if(Array.isArray(error.response.data.errors)){
         this.allerros = error.response.data.errors;
     }else{
         try {
  this.allerros = JSON.parse(error.response.data.message);
         }
         catch{
                this.allerros = error.response.data.errors;
         }
     }
      
         window.$("#deathEmployeeModal").modal("show"); 
       
      }
    })
},

submit2(){
   var projectname = {}
this.projects.forEach(e=>{
    if(e.id == this.project_id){
        projectname.name = e.name
    }
})


const  data = {ref:this.ref,
      
 to:this.to,
project:projectname,

total:this.totalAmount,
   
   vat:this.Vat,

contract_on: this.contract_on,
   date:this.date,
attributes:this.column,

subject: this.subject
      }

this.$cookies.set('subcontractor',data);


 window.location.href = ('/user/presubcontractorreturn')

},

addproduct(){
    this.column.push({})
  
this.column.forEach(col=>{
   this.lines.forEach(line=>{
Vue.set(col,line.a,line.a)
   })
})
},
removeproduct(index){
this.column.splice(index,1)
}
 ,
 
 addpayment(){
    this.payment.push({})
},
removepayment(index){
this.payment.splice(index,1)
}
 
 },
        mounted() {
          this.project()
                        var dataa =  this.$cookies.get('subcontractor');

this.ref = dataa.ref,
 this.payment = dataa.note,
this.to = dataa.to
this.totalAmount = dataa.total
 this.contract_on =dataa.contract_on
this.Vat = dataa.vat,
this.column = dataa.attributes
 this.subject = dataa.subject

        },
            computed:{
               totalAmount: function () {
                 var sum = 0;
   if(this.column.length > 0){
   this.column.forEach(e=>{
   if( ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) > 0){
   sum =  ( Number(sum) + Number(e.qty) *  Number(e.unit_price)   ) 
   }else{
   sum = (Number(0) + Number(sum))
   }
   
   
                
                })
   
   }
   
   sum = Math.round(sum)
   return sum
   },
                     Vat: function () {
                 var sum = 0;
                 if(this.no_vat == true){
sum = (Number(15) * Number(this.totalAmount) / Number(100)) ?? 0
   sum = Math.round(sum)
   
   
                 }

                 return sum
   
   },
       },

       
    }
</script>
