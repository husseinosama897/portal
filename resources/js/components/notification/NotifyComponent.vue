<template>
  <div>
   <div class="row  d-flex flex-row-reverse " v-for="(notification,index) in Notifications" :key="notification.id" >
      <div class="col-md-3 mt-2" >
                                                <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" id="to" data-bs-autohide="false">
                                                    <div class="d-flex">
                                                        <div class="toast-body">
                                                         {{notification.name}}
                                                        </div>
                                                        <button aria-label="Close" @click="deletenotification(index)" class="btn-close fs-20 ms-auto mt-2 pe-2" data-bs-dismiss="toast"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                </div>
                                            </div>

</div>
</div>
</template>
<script>
    export default {
 methods:{
  deletenotification(index)
{
this.Notifications.splice(index,1)
} },
        mounted() {

console.log(localStorage.getItem('uID'))
         window.Echo.private('notification.'+localStorage.getItem('uID')).listen('.notification',event=>{
           
            var audio = new Audio('/uploads/notification_sound.mp3');  
  audio.type = 'audio/mp3';

 
  Event.$emit('notification',{notification:event.notification})
  try {
    this.Notifications.unshift({name:event.notification.name , id:event.notification.id})
   
     audio.play();

  } catch (err) {
    console.log('Failed to play...' + err);
  }

})
        },
       data(){
return{
 Notifications:[
  
 ],
}
       },
  
    }
</script>
