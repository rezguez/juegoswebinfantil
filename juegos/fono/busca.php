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

echo "<div class='col-10 col-md-8 col-sm-8 col-lg-4 mx-auto'>";

// CAJA PRINCIPAL

$Principal = new Caja('iditem', "<span id='reloj' class='marca '.$baseclass.'label p-1'><span id='minutos'>0 m</span> : <span id='segundos'>0 s</span></span>", $baseclass);

$Principal->setPrecode('');

$Principal->setBody("<img id='idimagen' class='card-img-top' src='' alt='' >", "p-1 " . $baseclass . "fondo");

$Principal->setFooter("<ul class='list-group list-group-flush col-11 mx-auto px-1'>
    <li class='list-group-item btn-outline-dark'>
        <span id='idimagennombre' class='h5'></span></li>
    <li class='list-group-item " . $baseclass . "fondo'>
        <button onclick='no()' class='btn btn-sm " . $baseclass . "th p-2 m-0 sombra col-5'>
						<img src='inc/fallo.png'>
					</button>
					<button onclick='si()' class='btn btn-sm " . $baseclass . "but2 p-2 m-0 sombra col-5' >
						<img src='inc/acierto.png'>
					</button></li>
                </ul>", 
"text-center p-1 " . $baseclass . "fondo");

$Principal->setPostcode('');

echo $Principal->getCaja();

// CAJA TECLEAR

$Teclear = new Caja('resultado', '', 'bg-warning');

$Teclear->setPrecode('', 'text-dark  sombra text-center');

$Teclear->header = '';

$Teclear->setBody("<ul class='list-group list-group-flush col-11 mx-auto px-1'>
    <li class='list-group-item btn-outline-dark h5' id='idmodelo'></li></ul>", 'bg-warning p-1');

echo $Teclear->getCaja();

echo "</div></div>";

include_once '../inc/footer_fono.inc';

?><script type="text/javascript">

imagenes=imagenes_set.slice(0);
urls=urls_set.slice(0);
iniciaciclo();

//Elige una del conjunto de imágenes y controla el número de palabras empleadas bool=0 nueva imagen, bool=1 nueva palabra modelo
function iniciaciclo(){
	imagenes.length=0;
	urls.length=0;
	imagenes=imagenes_set.slice(0);
	urls=urls_set.slice(0);
	var s = Math.round(Math.random() * (imagenes.length - 1));
	document.getElementById('idmodelo').innerHTML=imagenes[s];
	aleatorio();
}

function bravo(){
	$('#exito').modal('show');
	sleep(1500).then(() =>	{ $('#exito').modal('hide');
	document.getElementById('tecleado').focus();} );
	iniciaciclo();	
}

function aleatorio(){
var r = Math.round(Math.random() * (imagenes.length - 1));

document.getElementById('idimagen').src=urls[r];
document.getElementById('idimagennombre').innerHTML=imagenes[r];
imagenes.splice(r,1);
urls.splice(r,1);

if (imagenes.length < 2) iniciaciclo();
}


// Comprueba cada tecleo para ver si es el correcto
// correcto, añade un intento y un acierto y muestra aplauso
//           Si la palabra está completa, la añade a los logros
// incorrecto, añade un intento y un error y beep
function si(){
	var valor=document.getElementById('idimagennombre').innerHTML;
	if (valor == document.getElementById('idmodelo').innerHTML) {
		acierta(1);
		}
	else falla();
}

function no(){
	var valor=document.getElementById('idimagennombre').innerHTML;
	if (valor == document.getElementById('idmodelo').innerHTML) {
		falla();
		}
	else acierta(0);
}

function acierta(bool){

	var valor=document.getElementById('idimagennombre').innerHTML;
	var intent = document.getElementById('idcontador').innerHTML;
	document.getElementById('idcontador').innerHTML=parseInt(intent)+1;
	var cont = document.getElementById('idaciertos').innerHTML;
	document.getElementById('idaciertos').innerHTML=parseInt(cont)+1;
	if (parseInt(cont) >= (maxaciertos-1)) finturno();
	beep(100, 520, 100); //beep
	beep(100, 520, 200); //beep
	lista=document.getElementById('acumulado').innerHTML;
	document.getElementById('acumulado').innerHTML=lista + "<div class='card border-success text-center text-success p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
	if (bool == 1) bravo();
	else aleatorio();
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