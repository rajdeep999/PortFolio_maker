document.addEventListener('DOMContentLoaded',function(){
	var loadImage = document.getElementById('load');
	function loadInputHandler(event){
		var imageFile = event.target.files[0];
		var imageElement = document.getElementById('image');
		imageElement.setAttribute('src',URL.createObjectURL(imageFile));
	};
	loadImage.onchange = loadInputHandler;

	//function for slider effects
	function changeSliderHandler(event){
		Caman("#image",function renderCaman(){
			this.revert(false);
			this[event.target.name](event.target.value).render();
		});

	};
	var brightnessRange = document.getElementById("brightness");
	brightnessRange.onchange = changeSliderHandler;

	var vibranceRange = document.getElementById("vibrance");
	vibranceRange.onchange = changeSliderHandler;

	var hueRange = document.getElementById("hue");
	hueRange.onchange = changeSliderHandler;

	var gammaRange = document.getElementById("gamma");
	gammaRange.onchange = changeSliderHandler;

},false);