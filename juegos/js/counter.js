

a=new AudioContext(); // browsers limit the number of concurrent audio contexts, so you better re-use'em
/* Get the documenttodalapaginaent (<html>) to display the page in fullscreen */
var todalapagina = document.documentElement;
function beep(vol, freq, duration){
//Espera milisegundos
	return new Promise(resolve => setTimeout(resolve, ms));
	}

function sinacentos(str){



/* View in fullscreen */
function openFullscreen() {
  if (todalapagina.requestFullscreen) {
    todalapagina.requestFullscreen();
  } else if (todalapagina.mozRequestFullScreen) { /* Firefox */
    todalapagina.mozRequestFullScreen();
  } else if (todalapagina.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    todalapagina.webkitRequestFullscreen();
  } else if (todalapagina.msRequestFullscreen) { /* IE/Edge */
    todalapagina.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}

	var synth = window.speechSynthesis;
	var voices = synth.getVoices();


	function habla(paraleer){
		synth.cancel();
	    var utterThis = new SpeechSynthesisUtterance(paraleer);

	    for(i = 0; i < voices.length ; i++) {
	      if(voices[i].lang === "ES-es") {
	        utterThis.voice = voices[i];
	        break;
	      }
	    }
	    utterThis.pitch = 1.5;
	    utterThis.rate = 1;
	    synth.speak(utterThis);

	}
} else {
    function habla(paraleer) {return false;}
}
