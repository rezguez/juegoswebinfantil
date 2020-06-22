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



$numerototal = floor(rand(1, 9));
$dibujo = floor(rand(0, count($elem_url) - 0.5));

// audios con los numeros
$div_audios='';
for ($a = 0; $a < 9; $a ++) {
    $div_audios .= "<audio id='audio-myelemento-" . $a . "' src='../elementos/" . ($a + 1) . ".mp3'></audio>\n";
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
				onmouseover="habla('ORDENA LAS FRUTAS')"
				style='cursor: pointer; margin-bottom: 0px;'>ORDENA LAS FRUTAS</span>
		</div>
<?php echo $div_audios; ?>

		<!-- CAJA CANVAS -->
		<div id='canvas' style='height: 15vw;' class='row mx-4'></div>

		<div id='canvas2' class='row p-0 justify-content-center align-items-center'>
<?php 
for ($i = 0; $i < $numerototal; $i ++) {

    echo "<div id='caja-myelemento-" . $i . "' class='celda c9 fichaserie text-center px-0 sombra'><img src='../elementos/" . ($i + 1) . ".svg' width=25% style='filter: grayscale(100);'></div>";
}
?>
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
var urlimg = '<?php echo $elem_url[$dibujo]; ?>';
var lista=[];


for (z=0;z<numerototal; z++) { lista[z]=z;}

lista.sort(function(a, b){return 0.5 - Math.random()});

lista.forEach(pintamoviles);

function pintamoviles(value, index) {
		let txto = "<img  src='../elementos/" + (value + 1) + ".svg' class='numero fichaserie' width=50%>";
		document.getElementById("canvas").innerHTML += "<div class='movilidad fichaserie text-center px-0 celdainvisible c9'  id='myelemento-" + value + "' style='left:" + calculaposini(index) + "%; filter: drop-shadow(5px 5px 5px gray)'><div style='position: relative; left:0; top:0;'><img  src='" + urlimg + "' class='numerado ' width=85%>"+txto+"</div></div>";
	}


	var moviles = document.getElementsByClassName("movilidad");
	var num= moviles.length;
	
//Make the DIV element draggagle:
	moviles.forEach(hacerdragables);
		



function hacerdragables(value, index) {
	dragElement(document.getElementById("myelemento-"+index));
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
    let continente = getPos(document.getElementById('caja-'+elmnt.id));
    if (pos[0]>(continente[0]-20) && pos[1]>(continente[1]-20) && pos[0]<(continente[0]+30) && pos[1]<(continente[1]+30)) { 
            beep(25, 520, 50); //beep
            elmnt.classList.remove('movilidad');
            document.getElementById('caja-'+elmnt.id).childNodes[0].remove();
            document.getElementById('caja-'+elmnt.id).style.position='relative';
			document.getElementById('caja-'+elmnt.id).appendChild( elmnt.childNodes[0]); // muevo div con imagenes a la caja
			document.getElementById('caja-'+elmnt.id).classList.add("ok"); // etiqueto como correcto para luego contar
			document.getElementById('caja-'+elmnt.id).childNodes[0].style.left='0px';
	
			document.getElementById('caja-'+elmnt.id).classList.add("border-success"); // pongo el borde verde
			// ver si ya estan todos correctos
			let correctos = document.getElementsByClassName("ok");
		    if (correctos.length==numerototal) { 

				beep(100, 520, 200); //beep
				$('#exito').modal('show');
				sleep(2000).then(() =>	{ $('#exito').modal('hide');
				location.reload();} );
		    	
		    }
			document.getElementById("audio-"+elmnt.id).play(); // pronuncia el numero
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

function calculaposini(num) {
	var w = window.innerWidth;
	var imgpercent = parseInt(7500/w);
	let separation = parseInt((100 - (numerototal*imgpercent))/numerototal);
	return parseInt((separation/2) + (separation + imgpercent)*num);
}

</script>