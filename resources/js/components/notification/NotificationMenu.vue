<template>
            <div class="notifications-menu">
                                                    <a class="dropdown-item d-flex"  v-for="notification in Notifications" :key="notification.id"   href="#">
                                                        <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                            <i class="fe fe-mail"></i>
                                                        </div>
                                                        <div class="mt-1 wd-80p">
                                                            <h5 class="notification-label mb-1">{{notification.name}} </h5>
                                                            <span class="notification-subtext">   {{notification.created_at}} </span>
                                                        </div>
                                                    </a>
                                                </div>
                                          
                                             
                                    
</template>
<script>

export default {
    props:['data'],
  data(){
    return{
Notifications:this.data

    }
  },
  methods:{



  },
  mounted(){
    Event.$on('notification',(notification)=>{

this.Notifications.unshift(notification.notification)
    })
}
}
</script>
