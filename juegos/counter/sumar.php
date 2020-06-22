<?php

include_once '../inc/head_counter.inc';


$carpeta = '../elementos/frutas';
$directorio = opendir($carpeta); // ruta actual
while ($archivo = readdir($directorio)) // obtenemos un archivo y luego otro sucesivamente
{
    if (! is_dir($archivo) && $archivo != 'Thumbs.db') // verificamos si es o no un directorio
    {
        $elem_url[] = $carpeta . '/' . $archivo;
    }
}


$numerototal = floor(rand(3, 9.9)); // numero total de objetos
$numero1 = floor(rand(1, $numerototal - 1)); // numero objetos de tipo 1
$numero2 = $numerototal - $numero1; // numero de objetos de tipo 2

$dibujo1 = floor(rand(0, count($elem_url) - 0.5)); // objeto tipo 1
do {
    $dibujo2 = floor(rand(0, count($elem_url) - 0.5)); // objeto tipo 2 (pueden ser iguales)
} while ($dibujo1 == $dibujo2);

// audios con los numeros
$div_audios='';
for ($a = 0; $a < 9; $a ++) {
    $div_audios .= "<audio id='audio-" . $a . "' src='../elementos/" . ($a + 1) . ".mp3'></audio>\n";
}
?>

<div class='container-fluid'>
	<!-- EMPIEZA container -->
	
	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->
		
		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('SUMA LAS FRUTAS')"
				style='cursor: pointer; margin-bottom: 0px;'>SUMA LAS FRUTAS</span>
		</div>

<?php echo $div_audios; ?>

		<!-- CAJA CANVAS -->
		<div id='canvas' style='height: 10vw;' class='row mx-4'></div>

<div id='canvas2' class='row p-0 align-items-center mx-4'>
	<!-- RECEPTORES PARA suma -->
	<div class='col-3 m-0 p-0'>
		<div id='caja-suma1' class='col p-1 sombra img-fluid'
			style='border: 2px green solid; height: 30vw;'></div>
		<div id='total1' class='col-4 mb-0 offset-sd-2 offset-md-4 '
			style='width: 75px; height: 75px;'>
			<img src='<?php echo $elem_url[$dibujo1]; ?>' style='opacity: 0.5'	class='total img-fluid' width=75>
			<img id='total-img1' class='total img-fluid' style='left: 100px' src='../elementos/sinnumero.svg' width=75>
		</div>

	</div>
	<div class='col-1 p-0 mx-auto'>
		<img class='img-fluid pl-3' src='../elementos/suma.svg'
			style='filter: drop-shadow(5px 5px 5px gray)' width=75px>
	</div>
	<div class='col-3 m-0 p-0'>
		<div id='caja-suma2' class='col p-1 sombra img-fluid'
			style='border: 2px orange solid; height: 30vw;'></div>
		<div id='total2' class='col-4  mb-0 offset-sm-2 offset-md-4'
			style='width: 75px; height: 75px;'>
			<img src='<?php echo $elem_url[$dibujo2]; ?>' style='opacity: 0.5'	class='total img-fluid' width=75>
			<img id='total-img2' class='total img-fluid' style='left: 100px;'	src='../elementos/sinnumero.svg' width=75>
		</div>

	</div>
	<div class='col-1 p-0 mx-auto'>
		<img class='img-fluid pl-3' src='../elementos/igual.svg'
			style='filter: drop-shadow(5px 5px 5px gray)' width=75px>
	</div>
	<div class='col-4 m-0  p-0'>
		<div id='caja-suma' class='col p-1 sombra img-fluid'
			style='border: 2px blue solid; height: 30vw'></div>
		<div id='total' class='col-4  mb-0 offset-sm-2 offset-md-4'
			style='width: 75px; height: 75px;'>
			<img id='total-img' src='../elementos/sinnumero.svg'
				class='total img-fluid' width=75>
		</div>

	</div>

</div>
</div>
</div>

<!-- ************ Modal exito ************* -->
<div class='modal fade sombra' id='exito' tabindex='-1' role='dialog'>
	<div class='modal-dialog modal-sm modal-dialog-centered'
		role='document'>
		<div class='modal-content'>
			<div class='modal-header text-center ocr'>
				<h5 style='font-weight: 500;'>Felicidades</h5>
			</div>
			<div style='padding-top: 10px;' class='modal-body pb-3 ocrfondo'>
				Has completado la palabra
				<div class='mx-auto'>
					<img class='card-img' src='../inc/bravo.gif' style='width: 200px;'>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ************ FIN Modal  exito ************* -->


<!-- End your project here-->


<script type="text/javascript">
var modal_exito = 'exito';
var numerototal= <?php echo $numerototal; ?>;
var numero1= <?php echo $numero1; ?>;
var numero2= <?php echo $numero2; ?>;
var urlimg1 = '<?php echo $elem_url[$dibujo1]; ?>';
var urlimg2 = '<?php echo $elem_url[$dibujo2]; ?>';
var lista=[];


