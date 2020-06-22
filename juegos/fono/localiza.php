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

$num[0] = floor(rand(0, count($imagenes) - 1));

$num[1] = floor(rand(0, count($imagenes) - 1));

$num[2] = floor(rand(0, count($imagenes) - 1));

$num[3] = floor(rand(0, count($imagenes) - 1));

$objetivo = floor(rand(0, 3.9));

echo "<div class='row '>";

echo "<div class='col-10 col-md-8 col-sm-8 col-lg-4 mx-auto'>";

// CAJA PRINCIPAL

$Principal = new Caja('iditem', "<span id='reloj' class='marca " . $baseclass . "label p-1'><span id='minutos'>0 m</span> : <span id='segundos'>0 s</span></span>", $baseclass);

$Principal->setPrecode('');

$colores = [
    'bg-primary',
    'bg-secondary',
    'bg-warning',
    'bg-danger'
];

for ($i = 0; $i <= 3; $i ++) {

    $body[$i] = "<div class='col  m-1 '>
                        <a id='link-" . $i . "' onclick='compara_" . $i . "()'>
                        <img id='idimagen-" . $i . "' class='card-img-top' src='' ><div id='nombre-" . $i . "' class='" . $colores[$i] . " font-weight-bold'></div></a>
                        
                       </div>";
}

$Principal->setBody("<div class='row text-center m-1'>" . $body[0] . $body[1] . "</div><div class='row text-center m-1'>" . $body[2] . $body[3] . "</div>", "p-1 " . $baseclass . "fondo");

$Principal->setFooter("<span id='idimagennombre' class='h4 text-dark  font-weight-bold'></span>", "text-center p-1 " . $baseclass . "fondo");

$Principal->setPostcode('');

echo $Principal->getCaja();

echo "</div>";

include_once '../inc/footer_fono.inc';

?><script>

imagenes=imagenes_orig.slice(0);
urls=urls_orig.slice(0);
// Inicia el primer cuarteto de palabras
aleatorio();



// Elige una del conjunto de imágenes y controla el número de palabras empleadas
function aleatorio(){
	cuentapalabras=cuentapalabras+1;
	if (cuentapalabras > palabras) finturno();

var modelo = Math.floor(Math.random() * 4);

var i;
var r=[];
for (i = 0; i < 4; i++) { 
	r[i] = Math.floor(Math.random() * (imagenes.length));
	document.getElementById('idimagen-' + i ).src=urls[r[i]];
	document.getElementById('nombre-' + i ).innerHTML=imagenes[r[i]];
}

document.getElementById('idimagennombre').innerHTML=imagenes[r[modelo]];

}



// Comprueba cada tecleo para ver si es el correcto
// correcto, añade un intento y un acierto y muestra aplauso
//           Si la palabra está completa, la añade a los logros
// incorrecto, añade un intento y un error y beep
function compara_0() {
	if (document.getElementById('nombre-0').innerHTML == document.getElementById('idimagennombre').innerHTML) acierta();
	else falla();
}

function compara_1() {
	if (document.getElementById('nombre-1').innerHTML == document.getElementById('idimagennombre').innerHTML) acierta();
	else falla();
}

function compara_2() {
	if (document.getElementById('nombre-2').innerHTML == document.getElementById('idimagennombre').innerHTML) acierta();
	else falla();
}

function compara_3() {
	if (document.getElementById('nombre-3').innerHTML == document.getElementById('idimagennombre').innerHTML) acierta();
	else falla();
}


function compara(val,ref){
	if (val==ref) acierta();
	else falla();
}

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
	document.getElementById('acumulado').innerHTML=lista + "<div class='card border-success font-weight-bold text-center text-success p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
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
	document.getElementById('acumulado').innerHTML=lista + "<div class='card border-danger font-weight-bold text-center text-danger p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
	aleatorio();
}


</script>