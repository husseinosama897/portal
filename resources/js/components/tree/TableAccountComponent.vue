<template>
<div>

            <div class="card mt-3">
  <div class="card-body">
      <h5 class="card-title"> الحسابات</h5>
    
        
              
                  <form >
                      <div >
                     <div class="row">
                        <div class="col-sm">
                      <input type="text"  class="form-control"  v-model="searchname" placeholder="الاسم">

                    </div>
                       <div class="col-sm">
                      <input type="text"  class="form-control"  v-model="code" placeholder="الرمز">

                    </div>
                   
                    <div class="col-sm">
                      <select class="form-select" v-model="selectedlevel" aria-label="Default select example">
                        <option selected value="">مستوي الحسابات</option>
                        <option value="1">مستوي 1</option>
                        <option value="2">مستوي 2</option>
                        <option value="3">مستوي 3</option>
                        <option value="3">مستوي 4</option>
                      </select>
                    </div>
            
         
                </div>
                   </div>
                  </form>
              
                
                </div>

</div>

<div class="card">
  <div class="card-body">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="table-wrapper">
                                      <div class="table-title">
                                        <div class="row">
                                      
                                          <div class="col-12 col-md-6">
                                            <div class="button-add-remove ">
                                              <div class="row">
                                                <div class="col-12 col-md-5 mt-2 mt-md-0">
                                                  <a href="/managers/createaccountbank" class="btn btn-primary">
                                                    <i class='bx bx-user-plus'></i>
                                                    <span>اضافه حساب جديد</span></a>
                                                </div>
                                         
                                              </div>
                                            </div>
                  
                                          </div>
                                        </div>
                                      </div>
                                      <div class="table-responsive">
                                    <table class="table table-responsive ">
                <thead class="cf">
                          <tr>
                            <th  colspan="3"> اسم الحساب</th>
                            <th style="width:13%;" > النوع</th>
                            <th style="width:30%;" > الوصف </th>
                      
                            <th style="width:20%;" > الخيارات</th>
                          </tr>
                        </thead>
                        <tbody  id="table-body-proudact">
                          <tr  v-for="(da) in  selectedaccount" :key="da.id">
                        
               
                    

                          
                                  <td  colspan="3" :class="'padleftindex-'+da.level">   
                     {{da.code}}-{{da.name}}
      
                            </td>




                         

            


                            
              <td >
                  {{da.type}}
              </td>


              <td  >

{{da.dis}}
              </td>


                     <td  v-if="da.level == 1" >
                              
                              <div  >
                              
                 
                              </div>
                            </td>



                     <td  v-if="da.level == 2" >
                              
                              <div  >
                              
                              
                               

                              </div>
                            </td>

                            
                     <td  v-if="da.level == 3" >
                              
                              <div  >
                         
                                  <a :href="'/managers/editaccount3/'+da.id">
                                    <i class="fas fa-edit plus-fa"></i>
                                  </a>
                              </div>
                            </td>


                     <td  v-if="da.level == 4" >
                              
                              <div  >
               
                              
                                  <a :href="'/managers/editaccount4/'+da.id">
                              <i class="fas fa-edit plus-fa"></i>
                                  </a>
                                
                             

                              </div>
                            </td>


                           </tr>
           
                        </tbody>
                      </table>
                                      </div>
                                    </div>
                  
                                  </div>
                                </div>
</div>

</div>

                                <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" v-on:submit.prevent="submit()" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">تعديل الحساب </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="label-req"> رمز الحساب </label>
              <input type="text" v-model="editz.code" class="form-control" value="تلقائي" required readonly>
            </div>
            <div class="form-group">
              <label class="label-req">  اسم الحساب</label>
              <input type="text" v-model="editz.name" class="form-control" placeholder="بنك الأهلي" required>
            </div>
            <div class="form-group">
              <label class="label-req"> نوع الحساب </label>
              <input type="text"  v-model="editz.type" class="form-control" placeholder="بنكي" required>
            </div> 
             
              <div class="form-group">
                <label class="label">  رقم الحساب</label>
                <input type="text" v-model="editz.number" class="form-control" placeholder="145764854745" >
              </div>
            <div class="form-group">
              <label class="label"> الرصيد الافتتاحي  </label>
              <input type="text" v-model="editz.initial_balance" class="form-control" placeholder="1000" >
            </div>
          
          </div>
          <div class="modal-footer">
            <input type="button" class="btn cansel" data-dismiss="modal" value="الغاء">
            <input type="submit" class="btn btn-info" value="حفظ">
          </div>
        </form>
      </div>
    </div>
  </div>
 
  </div>
