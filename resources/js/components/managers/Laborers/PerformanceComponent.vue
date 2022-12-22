
    <template>
      <div class="invoice-container" id="printMe">
        <div class="invoice-header">
            <div class="title-date">
                <h2 class="title">Attending </h2>
         
            </div>
            <div class="space"></div>
     
        </div>
        <div class="invoice-body">
            <table>
                <thead>
                    <th style="padding-left:12px;">{{data.name}}</th>
                    <th>attending_time</th>
                    <th>leaving_time</th>
                    <th>hours</th>
                         <th>minutes</th>
            
                </thead>

                <tbody id="table-body">
                <tr class="single-row" v-for="dat in data.attending_and_leaving" :key="dat.id">
                <td></td>
                    <td>{{dat.attending_time}}</td>
                    <td>{{dat.attending_leaving}}</td>
                        <td>{{dat.time_difference    }}</td>
                        <td>{{dat.min    }}</td>
              
                 
                </tr>
                
                <tr style="padding-left: 20px">
                    <td class="dashed "><div class="float">
                        <a href="#" class="float"  v-print="'#printMe'" id="add-row">
                            <span class="material-icons plus">print</span>
                        </a>
                    </div>
                </td>
                    <td class="dashed"></td>
                    <td class="dashed"></td>
                    <td class="dashed"></td>
                    <td class="dashed"></td>
                </tr>
            </tbody>
            </table>
           
        </div>
    </div>

</template>
<script>
    export default {
        props:['data'],
        mounted() {

        },
       data(){
return{
   name:'',
            password_confirmation:'',
            password:'',
            projects:[],
       
            name:'',

            vacations:'',
   weekly_vacation:'',
   project_id:'',
    contract_date:'',
  contract_ex:'',

working_hours:'',
    
            email:'',
            allerros:[],
            role_idz:'',
            roles:[],
}
       },
  methods:{
                                               projectz(){
    
axios({
    url:'/selectproject',
    method:'get',
}).then(res=>{
    
    res.data.data.forEach(n=>{
                     if(Array.isArray(n)){
                         n.forEach(z=>{
this.projects.push(z)
                    })
                  }else{

let vm = []

                   Object.keys(n).map((e)=>{

                this.projects.push(n[e])
                     })

                 }
                        })
     

})
},
           onImageChange(e) {     
this.sign = e.target.files[0]
            },

getrole(){

  axios({
        url:'/admin/user/role',
        method:'get',
        data:{
 
        }
    }).then(res=>{
         this.roles = res.data.data

    })
},
submit(){
   


         	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();

      if(this.sign !== undefined && this.sign == null){
	 formData.append('sign', this.sign);
}
if(this.name){
	 formData.append('name', this.name);
}
if(this.password_confirmation){
	 formData.append('password_confirmation', this.password_confirmation);
}

if(this.password){
	 formData.append('password', this.password);
}


 if(this.working_hours){
	 formData.append('working_hours', this.working_hours);
}


    if(this.contract_ex){
	 formData.append('contract_ex', this.contract_ex);
}


   if(this.contract_date){
	 formData.append('contract_date', this.contract_date);
}


if(this.project_id){
	 formData.append('project_id', this.project_id);
}

if(this.weekly_vacation){
	 formData.append('weekly_vacation', this.weekly_vacation);
}

if(this.vacations){
	 formData.append('vacations', this.vacations);
}



if(this.email){
	 formData.append('email', this.email);
}

  
    axios.post('/Laborer_add',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
   .then(res=>{
          window.$("#editEmployeeModal").modal("show"); 

    })
},

  }
        
    }
</script>
