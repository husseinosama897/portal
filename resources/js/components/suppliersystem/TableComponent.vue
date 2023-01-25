<template>
   <div class="row">
      <div class="col-lg-12">
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
                              <button type="button"   class="badge bg-danger border-0" data-toggle="modal" data-target="#hhh">
                              REJECTED
                              </button>
                           </td>
                           <td data-table="STATUS"  v-if="data.status == 1">
                              <button type="button"  class="badge bg-success border-0" data-toggle="modal" data-target="#hhh">
                              ACCEPTED
                              </button>
                           </td>
                           <td data-table="STATUS" v-if="data.status == 0">
                              <button type="button"     class="badge bg-warning border-0" data-toggle="modal" data-target="#hhh">
                              BENDING
                              </button>
                           </td>
                           <td data-table="STATUS" v-if="data.status == 3">
                              <button type="button"    class="badge bg-secondary  border-0" >
                              draft
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
                                    <a class="dropdown-item" :href="'/suppliersystem/print/'+data.id">preview</a>
                                    <a class="dropdown-item" :href="'/suppliersystem/update/'+data.id">update</a>
                                
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
</template>
<script>
export default {

	data() {
		return {
			datas: {},
	
		};
	},
	methods: {



		getResults(page = 1) {
			axios({
				method: "post",
				url: "/suppliersystem/json?page=" + page
			}).then(response => {
				this.datas = response.data.data;
			});
		},

		datajson() {
			axios({
				method: "post",
				url: "/suppliersystem/json"
			}).then(response => {
				this.datas = response.data.data;
			});
		},

	},
	mounted() {
		this.datajson();
   
	},
 
};
</script>