</template>

<script>
    export default {
  mounted() {
 
this.product()
  },
          data() {
    return {
 type:'',
  name:'',
code:'',
group:'',
measuring:'',
data:{},
barcode:'',
 dis:'',
buy_price:'',
editz:{},
selectedlevel:'',
searchname:'',
supplier_address:'',
code:'',
place:'',
supplier_address:''

,
newdata:[],
selling:'',
inventory:'',
typex:'',
deleter:[],
loaction_inventory:'',
quantity:'',
min_quantity:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
auto_order:'',
            succ:false,
    }

          },

   methods: {
dele(data,index){
  this.deleter = []
      if(confirm("Do you really want to delete?")){
    this.deleter.push(data.id)
axios({
    url:'/deleteacreateccountbank'+data.level+'/'+this.deleter,
    method:'post',
}).then(res=>{
this.newdata.splice(index,1)
    this.deleter = []
})

      }
},


dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/deleteacreateccountbank/'+this.deleter,
    method:'post',
}).then(res=>{
     this.deleter.forEach(z=>{
    this.data.data.find((e,index)=>{
           if(e.id == z.id){
         
this.data.data.splice(index)
           }
       })
    })
    this.deleter = []

})
}

     },



  getResults(page = 1) {
		axios({
  method: 'get',
  url: '/managers/accountbankjson?page=' + page,

})		.then(response => {
                    
              this.data =  response.data.data
            
                });    
        },

       

       product(){
axios({
	method:'get',
	'url':'/managers/accountbankjson',
  data:{

  }
}).then(res=>{

this.data = res.data.data

res.data.data.data.forEach(e=>{
this.newdata.push({id:e.id,level:e.level,type:e.name,name:e.name,code:e.code,dis:e.dis})

e.subaccount1.forEach(z=>{
  this.newdata.push({id:z.id,level:z.level,type:e.name,name:z.name,code:z.code,dis:z.dis})

  z.sub_account3.forEach(f=>{
  this.newdata.push({id:f.id,level:f.level,type:z.name,name:f.name,code:f.code,dis:f.dis})

    f.sub_account4.forEach(g=>{
  this.newdata.push({id:g.id,level:g.level,type:f.name,name:g.name,code:g.code,dis:g.dis})
})

})
})

})


})
},



editing(pro){
this.editz = {id:pro.id,code:pro.code,type:pro.type,name:pro.name,initial_balance:pro.initial_balance,number:pro.number}
},

  submit () {
      this.succ = false
    axios({
      method:'post',
      url:'/updateacc/'+this.editz.id,
      data:{
 name:this.editz.name,
 number:this.editz.number,
 type:this.editz.type,
 initial_balance:this.editz.initial_balance,


      }
    }).then(res=>{


this.data.data.find(e=>{
if(e.id == this.editz.id){
     e.name =  this.editz.name,
 e.number = this.editz.number,
 e.type = this.editz.type,
 e.initial_balance = this.editz.initial_balance
}

})

this.editz = {}
    })
  }
},computed: {
         selectedaccount1() {
      var value = ''
      var category = ''
      value = this.newdata
      if(this.selectedlevel){

    value = value.filter((item)=>{

      
      if(this.selectedlevel == 2){
  category =  item.level == this.selectedlevel || item.level == 1
      }

            if(this.selectedlevel == 3){
    category= item.level == this.selectedlevel || item.level == 1 || item.level == 2
      }

        if(this.selectedlevel == 4){
  category = item.level == this.selectedlevel || item.level == 1 || item.level == 2  || item.level == 4
      }

        if(this.selectedlevel == 1){
     category = item.level == this.selectedlevel
      }
      




return category

    })
      }
      


if(value == '' ){
   return this.newdata
}else{
   return value
}

      
       
    }
    ,
      selectedaccount2() {
      var value = ''
      var category = ''
      value = this.selectedaccount1
    
      


if(this.searchname){
 
 value = value.filter((item)=>{

      


 return item.name.startsWith(this.searchname);






    })
}



if(this.typex){
  
value = value.filter((item)=>{

      

if(this.typex){
 return item.type == this.typex
}





    })
}

if(value == '' ){
   return this.newdata
}else{
   return value
}

      
       
    }
    ,
    selectedaccount() {
      var value = ''
      var category = ''
      value = this.selectedaccount1
    
      



if(this.code){
  
value = this.selectedaccount1.filter((item)=>{

      

if(this.code){
 return item.code == this.code
}





    })
}


      return value
       
    },
 
},
    }
</script>
