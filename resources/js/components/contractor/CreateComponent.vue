<template>
<div class="">
  	<div class="card">
		<div v-if="succ" class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message.</p>
  <hr>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
  
                              <div class=" mt-3">

                                
                              <div class="">
                   
                                  <main class="sales section-form-main">
                                 
                                    <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
                                      <div class="card">
                                        <div class="card-body">
                                          <section class="header-section mt-4">
                                            <div class="row">
                                              <div class="col-12 col-md-4 col-xl-3 mt-2 mt-md-0">
                                                <div class="parent-label-header mt-1">
                                                  <label for="personal-entity" class="label">
                                                    الكيان الشخصي                                                  </label>
                                                </div>
                                                <div class="row mt-2">
                                                  
                                                         
                                               
                                                    <div class="col-6">
                                                           <div class="col-1">
                                                         <label  @click="restore2()"  id='comp'  for="personal-entity-indv"> فردي</label>
                                                         </div>
                                                               <div class="col-3">
                                                            <input
                                                            type="radio"
                                                            class="form-check-input"
                                                            id="personal-entity-indv"
                                                            name="personal"  v-model="personal" value="1"
                                                          
                                                          />
                                                          </div>
                                                       
                                                        </div>
                                                        <div class="col-6">
                                                           <div class="col-1">
                                                             <label  id='comp2' @click="restore()"  for="personal-entity-company"> شركة </label>
                                                          </div>
                                                           <div class="col-3">
                                                          <input
                                                            type="radio"
                                                            class="form-check-input"
                                                            id="personal-entity-company"
                                                            name="personal"  v-model="personal" value="2"
                                                            checked
                                                          />
                                                          </div>
                                                   
                                                        </div>
                                                 
                                                
                                              
                                                </div>
                                              </div>
                                              <div  class="col-12 col-12  col-md-4 col-xl-3 mt-4 mt-md-0">
                                                <div class="parent-label-header" >
                                                  <label for="name"  class="label mt-1">
                                                   name                                                </label>
                                                </div>
                                                <div class="parent-input-system" v-if="personal == 1">
                                                  <input v-model="contractor_name"
                                                  
                                                    type="text"
                                                    class="form-control"
                                                    id="name"
                                                    placeholder="contractor name"
                                                    
                                                  />
                                                </div>
                                              </div>
                                  
                                            </div>
                                          </section>
                                          <div v-if="personal == 2" class="parent-input-system mt-5">
                                              <div class="row">
                                                  <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                      <label for="name-company" class="label">Company </label>
                                                  </div>
                                                  <div class="col-12 col-md-8 col-lg-6">
                                                   <input type="text" v-model="comp"  class="form-control" placeholder="اسم الشركه" id="name-company" style="margin-right: -15px;" />
                                                </div>
                                              </div>
                                          </div>
                                          <div  v-if="personal == 2" class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label for="tax-num"   class="label">Vat On </label>
                                                </div>

                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="number"  v-model="tax_number" class="form-control" placeholder="الرقم الضريبى" id="tax-num" style="margin-right: -15px;" />
                                              </div>
                                            </div>
                                        </div>
                                        <div  v-if="personal == 2" class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label for="person-company" class="label "> representative </label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="text" placeholder='اسم مندوب الشركه' v-model="representative" class="form-control" id="person-company" style="margin-right: -15px;"/>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label for="number" class="label "> phone</label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="number"  v-model="phone"  class="form-control" placeholder="رقم الهاتف" id="number" style="margin-right: -15px;"/>
                                              </div>
                                            </div>
                                        </div>
                                   
                                        <div class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label  class="col-form-label">Email </label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input  v-model="email" class="form-control" placeholder="Email "  id="email" style="margin-right: -15px;" />
                                              </div>
                                            </div>
                                        </div>
                                        <div class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label for="country" class="col-form-label">Country</label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="text" v-model="country"  class="form-control" placeholder="Country "   id="country" style="margin-right: -15px;"/>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 "  >
                                                    <label for="state" class="col-form-label">city</label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="text" v-model="city"  class="form-control" placeholder="city " id="state" style="margin-right: -15px;" >
                                              </div>
                                            </div>
                                        </div>
                                        <div class="parent-input-system mt-5">
                                            <div class="row">
                                                <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                    <label for="neighborhood" class="col-form-label" >area</label>
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-6">
                                                 <input type="text" v-model="location"  class="form-control" placeholder="area "  id="Neighborhood" style="margin-right: -15px;"/>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="parent-input-system mt-5">
                                          <div class="row">
                                              <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                  <label for="street" class="col-form-label" > street</label>
                                              </div>
                                              <div class="col-12 col-md-8 col-lg-6">
                                               <input type="text" v-model="street_name" class="form-control" placeholder="street"  id="street" style="margin-right: -15px;"/>
                                            </div>
                                          </div>
                                      </div>
  
                                      <div class="parent-input-system mt-5">
                                        <div class="row">
                                            <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                                <label for="building" class="col-form-label" >building number </label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-6">
                                             <input type="text"  v-model="building_num" class="form-control" placeholder=" building number"  id="building" style="margin-right: -15px;"/>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="parent-input-system mt-5">
                                      <div class="row">
                                          <div class="col-12 col-md-2 col-lg-3 col-xl-2 " >
                                              <label for="code" class="col-form-label" >postal code </label>
                                          </div>
                                          <div class="col-12 col-md-8 col-lg-6">
                                           <input type="number" v-model="postal_code"  class="form-control" placeholder="postal code"  id="code" style="margin-right: -15px;"/>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>

                              
                        <label class="form-label" > files  :</label>
                     <div class="col-sm mb-2">
                        <input type="file" v-on:change="onImageChange($event)" multiple>
                     </div>

                           
                                        <div class="row justify-content-center mt-5 mb-4">
                                          <div class="col-12 col-md-3 col-lg-2 mt-5">
                                            <div class="save">
                                              <button type="submit" class="btn btn-primary">
                                                حفظ
                                              </button>
                                            </div>
                                          </div>
                                       
                                      </div>
                                    </form>
                                  </main>
                              </div>
                          </div>
            
              </div>
                          
            
