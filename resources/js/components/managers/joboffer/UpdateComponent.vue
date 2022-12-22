<template>
    <div class="container">
       <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="row justify-content-center">
        
            <div class="card">
                   <div class="card-body">

<div class="row mt-4"  >

<div class="col-4">
  <label class="form-label" > ref  :</label>
<input class="form-control" readonly v-model="ref">
</div>

<div class="col-4">
  <label class="form-label" > date  :</label>
    <input   type="date" class="form-control" v-model="date">
</div>


<div class="col-4">
  <label class="form-label" > Career Section  :</label>
    <input class="form-control" v-model="subject">

</div>
</div>

<div class="row mt-4">

<div class="col-4">
  <label class="form-label" > work location  :</label>
<input class="form-control" v-model="work_location">
</div>


<div class="col-4">
  <label class="form-label" > contract type  :</label>
  <input class="form-control" v-model="contract_type">
</div>
</div>


<div class="row mt-4"  >

<div class="col-6">
  <label class="form-label" > name  :</label>
<input class="form-control"  v-model="name">
</div>

<div class="col-6">
  <label class="form-label" > email  :</label>
    <input   class="form-control" v-model="email">
</div>



</div>

<div class="row mt-4">
  <label class="form-label" > content   :</label>
<textarea v-model="content" class="form-control"></textarea>

</div>

</div>
                    </div>

                    <div class="row justify-content-center">
         <div class="card mb-2">
                        <div class="card-header d-block">
                           <h4 class="card-title">  attachment</h4>
                        </div>
                        <div class="card-body">

                          <div class="table-responsive">
                  <table class="table table-responsive-md">
                     <thead>
                        <tr>
<th>file</th>
<th>preview</th>
<th>download</th>
                          </tr>
                          </thead>

                          <tbody>
                            <tr v-for="cycle in data.files" :key="cycle.id" >
                              <td>{{cycle.path}}</td>
                              <td><button class="btn btn-primary" type="button" @click="preview(cycle.path)">preview</button></td>
                              <td><a class="btn btn-danger"   :href="'/uploads/joboffer/'+cycle.path"   download >download</a></td>

                            </tr>
                          </tbody>
                          </table>

                        
                        </div>
                     </div>
                     </div>
</div>


                    <div class="card">
                    <div class="card-body">
                      <div class="title-section p-2 ">
                          <h5> benefits</h5>

                          <div class="col-2">
                            <div class="form-check">
    <input type="checkbox" class="form-check-input"  v-model="benefit_check" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">  benefit_check</label>
  </div>
