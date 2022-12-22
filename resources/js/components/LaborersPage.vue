

<template>
<div>
<div id="app" class="has-text-centered">
    <div>
        <h3 class="display-3 shadow text-white" >
            Current Time:    

        </h3>
    <h2 class="mb-0 text-white" v-text="currentTime"></h2>
    <button   
    
class="btn btn-primary"

    @click="myFunction()">Click </button>
    
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> camera</h5>
  
      </div>
      <div class="modal-body">
       <div class="camera-button">
  
  </div>
  <div class="card" >

    <div class="card-body">
  <div v-show="isCameraOpen && isLoading" class="card">
    <ul class="loader-circle">
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  
  <div v-if="isCameraOpen" v-show="!isLoading"  :class="{ 'flash' : isShotPhoto }">
    
    <div class="card" :class="{'flash' : isShotPhoto}"></div>
      
    <video v-show="!isPhotoTaken" ref="camera" :width="450" :height="337.5" autoplay></video>
    
    <canvas v-show="isPhotoTaken" id="photoTaken" ref="canvas" :width="450" :height="337.5"></canvas>
  </div>
  
  <div v-if="isCameraOpen && !isLoading" class="card">
    <button type="button" class=" btn btn-primary" @click="takePhoto">
      <img src="https://img.icons8.com/material-outlined/50/000000/camera--v2.png">
    </button>
  </div>
  

  </div>
</div>
</div>
      </div>
    
    </div>
  </div>
</div>


</div>


</template>


<script>
import moment from 'moment'



export default {
props:['data'],
      data(){
return{
        currentTime:'',
    error: '',
	  lat:'',
	  lon:'',
      km:'',
          isCameraOpen: false,
      isPhotoTaken: false,
      isShotPhoto: false,
      isLoading: false,
      link: '#'
    }
    },
    methods: {



   toggleCamera() {
      if(this.isCameraOpen) {
        this.isCameraOpen = false;
        this.isPhotoTaken = false;
        this.isShotPhoto = false;
        this.stopCameraStream();
      } else {
        this.isCameraOpen = true;
        this.createCameraElement();
      }
    },
    
    createCameraElement() {
      this.isLoading = true;
      
      const constraints = (window.constraints = {
				audio: false,
				video: true
			});


			navigator.mediaDevices
				.getUserMedia(constraints)
				.then(stream => {
          this.isLoading = false;
					this.$refs.camera.srcObject = stream;
				})
				.catch(error => {
          this.isLoading = false;
					alert("May the browser didn't support or there is some errors.");
				});
    },
    
    stopCameraStream() {
      let tracks = this.$refs.camera.srcObject.getTracks();

			tracks.forEach(track => {
				track.stop();
			});
    },
    
    takePhoto() {
      if(!this.isPhotoTaken) {
        this.isShotPhoto = true;

        const FLASH_TIMEOUT = 50;

        setTimeout(() => {
          this.isShotPhoto = false;
        }, FLASH_TIMEOUT);
      }
      
      this.isPhotoTaken = !this.isPhotoTaken;
      
      const context = this.$refs.canvas.getContext('2d');
      context.drawImage(this.$refs.camera, 0, 0, 450, 337.5);
      const canvas = document.getElementById("photoTaken").toDataURL('image/jpeg', 1)


    // Logs wL2dvYWwgbW9yZ..
     	const config = {
   
                   headers: { 'content-type': 'multipart/form-data' }
   
               }
   
               let formData = new FormData();
   
      formData.append('v' ,canvas);
        formData.append('out_of_place' ,this.km);


     axios.post('/testfile',formData, {
                   headers: {
                       'Content-Type': 'multipart/form-data' },
   }).then(res=>{
      window.$("#exampleModal").modal("hide"); 
   })


    },
    
    downloadImage() {
      const download = document.getElementById("downloadPhoto");
      const canvas = document.getElementById("photoTaken").toDataURL("image/jpeg")
    .replace("image/jpeg", "image/octet-stream");
      download.setAttribute("href", canvas);
    },


   toRad(Value) 
    {
        return Value * Math.PI / 180;
    },
     errorHandler : function(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            }
            else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         },

  myFunction: function () {		
	 if(navigator.geolocation){
	 navigator.geolocation.getCurrentPosition(this.showPosition,this.errorCallback,{timeout:10000});
	 }else{
	 this.error = "Geolocation is not supported."; 
		 
	 }
    },
    errorCallback: function (error) {
            this.error = error
        },

 showPosition:function (position) {	

 this.km = 0
this.lat =0
	this.lon = ''

		this.lat = position.coords.latitude;
		this.lon = position.coords.longitude;

var project_lat = this.data.project.lat

              var R = 6371; // km
      var dLat = this.toRad(project_lat -this.lat);
      var dLon = this.toRad(this.data.project.log-this.lon);
     var lat = this.toRad(this.lat);
    project_lat  = this.toRad(project_lat );

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat) * Math.cos(project_lat ); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    this.km = (Number(R) * Number(c));
 console.log(this.km)
    if(this.km <= 2){
   
       window.$("#exampleModal").modal("show"); 
      this.toggleCamera()
     
       
    }
    
	},

 updateCurrentTime() {
           this.currentTime = moment().format('hh:mm:ss a')
       
        }
    },
    created() {

        setInterval(() => this.updateCurrentTime(), 1000);
    },





}
</script>