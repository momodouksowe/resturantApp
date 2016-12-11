var app = {
	initialize: function(){
		this.bindEvents();
	},
	bindEvents:function(){
		document.addEventListener('deviceready', this.onDeviceReady, false)
	},
	onDeviceReady:function(){
		alert("Am here!");
		$(function (){
			$('#decode').click(function(){

				cordova.plugins.barcodeScanner.scan(
					function(result){
						alert("Information: "+ result.txt+ "\n"+"format: "+ result.format+"\n");
					},
					function(error){
						alert(error);
					}
				);
			});
		});
	}
};