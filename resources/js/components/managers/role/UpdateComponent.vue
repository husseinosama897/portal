<template>
    <div >
 
 
       <form method="POST"  v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="card">
                   <div class="card-body">
                      <div class="row">
                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> role</label>
                               <input type="text" class="form-control input-default "  v-model="name"  placeholder="role">
                            </div>
                         </div>


                         <div class="col-xl-2 mb-2">
                            <div class="form-group">
                               <label for="password" class="form-label"> section</label>
                             
                               <select class="form-control" v-model="section_id" >
                                 <option></option>
                                 <option v-for="sectio in section" :value="sectio.id" :key="sectio.id">{{ sectio.name }}</option>
                               </select>

                            </div>
                         </div>

                      </div>
                      <div class="row">

                         <div class="col-xl-2 mb-2" v-for="check in NewPermission" :key="check.id" >
                        <div class="form-check">
    <input type="checkbox" v-model="check.check" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label"  for="exampleCheck1">{{check.name}}</label>
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
        props:['permission','section','permissionrole','data'],
        data(){
return{
name:'',
permission2:this.permission,
section_id:'',
NewPermission:[],
}
        }
        ,

created(){
this.name = this.data.name
this.section_id = this.data.section_id
this.NewPermission = this.permission

this.permissionrole.forEach(e=>{

   let item  = this.NewPermission.find(user=>
 e.name  == user.name
)

if(item !== undefined){
   Vue.set(e,'check',true)
}else{
   Vue.set(e,'check',false)
}

})





},

        methods:{

submit(){
var data = [ ]

this.permission2.forEach(e=>{
    if(e.check){
        data.push(e.id)
    }
})


axios({
    url:'/managers/role/update/'+this.data.id,
    method:'post',
    data:{
        name:this.name,
        section_id:this.section_id,
       permission:JSON.stringify(data)
    }
}).then(res=>{
   window.location.href = ('/managers/role/')
})
}

        }
    }
                    
                    
                    </script>