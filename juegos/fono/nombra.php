<?php
use clases\Caja;

use clases\Emergente;

if (! isset($_POST['player'])) {

    header("Location: index.php");
}

include_once '../clases/Caja.php';

include_once '../inc/head_fono.inc';

include_once '../inc/marcador_fono.inc';

include_once '../inc/main_fono.inc';

$baseclass = 'orb';

echo "<div class='row '>";

echo "<div class='col-10 col-md-8 col-sm-7 col-lg-4 mx-auto'>";

// CAJA PRINCIPAL

$Principal = new Caja('iditem', "<span id='reloj' class='marca " . $baseclass . "label p-1'><span id='minutos'>0 m</span> : <span id='segundos'>0 s</span></span>", $baseclass);

$Principal->setPrecode('');

$Principal->setBody("<img id='idimagen' class='card-img-top' src=''>", "p-1 " . $baseclass . "fondo");

$Principal->setFooter("<span id='idimagennombre' class='h4'></span>", "text-center p-1 " . $baseclass . "fondo");

$Principal->setPostcode('');

echo $Principal->getCaja();

// CAJA TECLEAR

$Teclear = new Caja('resultado', '', 'bg-warning');

$Teclear->setPrecode('', 'text-dark bg-warning sombra');

$Teclear->header = '';

$Teclear->setBody("<button onclick='falla()' class='btn btn-sm " . $baseclass . "th p-2 sombra col-5'>
						<img src='inc/fallo.png'>
					</button>
					<button onclick='acierta()' class='btn btn-sm " . $baseclass . "but2 p-2 sombra col-5' >
						<img src='inc/acierto.png'>
					</button>", $baseclass . "fondo col-12");

echo $Teclear->getCaja();

echo "</div></div>";

include_once '../inc/footer_fono.inc';

?><script>
imagenes=imagenes_orig.slice(0);
urls=urls_orig.slice(0);
aleatorio();

// Elige una del conjunto de imágenes y controla el número de palabras empleadas
function aleatorio(){
	var r = Math.floor(Math.random() * (imagenes.length));
	document.getElementById('idimagen').src=urls[r];
	document.getElementById('idimagennombre').innerHTML=imagenes[r];
}


// Comprueba cada tecleo para ver si es el correcto
// correcto, añade un intento y un acierto y muestra aplauso
//           Si la palabra está completa, la añade a los logros
// incorrecto, añade un intento y un error y beep

function acierta(){

	var valor=document.getElementById('idimagennombre').innerHTML;
	var intent = document.getElementById('idcontador').innerHTML;
	document.getElementById('idcontador').innerHTML=parseInt(intent)+1;
	var cont = document.getElementById('idaciertos').innerHTML;
	document.getElementById('idaciertos').innerHTML=parseInt(cont)+1;
	if (parseInt(cont) >= (maxaciertos-1)) finturno();
	beep(100, 520, 100); //beep
	beep(100, 520, 200); //beep
	$('#exito').modal('show');
	sleep(1500).then(() =>	{ $('#exito').modal('hide');
	document.getElementById('tecleado').focus();} );
	lista=document.getElementById('acumulado').innerHTML;
	document.getElementById('acumulado').innerHTML=lista + "<div class='card border-success text-center text-success p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
	aleatorio();
}

function falla(){

	var valor=document.getElementById('idimagennombre').innerHTML;
	var intent = document.getElementById('idcontador').innerHTML;
	document.getElementById('idcontador').innerHTML=parseInt(intent)+1;
	var erro = document.getElementById('iderrores').innerHTML;
	document.getElementById('iderrores').innerHTML=parseInt(erro)+1;
	beep(300, 220, 300); //boop
	lista=document.getElementById('acumulado').innerHTML;
	document.getElementById('acumulado').innerHTML=lista + "<div class='card border-danger text-center text-danger p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
	aleatorio();
}



</script>