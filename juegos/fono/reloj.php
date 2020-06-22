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

echo "<div class='col-8 col-md-3 col-sm-4 col-lg-3 mx-auto'>";

// CAJA PRINCIPAL

$Principal = new Caja('iditem', "<span id='reloj' class='marca " . $baseclass . "label p-1'><span id='minutos'>0 m</span> : <span id='segundos'>0 s</span></span>", $baseclass);

$Principal->setPrecode('');

$Principal->setBody("<img id='idimagen' class='card-img-top' src=''>", 'p-1 ' . $baseclass . 'fondo');

$Principal->setFooter("<span id='idimagennombre' class='h4'></span>", 'text-center p-1 ' . $baseclass . 'fondo');

$Principal->setPostcode('');

echo $Principal->getCaja();

// CAJA TECLEAR

$Teclear = new Caja('resultado', '', $baseclass);

$Teclear->setPrecode('', 'text-dark ' . $baseclass . ' sombra');

$Teclear->header = '';

$Teclear->setBody("<div class='input-group-lg'>
<input type='text' class='form-control' id='tecleado' name='tecleado' autofocus></div>", 'm-1 p-1');

echo $Teclear->getCaja();

echo "</div></div>";

include_once '../inc/footer_fono.inc';

?><script>
imagenes=imagenes_orig.slice(0);
urls=urls_orig.slice(0);
aleatorio();

// Elige una del conjunto de imágenes y controla el número de palabras empleadas
function aleatorio(){
	cuentapalabras=cuentapalabras+1;
	if (cuentapalabras >= palabras) finturno();
	var r = Math.round(Math.random() * (imagenes.length - 1));
	document.getElementById('idimagen').src=urls[r];
	document.getElementById('idimagennombre').innerHTML=imagenes[r];
	document.getElementById('tecleado').oninput = function() { comprueba(sinacentos(imagenes[r])) };
}

// Comprueba cada tecleo para ver si es el correcto
// correcto, añade un intento y un acierto y muestra aplauso
//           Si la palabra está completa, la añade a los logros
// incorrecto, añade un intento y un error y beep
function comprueba(valor){
	
	var intent = document.getElementById('idcontador').innerHTML;
	document.getElementById('idcontador').innerHTML=parseInt(intent)+1;
	var x = document.getElementById('tecleado').value;
	x = x.toUpperCase();
	document.getElementById('tecleado').value=x;
	if (x==valor) {
		var cont = document.getElementById('idaciertos').innerHTML;
		if (cont >= maxaciertos) finturno();
		document.getElementById('idaciertos').innerHTML=parseInt(cont)+1;
		beep(100, 520, 100); //beep
		beep(100, 520, 200); //beep
		$('#exito').modal('show');
		sleep(1500).then(() =>	{ $('#exito').modal('hide');
		document.getElementById('tecleado').focus();} );
		document.getElementById('tecleado').value='';
		lista=document.getElementById('acumulado').innerHTML;
		document.getElementById('acumulado').innerHTML=lista + "<div class='card border-success text-center text-success p-1 col-12 col-sm-6 col-md-6 col-lg-4 h6'> "+valor+"</div>";
		aleatorio();
		
	}
	else {
		if (valor.search(x)==0){
			var cont = document.getElementById('idaciertos').innerHTML;
			if (cont >= maxaciertos) finturno();
			document.getElementById('idaciertos').innerHTML=parseInt(cont)+1;
		}
		else {
			var erro = document.getElementById('iderrores').innerHTML;
			document.getElementById('iderrores').innerHTML=parseInt(erro)+1;
			beep(300, 220, 300); //boop
			document.getElementById('tecleado').value=x.slice(0,-1);
		}
		
	}
	
};


</script>