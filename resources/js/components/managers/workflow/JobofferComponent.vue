<template>
  <div class="row">
    <div class="col-3">
      <h3>joboffer </h3>
      <draggable
        class="dragArea list-group"
        :list="list1"
        group="people"
       
        @change="log"
      >
        <div
          class="list-group-item"
          v-for="element in list1"
          :key="element.id"
        >
          {{  element.name }}
        </div>
      </draggable>
            <button @click="submit()" class="btn btn-primary">Submit</button>
    </div>

    <div class="col-3">
      <h3> Role</h3>
      <draggable
        class="dragArea list-group"
        :list="list2"
        :group="{ name: 'people' }"
  
        @change="log"
      >
        <div
          class="list-group-item"
          v-for="element in list2"
          :key="element.id"
        >
          {{ element.name ? element.name : element.role.name }}
        </div>
      </draggable>

    </div>

    <rawDisplayer class="col-3" :value="list1" title="List 1" />

    <rawDisplayer class="col-3" :value="list2" title="List 2" />
  </div>
</template>

<script>
  import draggable from 'vuedraggable'
export default {
  props:['role','workflow'],
  name: "clone",
  display: "Clone",
  order: 2,
  components: {
    draggable
  },
  data() {
    return {
      list1: [],
      list2: this.role
    };
  },
  methods: {

    
submit(){

      	const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

                let formData = new FormData();



if(this.list1.length > 0){
	 formData.append('Workflow', JSON.stringify(this.list1));
}
    axios.post('/managers/updatejobofferWorkflow',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
})
.then(res=>{
 
 
})
},


    log: function(evt) {
      window.console.log(evt);
    },

    updatedata(){
     this.workflow.flowwork_step.forEach(e=>{
      this.list1.push({id:e.role.id,name:e.role.name})
     })
    }
  },
  mounted(){
this.updatedata()
  }
};
</script>
<style scoped></style>