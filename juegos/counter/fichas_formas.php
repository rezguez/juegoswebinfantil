<?php

include_once '../inc/head_fichas.inc';

$carpeta = '../elementos/frutas';
$directorio = opendir($carpeta); // ruta actual
while ($archivo = readdir($directorio)) // obtenemos un archivo y luego otro sucesivamente
{
    if (! is_dir($archivo) && $archivo != 'Thumbs.db') // verificamos si es o no un directorio
    {
        $elem_url[] = $carpeta . '/' . $archivo;
    }
}
shuffle($elem_url);


$colores = Array( $elem_url[0], $elem_url[1], $elem_url[2], $elem_url[3]);
$formas = Array(  'tri',  'cua',   'rec',  'cir',  'rom');
shuffle($colores);
shuffle($formas);

$azarcolores = array( 1, 2, 3);
$azarformas = array( 2, 3, 4);


function pintaforma($tipo, $color)
{
    switch ($tipo) {
        case 'tri':
            return "<img src=\"data:image/svg+xml,%3Csvg version='1.1' id='$tipo-$color' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='100px' height='100px' xml:space='preserve'%3E%3Cpolygon fill='$color' stroke='%23000000' stroke-width='2' stroke-miterlimit='10' points='2.5,88.5 50,6.228 97.5,88.5 '%3E%3C/polygon%3E%3C/svg%3E\" width=100%>";
            break;
        case 'cua':
            return "<img src=\"data:image/svg+xml,%3Csvg version='1.1' id='$tipo-$color' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='100px' height='100px' xml:space='preserve'%3E%3Crect x='16' y='16' fill='$color' stroke='%23000000' stroke-width='2' stroke-miterlimit='10' width='66' height='66'%3E%3C/rect%3E%3C/svg%3E\" width=100%>";
            break;
        case 'rec':
            return "<img src=\"data:image/svg+xml,%3Csvg version='1.1' id='$tipo-$color' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='100px' height='100px' xml:space='preserve'%3E%3Crect x='2' y='27' fill='$color' stroke='%23000000' stroke-width='2' stroke-miterlimit='10' width='96' height='48'%3E%3C/rect%3E%3C/svg%3E\" width=100%>";
            break;
        case 'cir':
            return "<img src=\"data:image/svg+xml,%3Csvg version='1.1' id='$tipo-$color' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='100px' height='100px' xml:space='preserve'%3E%3Ccircle fill='$color' stroke='%23000000' stroke-width='2' stroke-miterlimit='10' cx='49.735' cy='49.735' r='40'%3E%3C/circle%3E%3C/svg%3E\" width=100%>";
            break;
        case 'rom':
            return "<img src=\"data:image/svg+xml,%3Csvg version='1.1' id='$tipo-$color' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='100px' height='100px' xml:space='preserve'%3E%3Cpolygon fill='$color' stroke='%23000000' stroke-width='2' stroke-miterlimit='10' points='18.15,50.398 49.764,2.5 80.851,49.602 49.236,97.5 '%3E%3C/polygon%3E%3C/svg%3E\" width=100%>";
            break;
        default:
            ;
            break;
    }
}
?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->

		
		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
		<span class='col titulobarra text-center' onclick='openFullscreen()'
				style='cursor: pointer; margin-bottom: 0px;'>RECORTA LAS FORMAS Y PÉGALAS EN SU LUGAR</span>
		</div>
<?php
echo "<div class='row justify-content-center align-items-center'>
<div class='c9 celdainvisible m-3'  ></div>
<div class='c9 celda m-3 sombra text-center'  >" . pintaforma($formas[$azarformas[0]], 'none') . "</div>
<div class='c9 celda m-3 sombra text-center' >" . pintaforma($formas[$azarformas[1]], 'none') . "</div>
<div class='c9 celda m-3 sombra text-center' >" . pintaforma($formas[$azarformas[2]], 'none') . "</div>
</div>";
for ($i = 0; $i < 3; $i ++) {
    echo "<div class='row justify-content-center align-items-center'>
<div class=' c9 celda m-3 sombra text-center'><img src='".$colores[$i]."' style='width: 3vw;left:25%; top:25%'></div>
<div id='caja-" . $i . "-0' class=' c9 celda m-3 sombra text-center'  ></div>
<div id='caja-" . $i . "-1' class=' c9 celda m-3 sombra text-center'  ></div>
<div id='caja-" . $i . "-2' class=' c9 celda m-3 sombra text-center'  ></div>
</div>";
}
echo "</div>";
?>


			<div id='canvas' class='row mx-4 mt-5' style='border-top-style:dashed;'>
<?php
for ($x = 0; $x < count($azarcolores); $x++) {
    for ($y = 0; $y < count($azarformas); $y++) {
        echo "<div class='movilidad c9 celdainvisible '  id='myelemento-" . $x . "-" . $y . "' style='left:0vw;'>";
        echo pintaforma($formas[$azarformas[$y]], 'none') . "<img class='numero' src='".$colores[$x]."' style='width: 3vw; left:35%; top:35%'></div>";
    }
}

echo "</div>";
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
					Has completado el ejercicio
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
var numerototal= 9;
var lista=[];


for (z=0;z<numerototal; z++) { lista[z]=z;}

lista.sort(function(a, b){return 0.5 - Math.random()});

var moviles = document.getElementsByClassName("movilidad");

for (j=0; j<numerototal; j++) {
		moviles[j].style.left=lista[j]*10 + "vw";
}



var num= moviles.length;
	
//Make the DIV element draggagle:
	moviles.forEach(hacerdragables);


function hacerdragables(value, index) {
    var elmnt = value;
	dragElement(elmnt);

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
    tipobj = elmnt.id.replace('myelemento-','');

    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    //Ver si ha alcanzado la posicion correcta
     
    var pos = getPos(elmnt);
    var cajatipo=document.getElementById('caja-'+ tipobj);
    
    var continente = getPos(cajatipo);
    if (pos[0]>(continente[0]-10) && pos[1]>(continente[1]-10) && pos[0]<(continente[0] +20) && pos[1]<(continente[1]+20)) { 
        beep(25, 520, 50); //beep
		document.getElementById('caja-'+ tipobj).appendChild( elmnt.firstChild); // muevo numero a la caja
		elmnt.classList.add("ok"); // etiqueto como correcto para luego contar
		elmnt.classList.remove("movilidad"); // etiqueto como correcto para luego contar
		document.getElementById('caja-'+ tipobj).classList.remove('celda');
		document.getElementById('caja-'+ tipobj).classList.remove('sombra');
		document.getElementById('caja-'+ tipobj).classList.add('celdainvisible');
		document.getElementById('caja-'+ tipobj).style="border-color:transparent";
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