</template>

<script>


    export default {


          data() {
    return {
personal:1,
        type_customer:1,
           contractor_name:'',
          stype:'',
 tax_number:'',
representative:'',
phone:'',

                                      postal_code:'',
  status:'',
building_num:'',
street_name:'',
location:'',
comp:'',
      city:'',
      country:'',
      projects:[{}],
      images:[],
      email:'',
            succ:'',
    }
          },
   methods: {
    onImageChange(e) {     
   this.images.push(e.target.files[0])
           },


    addproject(){
      this.projects.unshift({})
    },
    removeproject(index){
      this.projects.splice(index,1)
    },

     restore(){

      document.querySelector("#comp").style.background = 'white';
       document.querySelector('#comp2').style.setProperty('color', 'white', 'important');
          document.querySelector("#comp2").style.background = 'rgb(16, 32, 81)';
        document.querySelector("#comp").style.setProperty('color', '#102051', 'important');
       
     
     },
     restore2(){

        document.querySelector("#comp").style.background = 'rgb(16, 32, 81)';
       document.querySelector("#comp").style.setProperty('color', 'white', 'important');
       document.querySelector("#comp2").style.background = 'white';
        document.getElementById('comp2').style.setProperty('color', '#707070', 'important');
     
     },






     goback(){
      window.location.href = ('/managers/customerindex')

     },
  submit () {
       this.succ = false
       
       let formData = new FormData();
  
if(this.street_name){
  formData.append('street_name', this.street_name)

}
      
if(this.comp){
  formData.append('comp', this.comp);
}
if(this.building_num){
  formData.append('building_num', this.building_num);
}
if(this.personal){
  formData.append('personal', this.personal);
}
if(this.type_customer){
  formData.append('type_customer', this.type_customer);
}
if(this.contractor_name){
  formData.append('contractor_name', this.contractor_name);
}
if(this.tax_number){
  formData.append('tax_number', this.tax_number);
}


this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });
   
   
if(this.images){
   formData.append('count', this.images.length);
   }

if(this.representative){
  formData.append('representative', this.representative);
}
if(this.phone){
  formData.append('phone', this.phone);
}
if(this.country){
  formData.append('country', this.country);
}
if(this.location){
  formData.append('location', this.location);
}

if(this.processingprojects.length > 0){
   formData.append('project', JSON.stringify(this.processingprojects));
   }
   

if(this.city){
  formData.append('city', this.city);
}
if(this.email){
  formData.append('email', this.email);
}
if(this.postal_code){
  formData.append('postal_code', this.postal_code);
}
if(this.status){
  formData.append('status', this.status);
}

axios.post('/contractor',formData, {
              headers: {
                  'Content-Type': 'multipart/form-data' },
})
.then(res=>{



      this.succ = true
          this.personal = '',
          this.country = '',
      this.type_customer = '',
      this.comp = '',
         this.contractor_name= '',
        this.stype = '',
this.tax_number= '',
this.representative= '',
this.phone= '',
this.location= '',
                    this.postal_code = '',
 this.status= '',
this.building_num = '',
this.street_name= '',
   this.city= '',
this.email= ''
window.location.href = document.referrer;
    })
  }
},
computed:{
processingprojects:function(){
var  projectt = []
this.projects.forEach(e=>{
e.budget = (Number(e.employee_budget) + Number(e.po_budget) + Number(e.subcontractor_budget) + Number(e.petty_cash_budget) ) 
projectt.push(e)
})

return projectt
}
}
    }
</script>
