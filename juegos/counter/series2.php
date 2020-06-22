<?php
include_once '../inc/head_counter.inc';

include_once '../inc/main_counter.inc';

$carpeta = '../elementos/coches';
$directorio = opendir($carpeta); // ruta actual
while ($archivo = readdir($directorio)) // obtenemos un archivo y luego otro sucesivamente
{
    if (! is_dir($archivo) && $archivo != 'Thumbs.db') // verificamos si es o no un directorio
    {
        $elem_url[] = $carpeta . '/' . $archivo;
    }
}


$numerototal = 6; // numero total de objetos que faltan por colocar
$numero1 = 3; // numero objetos de tipo 1
$numero2 = $numerototal - $numero1; // numero de objetos de tipo 2

$dibujo1 = floor(rand(0, count($elem_url) - 0.5)); // objeto tipo 1
do {
    $dibujo2 = floor(rand(0, count($elem_url) - 0.5)); // objeto tipo 2 (no pueden ser iguales)
} while ($dibujo1 == $dibujo2);

?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->
		
		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('COMPLETA LA SERIE')"
				style='cursor: pointer; margin-bottom: 0px;'>COMPLETA LA SERIE</span>
		</div>

		<!-- CAJA CANVAS -->
		<div id='canvas' style='height: 15vw;' class='row mx-4'></div>

		<div id='canvas2' class='row p-0 justify-content-center align-items-center'>
					<span  class='c7 celdainvisible fichaserie text-center px-0'>
					<img src='<?php echo $elem_url[$dibujo1]; ?>' class='fichaserie' width=100%></span>
					<span  class='c7 celdainvisible fichaserie text-center px-0'>
					<img src='<?php echo $elem_url[$dibujo2]; ?>' class='fichaserie' width=100%></span>


<?php
for ($i = 0; $i < $numero1; $i ++) {
    echo "<span  class='c7 celda fichaserie sombra text-center tipo1 px-0'></span>
    <span  class='c7 celda fichaserie sombra text-center tipo2 px-0' width=100%> </span>
    ";
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
var numero1= <?php echo $numero1; ?>;
var numero2= <?php echo $numero2; ?>;
var urlimg1 = '<?php echo $elem_url[$dibujo1]; ?>';
var urlimg2 = '<?php echo $elem_url[$dibujo2]; ?>';
var lista=[];


for (z=0;z<(numerototal+2); z++) { lista[z]=z;}

lista.sort(function(a, b){return 0.5 - Math.random()});

lista.forEach(pintamoviles);

function pintamoviles(value, index) {

		urlimg=urlimg2;
		tipo="tipo2";
		txto='';
		if (value<(numero1 + 1)) {urlimg= urlimg1; tipo="tipo1";}
		document.getElementById("canvas").innerHTML += "<div class='movilidad fichaserie text-center px-0 c7 celdainvisible'   id='myelemento-" + tipo + "-" + value + "' style='left:" + calculaposini(index, numerototal + 3) + "%; filter: drop-shadow(5px 5px 5px gray)'>"+txto+"<img  class='fichaserie' src='" + urlimg + "'  width=100%></div>";
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
    tipobj = elmnt.id.includes('myelemento-tipo1-') ? "tipo1" : "tipo2";
    
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
    cajasumatipo=document.getElementsByClassName( tipobj);
   
 for ($z=0; $z < cajasumatipo.length; $z++) {
    continente = getPos(cajasumatipo[$z]);

    if (pos[0]>(continente[0]-20) && pos[1]>(continente[1]-20) && pos[0]<(continente[0]+30) && pos[1]<(continente[1]+30)) { 
            beep(25, 520, 50); //beep
 			cajasumatipo[$z].appendChild( elmnt.firstChild); // muevo numero a la caja
 			cajasumatipo[$z].classList.remove('sombra');
 			cajasumatipo[$z].classList.remove('celda');
 			cajasumatipo[$z].classList.add('celdainvisible');
  			cajasumatipo[$z].classList.remove(tipobj);
			elmnt.classList.add("ok"); // etiqueto como correcto para luego contar
			let correctos = document.getElementsByClassName("ok");
			// ver si ya estan todos correctos
			if (correctos.length==numerototal) { 
				beep(100, 520, 200); //beep
				$('#exito').modal('show');
				sleep(2000).then(() =>	{ $('#exito').modal('hide');
				location.reload();} );
		    	
		    }
			
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

function calculaposini(num, total) {
	var w = window.innerWidth;
	var imgpercent = parseInt(7500/w);
	let separation = parseInt((100 - (total*imgpercent))/total);
	return parseInt((separation/2) + (separation + imgpercent)*num);
}

</script>