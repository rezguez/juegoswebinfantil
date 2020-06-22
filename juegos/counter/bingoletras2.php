<?php

include_once '../inc/head_counter.inc';

function sinacentos($str)
{
    $str = str_replace("Á", "A", $str);
    $str = str_replace("É‰", "E", $str);
    $str = str_replace("Í", "I", $str);
    $str = str_replace("Ó“", "O", $str);
    $str = str_replace("Úš", "U", $str);
    $str = str_replace("ñš", "Ñ", $str);
    return $str;
}

$carpeta = '../palabras';
$directorio = opendir($carpeta); // ruta actual
while ($archivo = readdir($directorio)) // obtenemos un archivo y luego otro sucesivamente
{
    if (! is_dir($archivo) && $archivo != 'Thumbs.db') // verificamos si es o no un directorio
    {
        $archivo2 = explode(".", $archivo);
        $archivo3 = explode(" ", $archivo2[0]);
        $imagenes[] = strtr($archivo3[0], array('Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'ñ' => 'Ñ', 'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u') );
      //  $urls[] = $carpeta . '/' . $archivo;
        
    }
}
$carton = Array();
$numpalabras=3;
$numerototal = 0;
for ($i = 0; $i < $numpalabras; $i++) {
    $num = floor(rand(0, count($imagenes) - 0.1));
    $palabra[$i] = sinacentos(strtoupper($imagenes[$num]));
    $numerototal += strlen($palabra[$i]);
    $carton[$i]= str_split($palabra[$i],1);
}

$matriz = Array();
$secuencia= Array();

for ($i = 65; $i < 91; $i++) {
    $matriz[$i]=chr($i);
}
$secuencia=$matriz;

shuffle($secuencia);


?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->
	
	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->

		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('BINGO DE LETRAS')"
				style='cursor: pointer; margin-bottom: 0px;'>BINGO DE LETRAS</span>
		</div>

		<!-- 		CAJA MATRIZ -->
		<div id='matriz' class='row justify-content-center mt-2'>	
<?php
for ($i = 65; $i < 91; $i ++) {
    echo "<span id='matriz-" . $matriz[$i] . "' class='fichascrabble letrascrabble-sm bg-light' style='opacity:0.4;'>" . $matriz[$i] . "</span>
";
}
?>
</div>

		<!--     SORTEO -->
		<div class='row justify-content-center mt-2'>
			<div class='col-4 text-center'>
				<span id='sorteo' class='letrascrabble-lg celdasorteo sombra'><button
						class='btn btn-success sombra' onclick='empieza()'>
						<img src='../inc/boton-de-play.png'>
					</button></span>
			</div>
		</div>

		<!-- 		CAJA CANVAS -->
<div id='canvas' class='row mt-2'>


<!--   CARTON 1   -->
    <div class='col mx-auto '>
    <div class='row mt-2 p-0 justify-content-center align-items-center'>
    <span class='marca etiquetas bg-secondary'>CARTÓN 1</span>
    </div>
<?php	
for ($c = 0; $c < $numpalabras; $c++) {
    echo "<div  class='row m-0 mt-2 p-0 justify-content-center align-items-center'>";
    for ($i = 0; $i < count($carton[$c]); $i ++) {
        echo "<span id='" .$carton[$c][$i]. "-carton-".floor(rand(0, 10000))."' class='fichascrabble letrascrabble-md bg-light'   onclick='comprueba(this)'>" .$carton[$c][$i]. "</span>";
    }
    echo "</div>";
}		
?>
	    </div>
	    
<!--   CARTON 2   -->
    <div class='col mx-auto '>
        <div class='row  mt-2 p-0 justify-content-center align-items-center'>
        <span class='marca etiquetas bg-primary'>CARTÓN 2</span>
        </div>
<?php	
for ($c = 0; $c < $numpalabras; $c++) {
    echo "<div id='canvas-1' class='row m-0 mt-2 p-0 justify-content-center align-items-center'>";
    for ($i = 0; $i < count($carton[$c]); $i ++) {
        echo "<span id='" .$carton[$c][$i]. "-carton-".floor(rand(0, 10000))."' class='fichascrabble letrascrabble-md bg-light'   onclick='comprueba(this)'>" .$carton[$c][$i]. "</span>";
    }
    echo "</div>";
}		
?>
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
var secuencia = [<?php  foreach ($secuencia as $value) echo "'".$value."', "; ?>];

contador_sorteo =0;

function empieza(){
	document.getElementById('sorteo').childNodes[0].remove;
sorteo();
}

function sorteo() {
	cronometro = setInterval(
		function(){
			sorteonum=secuencia[contador_sorteo];
			habla(sorteonum);
			document.getElementById('sorteo').innerText=sorteonum;
			document.getElementById('matriz-'+sorteonum).style.opacity=1;
			document.getElementById('matriz-'+sorteonum).style.color='white';
			document.getElementById('matriz-'+sorteonum).classList.add("bg-dark");
			contador_sorteo++;
		}
		,4000);
}

function comprueba(elmnt){
		tocado='matriz-'+elmnt.id.slice(0,1);

    if (document.getElementById(tocado).className.search('bg-dark')>0) { 
                    beep(25, 520, 50); //beep
            elmnt.classList.remove("bg-light");
            elmnt.classList.add("bg-success");
			elmnt.classList.add("celdacorrecta");
			

			let correctos = document.getElementsByClassName("celdacorrecta");
			// ver si ya estan todos correctos
			if (correctos.length==numerototal) { 

				beep(100, 520, 200); //beep
				$('#exito').modal('show');
				sleep(2000).then(() =>	{ $('#exito').modal('hide');
				location.reload();} );
		    	
		    }
			
    }
    else  {
        habla("no no");
        }
    
}


</script>