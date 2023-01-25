<template>
    <div>
      <!-- ROW-1 OPEN -->
  <div class="row" id="user-profile">
   

    <div class="row">
        <div class="col-4" >
        <div class="card">
                    <div class="card-header">
                        <div class="card-title">About</div>
                    </div>
                    <div class="card-body">
                        <span class="avatar avatar-xxl bradius cover-image" data-bs-image-src="/img/391529-PCODOG-695.jpg"></span>
                        <hr>
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                               name
                            </div>
                            <div>
                                <strong>{{data.name }} </strong>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                                <span><i class="fe fe-briefcase fs-20"></i></span>
                            </div>
                            <div>
                                <strong>{{data.role ?  data.role.name : '' }} </strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                                <span><i class="fe fe-map-pin fs-20"></i></span>
                            </div>
                            <div>
                                <strong>{{data.contract.country }}</strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                                <span><i class="fe fe-phone fs-20"></i></span>
                            </div>
                            <div>
                                <strong>{{data.contract.phone }} </strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="me-4 text-center text-primary">
                                <span><i class="fe fe-mail fs-20"></i></span>
                            </div>
                            <div>
                                <strong>{{data.email}} </strong>
                            </div>
                        </div>
                  
<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>Contract expiry date</span>
</div>
<div>
    <strong> :  {{data.contract.contract_ex }} </strong>
</div>
</div>


<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>salary per month</span>
</div>
<div>
    <strong> :  {{data.contract.salary_per_month }} </strong>
</div>
</div>


<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>Transportation_Allowance</span>
</div>
<div>
    <strong> :  {{data.contract.Transportation_Allowance }} </strong>
</div>
</div>


<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>Communication Allowance</span>
</div>
<div>
    <strong> :  {{data.contract.Communication_Allowance }} </strong>
</div>
</div>

<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>Food_Allowance </span>
</div>
<div>
    <strong> :  {{data.contract.Food_Allowance }} </strong>
</div>
</div>
<div class="d-flex align-items-center mb-3 mt-3">
<div class="me-4 text-center text-primary">
    <span>Other Allowance </span>
</div>
<div>
    <strong> :  {{data.contract.Other_Allowance }} </strong>
</div>
</div>

                        <div class="me-5">
                                <div class="media mb-4">
                                    <div class="media-icon bg-secondary bradius me-3 mt-1">
                                        <i class="fe fe-edit fs-20 text-white"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="text-muted">working hour(s)</span>
                                        <div class="fw-semibold fs-25">
     
{{ data.attending_and_leaving_sum_time_difference }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="me-5 mt-5 mt-md-0">
                                <div class="media mb-4">
                                    <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                        <span class="mt-3">
                                            <i class="fe fe-users fs-20"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <span class="text-muted">Absence</span>
                                        <div class="fw-semibold fs-25">
                                          {{data.Absence}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                 

                           




                    </div>
                </div>
            </div>
<div class="col-8" >
    <div class="card">
        <div class="card-body">
        <chart-project-overall  :data2="data.personal_overall"  :user="data"  ></chart-project-overall>
    </div>
</div>
    </div>

    
    </div>






        <div class="row">
            <div class="col-xl-3">
              
         
                

                

            </div>



       
            <div class="col-xl-12">
  
                <div class="card border p-0 shadow-none"  v-for="task in  data.task" :key="task" >
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="media mt-0">
                                <div class="media-user me-2">

                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0 mt-1">{{task.name}}</h6>
                                    <small class="text-muted">{{task.start_at}}</small>
                         
<span class="badge bg-warning border-0" v-if="task.status == 0">BENDING</span>

<span class="badge bg-success border-0" v-if="task.status == 1">processing</span>

<span class="badge bg-danger border-0" v-if="task.status == 2">rejected</span>

<span class="badge bg-success border-0" v-if="task.status == 3">closed</span>



                                </div>
                            </div>
                            <div class="ms-auto">
                     
                            </div>
                        </div>
                        <div class="mt-4">
                          
                            <p class="mb-0">{{data.dis}}
                            </p>
                        </div>
                    </div>
             
                </div>
            
                <div class="card">    
                <div class="card-header">Daily report</div>       
<div class="card-body">
<div class="table-responsive">
<table id="basic-datatable" class="table dt-responsive nowrap w-100">
<thead>
<tr>
    <th>report</th>
    <th>performance</th>
    <th>commitment</th>
</tr>
</thead>
<tbody>

<tr v-for="  user_daily_report in   data.user_daily_report"  :key="user_daily_report.id">

<td>
{{user_daily_report.ref}}
</td>

<td>{{user_daily_report.pivot.performance}}</td>
<td>{{user_daily_report.pivot.commitment}}</td>

</tr>

</tbody>
</table>
</div>
</div>
            </div>

            <div class="row">

          
<div class="card mb-2">
<div class="card-header d-block">
   <h4 class="card-title">  attachment</h4>
</div>
<div class="card-body">
   <div class="col-md-8">

      <a  :href="'/uploads/user_file/'+cycle" v-for="cycle in data.user_file" :key="cycle.id" download style="color: #222">  <span class="badge bg-danger">
    
      </span></a>
   
   </div>
</div>
</div>


</div>


                </div>
            </div>

          
        </div>
    </div>
    <!-- COL-END -->


</template>

<script>

export default {
props:['data'],
    data(){
        return {

        }
    }
}
</script>

