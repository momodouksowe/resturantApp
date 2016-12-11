(function(){
	
	document.addEventListener("deviceready", onDeviceReady.bind(this),false);
	var destinationType;
	var pictureSource;


	function onDeviceReady(){
		pictureSource = navigator.camera.PictureSourceType;
		destinationType = navigator.camera.DestinationType;
	}

 	document.getElementById('capturePhoto').onclick = function(){MyCamera()};
  function MyCamera(){
  	navigator.camera.getPicture(onPhotoDataSuccess, onFail, { quality: 50,
        destinationType: destinationType.DATA_URL });
  }

    document.getElementById('geolocation').addEventListener("click",function(){
		navigator.geolocation.getCurrentPosition(onSuccess,onError, {enableHighAccuracy: true
	});
 });


 function onPhotoDataSuccess(imagedata){
	var smallImage = document.getElementById('smallImage');
	smallImage.style.display ='block';
	smallImage.src="data:image/jpeg;base64," +imagedata;
}

  function onFail(message){
	alert("Failed because: "+ message);
  }

  function onSuccess(position){
  	//var element = document.getElementById('geolocation');
  	alert('Latitude:' + position.coords.latitude +'\n'+
  					    'Longitude: '+ position.coords.longitude + '\n');
  					    
  }

  function onError(error){
  	alert('code: '+ error.code + '\n'+ 'message: '+error.message+'\n');
  }


}) ();
