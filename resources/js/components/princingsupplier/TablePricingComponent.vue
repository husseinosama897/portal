<template>
<div>

                <div class="col-12">
                  <div class="table-wrapper">
                   
                    <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                     <thead>
                        <tr>
                           <th><strong>Code</strong></th>
                           <th><strong>Date</strong></th>
                           <th><strong>Description</strong></th>
                           <th><strong>Status</strong></th>
                           <th><strong>Vat</strong></th>
                           <th><strong>Total</strong></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                           <td data-table="CODE">  

                              <i class="fas fa-folder"></i>
                              {{data.ref}}</td>
                           <td data-table="DATE"><i class="fas fa-calendar-day"></i> {{data.date}}</td>
                           <td data-table="DESCRIPTION">{{data.subject}}</td>
                           <td data-table="STATUS" v-if="data.status == 2">
                              <button type="button" @click="syc(data.pricing_supplier_cycle)"  class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh">
                              REJECTED
                              </button>
                           </td>
                           <td data-table="STATUS"  v-if="data.status == 1">
                              <button type="button" @click="syc(data.pricing_supplier_cycle)" class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">
                              ACCEPTED
                              </button>
                           </td>
                           <td data-table="STATUS" v-if="data.status == 0">
                              <button type="button"   @click="syc(data.pricing_supplier_cycle)"  class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">
                              BENDING
                              </button>
                           </td>
                           <td data-table="VAT">{{data.vat}}</td>
                           <td data-table="TOTAL">{{data.total}}</td>
                           <td  data-table="ACTION">
                              <div class="dropdown">
                                 <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 ACTION
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" :href="'/pricing_supplierpreview/'+data.id">preview</a>
                                    <a class="dropdown-item" :href="'/pricing_supplieredit/'+data.id">edit</a>
                                    <a class="dropdown-item" @click="dele(data,index)"  href="#">delete</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <pagination :data="datas" @pagination-change-page="getResults"></pagination>
               </div>
            </div>
         </div>


                  </div>

                </div>
                <div  style="padding:2000;" class="modal fade bd-example-modal-xl" id="hhh" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"> work flow</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
            <div class="modal-body">
                  <div class="wizard-wrap d-flex justify-content-center">
                     <ul class="wizard wizard-control clearfix d-flex align-items-center" role="navigation">
                       <div class="border-0" v-for="(real,index) in real_cycle" :key="index" :id="'no'+real.class" >
                        <li class="completed fa fa-check" v-if="real.status == 1">
                              <p> {{real.name}} </p>
                        </li>
                        <li class="failed" v-if="real.status == 2">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></svg>
                            </div>
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == 0" >
                              <p> {{real.name}} </p>
                        </li>
                        <li class="active" v-if="real.status == null">
                              <p> {{real.name}} </p>
                        </li>
                        </div>
                     </ul>
                  </div>
          </div>
            </div>
         </div>
      </div>

  </div>
</template>

<script>
    export default {
      props: ["workflow"],
  mounted() {
    this.updatedata()
this.product()
  },
          data() {
    return {
 type:'',
 real_cycle: [
         
         ],
  name:'',
code:'',
group:'',
measuring:'',
datas:{},
barcode:'',
editz:{id:'',code:'',created_at:'',supplier:{id:'',comp:''}},
 dis:'',
buy_price:'',

supplier_address:'',
code:'',
place:'',
supplier_address:''
,
selling:'',
inventory:'',
deleter:[],
loaction_inventory:'',
quantity:'',
min_quantity:'',
supplier_name:'',
supplier_tax_number:'',
supplier_email:'',
auto_order:'',
suppliers:[],
            succ:false,
    }

          },

   methods: {
    syc(cycle) {
			this.real_cycle.forEach(e => {
				cycle.forEach(z => {
					if (z.role.name == e.name) {
					
						if (z.status == 1) {
                     console.log(z);
							Vue.set(e, "status", 1);
						}
						if (z.status == 2) {
							Vue.set(e, "status", 2);
						}
						if (z.status == 0) {
							Vue.set(e, "status", 0);
						}
					}
				});
			});
		},

    updatedata(){
     this.workflow.flowwork_step.forEach(e=>{
      this.real_cycle.push({id:e.role.id,name:e.role.name})
     })
    }
    ,
     	autocompletez(e){
this.suppliers = []
if( this.comp !== null){
	axios({
		method:'post',
		url:'/getselectboxsupp',
data:{
	name:e,

}
	}).then(res=>{
		this.suppliers = res.data.data
	})
}

},
update(p){
this.editz.supplier.id =  p.id
this.editz.supplier.comp = p.comp

this.suppliers = []
},
dele(data,index){
  this.deleter = []
      if(confirm("Do you really want to delete?")){
    this.deleter.push(data.id)
axios({
    url:'/pricing_supplierdelete/'+this.deleter,
    method:'post',
}).then(res=>{
this.data.data.splice(index,1)
    this.deleter = []
})

      }
},


dele2(){
     if(confirm("Do you really want to delete?")){
axios({
    url:'/pricing_supplierdelete/'+this.deleter,
    method:'post',
}).then(res=>{
     this.deleter.forEach(z=>{
    this.data.data.find((e,index)=>{
           if(e.id == z){
this.data.data.splice(index,1)
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
  url: '/managers/pricing_supplierjson?page=' + page,

})		.then(response => {
                    
              this.datas =  response.data.data
            
                });    
        },

       

       product(){
axios({
	method:'get',
	'url':'/pricing_supplierjson',
  data:{

  }
}).then(res=>{

	this.datas = res.data.data

})
},



editing(pro){
  if(pro.supplier){
    this.editz = {id:pro.id,code:pro.code,created_at:pro.created_at,supplier:pro.supplier}
  }else{
this.editz = {id:pro.id,code:pro.code,created_at:pro.created_at,supplier:{id:'' ,comp:''}}
  }

},

  submit () {
      this.succ = false
    axios({
      method:'post',
      url:'/updatesupplierpricing/'+this.editz.id,
      data:{
supplier_id:this.editz.supplier.id,


      }
    }).then(res=>{


this.editz = {id:'',code:'',created_at:'',supplier:{comp:''}}

})


    
  }
}
    }
</script>