</div>

                        </div>
                     <div class="table-responsive" v-if="benefit_check">
                      <table class="table table-bordered mt-5">
                        <thead>
                          <tr>
                            <th width="50px" style="background-color: #fff">
                              <div class="action-container">
                                <button type="button" class="btn btn-primary" @click="addbenefit()">
                                 +
                                </button>
                              </div>
                            </th>
                            <th scope="col">item</th>
                            <th scope="col">value</th>
                          </tr>
                        </thead>
                        <tbody id="table-body-payment">
                  
                            <tr  v-for="(benefit,index) in benefits" :key="index">
                            <td style="background-color: #fff">
                              <div class="action-container">
                                <button 
                                  class="btn btn-danger"
                                  @click="removebenefit(index)"

                                  type="button"
                                >
                              x
                                </button>
                              </div>
                            </td>
                            <td>
                              <textarea
                                class="form-control input-default "
                                type="text"
                          
                                v-model="benefit.item"
                              ></textarea>
                            </td>

                            <td>
                              <input
                                class="form-control input-default "
                                type="text"
                       
                                v-model="benefit.value"
                              />
                            </td>
                  
                        
                  

                        

                          </tr>

                        </tbody>
                      </table>

                    </div>

                    <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">salary package : </h4>
                        <input class="form-control" v-model="salary2" >
                     </div>
                  </div>
               </div>
            </div>
         </div>

                    </div>
                    </div>

                    <div class="card">
                    <div class="card-body">
                      <div class="title-section p-2 ">
                          <h5> conditions</h5>


                          <div class="table-responsive" >
                      <table class="table table-bordered mt-5">
                        <thead>
                          <tr>
                            <th width="50px" style="background-color: #fff">
                              <div class="action-container">
                                <button type="button" class="btn btn-primary" @click="addcondition()">
                                 +
                                </button>
                              </div>
                            </th>
                            <th scope="col">item</th>
                     
                          </tr>
                        </thead>
                        <tbody id="table-body-payment">
                  
                            <tr  v-for="(condition,index) in conditions" :key="index">
                            <td style="background-color: #fff">
                              <div class="action-container">
                                <button 
                                  class="btn btn-danger"
                                  @click="removecondition(index)"

                                  type="button"
                                >
                              x
                                </button>
                              </div>
                            </td>
                            <td>
                              <textarea
                                class="form-control "
                                type="text"
                               
                                v-model="condition.item"
                              >
                              </textarea>
                            </td>

                  
                

                          </tr>

                        </tbody>
                      </table>
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
                                <div class="accordion__item" :key="data.id"  v-for="data in data.joboffer_cycle">
                                    <template v-if="data.joboffer_comment_cycle">
                                    <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#gradient_collapseOne"> <span class="accordion__header--icon"></span>
                                        <span class="accordion__header--text">{{data.role.name}}</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="gradient_collapseOne" class="collapse accordion__body show" data-parent="#accordion-twelve">
                                        <div class="accordion__body--text" >
                                            {{data.joboffer_comment_cycle.content}}
                                        </div>
                                        
                                        <a  :href="'/uploads/petty_cash/'+cycle.path" v-for="cycle in data.joboffer_comment_cycle.files" :key="cycle.id" download >  <span class="badge badge-pill badge-danger">
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
                    </div>
                    </template>
                    <script>
                
                export default {

                  props:['data'],
                    data(){
return{
conditions:[


],
benefits:[

],
status:1,
ref:this.refdata,
subject:'',
date:'',
benefit_check:false,
work_location:'',
path:'',
contract_type:'',
contentmanager:'',
content:'On behalf of Advanced Construction Power CO. I am pleased to offer you I am pleased to offer you the position of  XXXXX  in our Construction Dept. with the following terms and conditions',
salary:'',
images:[],
}
                    },

                    methods:{

                      onImageChange(e) {     
   this.images.push(e.target.files[0])
           },



                      submit(){


                        let formData = new FormData();

this.images.forEach((element, index, array) => {
if(element !== undefined){
formData.append('files-' + index, element);
}

});


if(this.benefit_check){
   formData.append('benefit_check', this.benefit_check);
   }


if(this.images){
   formData.append('count', this.images.length);
   }

   if(this.status){
	 formData.append('status', this.status);
}

   if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.date){
	 formData.append('date', this.date);
}

if(this.salary){
	 formData.append('salary', this.salary);
}

if(this.work_location){
	 formData.append('work_location', this.work_location);
}

if(this.subject){
	 formData.append('subject', this.subject);
}

if(this.benefit_check){
	 formData.append('benefit_check', this.benefit_check);
}

if(this.contract_type){
	 formData.append('contract_type', this.contract_type);
}

if(this.content){
	 formData.append('content', this.content);
}

if(this.conditions.length > 0){
	 formData.append('condition',JSON.stringify(this.conditions));
}

if(this.benefits.length > 0){
	 formData.append('benefit_salary',JSON.stringify(this.benefits));
}


axios.post('/managers/joboffer/updating/'+this.data.id,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{

  window.location.href = ('/managers/joboffer/index') 
})

                      },

                        removecondition(index){
               this.conditions.splice(index,1)
           }
   ,

   removebenefit(index){
               this.benefits.splice(index,1)
           }
   ,


   addcondition(){
   this.conditions.unshift({})
   },

   
   addbenefit(){
   this.benefits.unshift({})
   },


                    },
                

	mounted() {
		
  

    this.ref = this.data.ref ?? '', 
this.date = this.data.date ?? '',
this.benefit_check = this.data.benefit_check == 1 ? true : false,
this.work_place = this.data.work_place ?? '',
this.contract_type = this.data.contract_type ?? '',
this.content  = this.data.content ?? '',
this.salary = this.data.salary ?? '',
this.subject = this.data.subject ?? ''
this.conditions = this.data.condition ?? []
this.benefits = this.data.benefits ?? []
     
	},



  computed:{
salary2(){
  var  value = 0
  this.benefits.forEach(e=>{
if(e.value > 0){
  value = (Number(e.value) + Number(value))

}

  })

  value = (Number(value) + Number(this.salary))
  return value
}

  }
                }
                
                </script>