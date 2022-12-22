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


                      </div>
                      <div class="row">

                         <div class="col-xl-2 mb-2" v-for="check in permission2" :key="check.id" >
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
        props:['permission'],
        data(){
return{
name:'',
permission2:this.permission,

}
        }
        ,

        methods:{

submit(){
var data = [ ]

this.permission2.forEach(e=>{
    if(e.check){
        data.push(e.id)
    }
})


axios({
    url:'/managers/role/insert',
    method:'post',
    data:{
        name:this.name,
       permission:JSON.stringify(data)
    }
})
}

        }
    }
                    
                    
                    </script>