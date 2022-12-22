<template>
   <div class="container">
      <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
         <div class="row justify-content-center">
            <div class="col">
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
                              <input type="date" class="form-control input-rounded" v-model="date" placeholder="input-rounded">
                           </div>
                        </div>
                 
                        
                        <div class="col-xl-2 mb-2">
                           <div class="form-group">
                                  <select class="form-select select2" v-model="project_id">
                              <option  value="0"></option>
                                 <option v-for="project in projects" :key="project.id" :value="project.id" style="line-height: normal;
    color: #000;">{{project.name}}</option>
                              </select>
                           </div>
                        </div>


                        <div class="col-xl-4 mb-2">
                           <div class="form-group">
                            

                              <input
                            class="form-control input-default "
                              type="text"
                        
                              placeholder="Subcontractor name auto complete"
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
               
                  </div>
               </div>
            </div>
         </div>
          <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">
                           <div class="col-md-8">
                              <a  :href="'/uploads/contract_withsubcontractor_attachment/'+cycle.path" v-for="cycle in data.contract_withsubcontractor_attachment" :key="cycle.id" download style="color: #222">  <span class="badge bg-danger">
                              {{cycle.path}}
                              </span></a>
                           </div>
                        </div>
                     </div>
        <div class="row justify-content-center">
            <div class="card">
               <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
                           <th ><strong>No.</strong></th>
                           <th style="width: 30%"><strong>Item description</strong></th>
                     
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(con,index) in condition" :key="index">
                           <td><strong>{{index}}</strong></td>
                           <td style="width: 30%">
                              <textarea v-model="con.condition" class="form-control" style="max-height: 2.3rem;">
                              </textarea>
                           </td>
                        
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
     
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
                           <th style="width:30%;"><strong>Item description</strong></th>
                           <th><strong>unit</strong></th>
                           <th><strong>qty</strong></th>

                    
                           <th><strong>unit price</strong></th>

                           <th><strong>total</strong></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="(product,index) in scaling" :key="index">
                           <td></td>
                           <td><strong>{{index}}</strong></td>
                           <td style="width:30%;">
                              <textarea v-model="product.name" class="form-control">
                              </textarea>
                           </td>
                           <td>     <input v-model="product.unit" class="form-control"></td>
           
                           <td>     <input v-model="product.expctedqty" class="form-control"></td>
                    

                           <td>     <input v-model="product.unit_price" class="form-control"></td>
                           <td>{{ product.total  }}</td>
                           <td>
                              <a class="btn btn-danger" @click="removeproduct(index)" >
                              <strong style="color:white;">  Delete</strong>
                              </a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
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

  
         <div class="row justify-content-center">
            <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title"> managers Comments</h4>
                        </div>
                        <div class="card-body">
                            <div id="accordion-twelve" class="accordion accordion-rounded-stylish accordion-gradient">
                                <div class="accordion__item" :key="data.id"  v-for="data in data.contract_withsubcontractor_cycle">
                                    <template v-if="data.comment_contract_withsubcontractor_cycle">
                                    <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                        <span class="accordion__header--text">{{data.role.name}}</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                        <div class="accordion__body--text" >
                                            {{data.comment_contract_withsubcontractor_cycle.content}}
                                        </div>
                                        
                                        <a  :href="'/uploads/contract_withsubcontractor/managers/'+cycle.path" v-for="cycle in data.comment_contract_withsubcontractor_cycle.attachment_petty_cash_cycle" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
                                            file
                                            </span></a>
                                    </div>
                                    </template>
                                </div>
                            
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col">
               <div class="card">
                  <div class="card-header d-block">
                     <h4 class="card-title"> </h4>
                     <p class="m-0 subtitle">Add <code>comments</code> and <code>attachments</code></p>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                        <textarea v-model="contentmanager" placeholder="content" class="form-control mb-2"> 
                                    </textarea>
                        <label class="col-sm" > files  :</label>
                        <div class="col-sm">
                            <input type="file"   v-on:change="onImageChange($event)" >
                        </div>
                        <div class="col-xl-4 mb-2 mt-2">
                        <label for="password" class="col-sm">status</label>
                        <div class="form-group">
                           <select class="form-select select2" aria-label=".form-select-sm example" v-model="status">
                              <option value="1">Accept</option>
                              <option value="2">Reject</option>
                           </select>
                        </div>
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
                           <button class="btn btn-primary"  type="submit">
                           submit
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
props:['data'],
        data(){
return{

quotation:'',
project_id:'',
products:[{}],
allerros:[],
status:'',
condition:[{}],
no_vat:false,
date:'',
projects:[],
subject:'',
content:'',

projects:[],

images:[],
cc:'',
ref:'',
userz:[],
contractor:{},
contractors:[],
choice:[],
to:'',
contentmanager:'',
matrial_request_cycle:[],
transportation:'',
delivery_date:'',
material_avalibility:'',
subject:'',
}

        },

        methods:{
                         
         
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

         
              onImageChange(e) {     
this.images.push(e.target.files[0])
            },

         deleteuser(index){
                this.userz.splice(index,1)
            }
,
takethischoice(user){
this.userz.push(user)
   this.choice.splice(0)
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
this.project_id = 1,
this.products = [{}],
this.allerros = [],
this.condition = [{}],
this.date = '',
this.subject = '',
this.content = '',
this.cc = '',
this.ref = '',
this.userz = [],

this.choice = [],
this.to = '',
this.transportation= '',
this.delivery_date = '',
this.material_avalibility = '',
this.subject = ''
},

submit(){

      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

                if(this.contractor.id){
   formData.append('contractor_id', this.contractor.id);
   }
   

   if(this.project_id){
	 formData.append('project_id', this.project_id);
}


if(this.images){
	 formData.append('count', this.images.length);
}


this.images.forEach((element, index, array) => {
	if(element !== undefined){
 formData.append('files-' + index, element);
	}
     
    });

if(this.contentmanager !== null){
	 formData.append('contentmanager', this.contentmanager);
}



if(this.date){
	 formData.append('date', this.date);
}




if(this.status){
	 formData.append('status', this.status);
}


    axios.post('/managers/action_CWS/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
    window.$("#editEmployeeModal").modal("show");
this.quotation = '',
this.project_id = '',
this.products = [{}],
this.allerros = [],
this.condition = [{}],
this.date = '',
this.contentmanager='',
this.subject = '',
this.content = '',
this.cc = '',
this.ref = '',
this.userz = [],

this.choice = [],
this.to = '',
this.transportation= '',
this.delivery_date = '',
this.material_avalibility = '',
this.subject = ''
 window.location.href = ('/managers/index_CWS')


}).catch(error=>{
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

addproduct(){
    this.products.push({})
},
removeproduct(index){
this.products.splice(index,1)
}
 ,
 
 addcondition(){
    this.condition.push({})
},
removecondition(index){
this.condition.splice(index,1)
}
 
 },
        mounted() {
       
         this.project()

         this.project_id = this.data.project_id
this.condition = this.data.condition,
this.date =this.data.date,
this.ref = this.data.ref

this.contractor.id =this.data.contractor ?  this.data.contractor.id : null
if(this.data.contractor){
   this.contractor.name = this.data.contractor.contractor_name ? this.data.contractor.contractor_name : this.data.contractor.comp
}

this.products = this.data.attributes
        },
     

        computed:{


scaling(){
   var data = []
  this.products.forEach(e=>{
   e.total = (Number(e.expctedqty) * Number(e.unit_price))
  })
   
  return data = this.products
}
,

totalAmount(){
var sum = 0
this.scaling.forEach(e=>{
   sum = (Number(e.total) + Number(sum))
})

return sum

         },

        }
    }
</script>