for (z=0;z<numerototal; z++) { lista[z]=z;}

lista.sort(function(a, b){return 0.5 - Math.random()});

lista.forEach(pintamoviles);

function pintamoviles(value, index) {
		//let txto = "<img  src='elementos/" + (value + 1) + ".svg' class='numero' width=50>";
		urlimg=urlimg2;
		tipo=2;
		txto='';
		if (value<numero1) {urlimg= urlimg1; tipo=1;}
		document.getElementById("canvas").innerHTML += "<div class='movilidad fichaserie text-center px-0 celdainvisible c7'  id='myelemento-" + tipo + "-" + value + "' style='left:" + calculaposini(index) + "%; filter: drop-shadow(5px 5px 5px gray)'><div class='celdainvisible c7' style='position: relative; left:0; top:0;'><img  src='" + urlimg + "' class='numerado ' width=85%>"+txto+"</div></div>";
	}


	var moviles = document.getElementsByClassName("movilidad");
	var num= moviles.length;
	
//Make the DIV element draggagle:
	moviles.forEach(hacerdragables);
		



function hacerdragables(value, index) {

	dragElement(document.getElementById(value.id));
}


function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  
  elmnt.onmousedown = dragMouseDown;
  elmnt.ontouchstart = dragMouseDown;

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.onmouseup = closeDragElement;
    elmnt.ontouchend = closeDragElement;
    
    // call a function whenever the cursor moves:
    elmnt.onmousemove = elementDrag;
    elmnt.ontouchmove = elementDrag;
  }

  function elementDrag(evt) {
	  evt.preventDefault();
	  var e = evt.touches ? evt.touches[0] : evt;
	  if (!evt.touches) { e.preventDefault();}

    //tipoobjeto
    tipobj = elmnt.id.includes('myelemento-1-') ? 1 : 2;
    
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    //Ver si ha alcanzado la posicion correcta
    let pos = getPos(elmnt);
    let cajasumatipo=document.getElementById('caja-suma'+ tipobj);
    let cajasuma=document.getElementById('caja-suma');
    let continente = getPos(cajasumatipo);
    if (pos[0]>(continente[0]) && pos[1]>(continente[1]) && pos[0]<(continente[0] - 75 + cajasumatipo.offsetWidth) && pos[1]<(continente[1]-75+cajasumatipo.offsetHeight)) { 
            //beep(25, 520, 50); //beep
            //elmnt.firstChild.classList.remove('numerado');
            var cln = elmnt.firstChild.cloneNode(true);
			document.getElementById('caja-suma').appendChild(cln ); // muevo numero a la caja
			document.getElementById('caja-suma'+ tipobj).appendChild( elmnt.firstChild); // muevo numero a la caja
			elmnt.classList.add("ok"); // etiqueto como correcto para luego contar
			let correctos = document.getElementsByClassName("ok");
			let correctos1 = document.getElementById('caja-suma'+ tipobj).childNodes.length;
			document.getElementById('total-img').src="../elementos/" + correctos.length + ".svg"; // actualizocontador
			document.getElementById('total-img'+ tipobj).src="../elementos/" + correctos1 + ".svg"; // actualizocontador
			document.getElementById("audio-" + (correctos.length - 1)).play(); // pronuncia el numero
			
			// ver si ya estan todos correctos
			if (correctos.length==numerototal) { 

				beep(100, 520, 200); //beep
				$('#exito').modal('show');
				sleep(2000).then(() =>	{ $('#exito').modal('hide');
				location.reload();} );
		    	
		    }
			
    }
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
	   elmnt.onmouseup = null;
	    elmnt.ontouchend = null;
	    elmnt.onmousemove = null;
	    elmnt.ontouchmove = null;
  }
}

function getPos(elem){

    var tmp=elem;
    var left=tmp.offsetLeft;
    var top=tmp.offsetTop;
    while (tmp=tmp.offsetParent) left += tmp.offsetLeft;
    tmp=elem;
    while(tmp=tmp.offsetParent) top+=tmp.offsetTop;
    return [left,top];
}

a=new AudioContext(); // browsers limit the number of concurrent audio contexts, so you better re-use'em

function beep(vol, freq, duration){
  v=a.createOscillator()
  u=a.createGain()
  v.connect(u)
  v.frequency.value=freq
  v.type="square"
  u.connect(a.destination)
  u.gain.value=vol*0.01
  v.start(a.currentTime)
  v.stop(a.currentTime+duration*0.001)
}

function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
}

function calculaposini(num) {
	var w = window.innerWidth;
	var imgpercent = parseInt(7500/w);
	let separation = parseInt((100 - (numerototal*imgpercent))/numerototal);
	return parseInt((separation/2) + (separation + imgpercent)*num);
}

</script>