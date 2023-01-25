<template>
    <div >
 
 
       <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="card">
                   <div class="card-body">
                      <div class="row">
                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> depratment</label>
                               <input type="text" class="form-control input-default "  v-model="name"  placeholder="role">
                            </div>
                         </div>


                
                         
                      </div>
               

                      <div class="row">
                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> marketing_project</label>
                               <input type="text" class="form-control input-default "  v-model="marketing_project"  placeholder="role">
                            </div>
                         </div>

                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> percentage of attendance</label>
                               <input type="text" class="form-control input-default "  v-model="percentage_attendance"  placeholder="role">
                            </div>
                         </div>

                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> percentage of performance</label>
                               <input type="text" class="form-control input-default "  v-model="percentage_performance"  placeholder="role">
                            </div>
                         </div>

                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> percentage marketing deal</label>
                               <input type="text" class="form-control input-default "  v-model="percentage_deal"  placeholder="role">
                            </div>
                         </div>

                         
                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> percentage cash flow</label>
                               <input type="text" class="form-control input-default "  v-model="percentage_cash_flow"  placeholder="role">
                            </div>
                         </div>


                      </div>
               

                      </div>
                      </div>
                      <button class="btn btn-primary">submit</button>
                      </form>
                      </div>
                      </template>
                      <script
                      >

export default {

        data(){
return{
name:'',
percentage_cash_flow:'',
percentage_deal:'',
percentage_performance:'',
percentage_attendance:'',
marketing_project:'',
percentage_section:'',
}
        }
        ,

        methods:{

submit(){

   let formData = new FormData();

if(this.percentage_cash_flow){
	 formData.append('percentage_cash_flow', this.percentage_cash_flow);
}


if(this.percentage_deal){
	 formData.append('percentage_deal', this.percentage_deal);
}


if(this.percentage_performance){
	 formData.append('percentage_performance', this.percentage_performance);
}

if(this.percentage_attendance){
	 formData.append('percentage_attendance', this.percentage_attendance);
}

if(this.marketing_project){
	 formData.append('marketing_project', this.marketing_project);
}


if(this.percentage_section){
	 formData.append('percentage_section', this.percentage_section);
}



   axios.post('/managers/department/insert',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})

.then(res=>{
   window.location.href = ('/managers/department/')
})
}

        }
    }
                    
                    
                    </script>