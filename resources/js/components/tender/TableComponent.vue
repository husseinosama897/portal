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
                           <th><strong>user</strong></th>
                           <th><strong>Description</strong></th>
                           <th><strong>hand over</strong></th>
                           <th><strong>Status</strong></th>
                    
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                           <td data-table="CODE">  

                              <i class="fas fa-folder"></i>
                              {{data.ref}}</td>
                           <td data-table="DATE"><i class="fas fa-calendar-day"></i> {{data.date}}</td>
                           <td data-table="USER" v-if="data.user"  > {{data.user.name}}</td>
                           <td data-table="USER" v-else  > </td>
                           <td data-table="DESCRIPTION">{{data.subject}}</td>
                           <td data-table="Hand Over">{{data.delivery_date}}</td>
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
                      
                           <td  data-table="ACTION">
                              <div class="dropdown">
                                 <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 ACTION
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" :href="'/tender/update/'+data.id">update</a>
                                   
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
	props: ["workflow"],
	data() {
		return {
			datas: {},
			allerros: [],
			real_cycle: [
         
			]
		};
	},
	methods: {
	

		dele(data, index) {
			if (confirm("Do you really want to delete?")) {
				axios({
					url: "/user/delete_data/" + data.id,
					method: "post"
				}).then(res => {
					this.datas.data.splice(index, 1);
				});
			}
		},
		getResults(page = 1) {
			axios({
				method: "post",
				url: "/tender/json?page=" + page
			}).then(response => {
				this.datas = response.data.data;
			});
		},

		datajson() {
			axios({
				method: "post",
				url: "/tender/json"
			}).then(response => {
				this.datas = response.data.data;
			});
		},



	},
	mounted() {
		this.datajson();
    
	},
	computed: {


	}
};
</script>
