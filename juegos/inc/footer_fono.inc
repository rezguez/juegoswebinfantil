<?php
use clases\Caja;

use clases\Emergente;

// CAJA logros

echo "<div id='logroscollapse' class='collapse col-10 col-sm-6 col-md-4 col-lg-4 col-xl-4 mx-auto'>";

$Logros = new Caja('idlogros', 'LOGROS', $baseclass, '');

$Logros->setPrecode('');

$Logros->setBody("<div id='acumulado' class='row'> </div>", $baseclass . 'fondo');

$Logros->setPostcode('');

echo $Logros->getCaja();

echo "</div>";

echo "</div>
</div>
</main>";

// FICHA EMERGENTE EXITO

$Exito = new Emergente('exito', 'Felicidades', $baseclass);

$Exito->setPrecode('', "col-8 col-sm-8 col-md-4 col-lg-3 col-xl-3 modal-dialog-centered mx-auto");

$Exito->setBody("Has completado la palabra
<div class='mx-auto'><img class='card-img mx-auto d-block' src='../inc/bravo.gif' style='width:150px;'></div>", 
'p-0 pb-3 m-0 ' . $baseclass . 'fondo');

$Exito->setPostcode('');

echo $Exito->getEmergente();

// FICHA EMERGENTE DESPEDIDA

$Despedida = new Emergente('despedir', 'COMPLETADO', $baseclass);

$Despedida->setPrecode("<form action='index.php' class='col-10 col-sm-8 col-md-8 col-lg-8 col-xl-8'>", "modal-dialog-centered mx-auto");

$Despedida->setBody('', ' p-0 pb-3 m-0 ' . $baseclass . 'th');

$Despedida->setFooter("<button onclick='repetir()' class='btn btn-sm btn-dark p-2 sombra col-5 close'
						data-dismiss='modal'>
						<img src='inc/repeticion.png'>
					</button>
					<button class='btn btn-sm $baseclass p-2 sombra col-5' type='submit'>
						<img src='inc/boton-de-play.png'>
					</button>", $baseclass . 'fondo col-12');

$Despedida->setPostcode('</form>');

echo $Despedida->getEmergente();

?><!-- End your project here--><!-- Mis scpts --><script type="text/javascript" src="../js/berta.js"></script><!-- Your custom scripts (optional) --><script>
// variables imagen orig y set (subconjunto)
<?php

echo "var imagenes_orig = [";

for ($i = 0; $i < count($imagenes_orig); $i ++) {

    echo "'" . $imagenes_orig[$i] . "',";
}

echo "];\n
var urls_orig = [";

for ($i = 0; $i < count($imagenes_orig); $i ++) {

    echo "'" . $urls_orig[$i] . "',";
}

echo "];\n
";

echo "var imagenes_set = [";

for ($i = 0; $i < $_POST['palabras']; $i ++) {

    echo "'" . $imagenes[$i] . "',";
}

echo "];\n
var urls_set = [";

for ($i = 0; $i < $_POST['palabras']; $i ++) {

    echo "'" . $urls[$i] . "',";
}

echo "];\n
";

?>

</script>