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

<label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)"  multiple>
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
            
                    </form>
                    </div>
                    </template>
                    <script>
                
                export default {

                  props:['refdata'],
                    data(){
return{
conditions:[
{
  item:'Joining Date Immediately',
},
{
  item:'You will be on three (3) month probation period starting from the actual date of joining'
}

],
benefits:[

{item:'acation: 21 days per year'}
,

{item:'Insurance: As per company policy after transfer sponsorship'}
,

{item:'Annual Ticket: one thousand five hundred riyal '},


],
ref:this.refdata,
email:'',
subject:'',
name:'',
date:'',
benefit_check:false,
work_location:'',
contract_type:'',
content:'On behalf of Advanced Construction Power CO. I am pleased to offer you I am pleased to offer you the position of  XXXXX  in our Construction Dept. with the following terms and conditions',
salary:'',
images:[],
}
                    },

                    methods:{

                      onImageChange(e) {     
   this.images.push(e.target.files[0])
           },

                      rest(){
                        this.conditions = [
{
  item:'Joining Date Immediately',
},
{
  item:'You will be on three (3) month probation period starting from the actual date of joining'
}

],
this.benefits = [
{item:'salary',value:0}
,
{item:'acation: 21 days per year'}
,

{item:'Insurance: As per company policy after transfer sponsorship'}
,

{item:'Annual Ticket: one thousand five hundred riyal '},


],

this.subject  = '',
this.date = '',
this.benefit_check = false,
this.work_location = '',
this.contract_type = '',
this.content = '',
this.salary= ''


                      },


                      submit2(){
   
   const  data = {ref:this.ref, 
date:this.date,
work_place:this.work_place,
contract_type: this.contract_type,
content:this.content,
salary:this.salary,
subject: this.subject,
condition:this.conditions,
benefits:this.benefits
     }
   
   this.$cookies.set('joboffer',data);
   
   
   window.location.href = ('/joboffer/preview2')
   
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

   if(this.ref){
	 formData.append('ref', this.ref);
}

if(this.date){
	 formData.append('date', this.date);
}

if(this.salary2){
	 formData.append('salary', this.salary2);
}


if(this.name){
	 formData.append('name', this.name);
}

if(this.email){
	 formData.append('email', this.email);
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


axios.post('/joboffer/insert',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
  this.$cookies.remove('joboffer');
  window.location.href = ('/joboffer/index') 
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
		
    var data =     this.$cookies.get('joboffer');


    this.ref = data.ref ?? '', 
this.date = data.date ?? '',
this.work_place = data.work_place ?? '',
this.contract_type = data.contract_type ?? '',
this.content  = data.content ?? '',
this.salary = data.salary ?? '',
this.subject = data.subject ?? ''


     
	},



  computed:{
salary2(){
  var  value = 0
  this.benefits.forEach(e=>{

value = (Number(e.value) + Number(value))

  })

  value = (Number(value) + Number(this.salary))
  return value
}

  }
                }
                
                </script>