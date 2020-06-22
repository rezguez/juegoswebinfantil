<?php

include_once '../inc/head_counter.inc';

$colores = Array ( 'red', 'cyan', 'magenta', 'yellow');
$numfilas=3;
$nummax=10; //hasta $nummax-1
$anchocarton=4;
$carton = Array();
$matriz = Array();
$listanumeros= Array();
$secuencia= Array();

for ($i = 0; $i < $nummax; $i++) {
    $listanumeros[$i]=$i;
}

for ($c = 0; $c < $numfilas; $c++) {
    $matriz[$c]=$listanumeros;
}

for ($c = 0; $c < $numfilas; $c++) {
    shuffle($listanumeros);
    $temporal=array_slice($listanumeros, 0, $anchocarton);
    sort($temporal);
    $carton[$c]=$temporal;
}
for ($c = 0; $c < $numfilas; $c++) {
    for ($i = 0; $i < $nummax; $i++) {
        $secuencia[]=[$c,$i];
    }
    
}
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
				onmouseover="habla('BINGO DE NÚMEROS')"
				style='cursor: pointer; margin-bottom: 0px;'>BINGO DE NÚMEROS</span>
		</div>


		<!-- MATRIZ -->

<?php
for ($c = 0; $c < $numfilas; $c ++) {
    echo "<div class='row justify-content-center mt-2'>";
    $coloractual = $colores[$c];
    for ($i = 0; $i < $nummax; $i ++) {
        echo "<span id='matriz-$c-$i' class='fichascrabble letrascrabble-sm bg-light' style='color: $coloractual;opacity:0.4;'>" . $matriz[$c][$i] . "</span>
";
    }
    echo "</div>";
}
?>
		<!-- 		CAJA CANVAS -->
		<div class='row justify-content-center align-items-center mt-4'>


			<!--     SORTEO -->

			<div class='col-6 text-center'>
				<span id='sorteo' class='letrascrabble-xl celdasorteo sombra'><button
						class='btn btn-success sombra' onclick='empieza()'>
						<img src='../inc/boton-de-play.png'>
					</button></span>
			</div>



			<!--   CARTON  2 -->
			<div class='col-4 mx-auto '>
    <div class='row mt-2 p-0 justify-content-center align-items-center'>
    <span class='marca etiquetas bg-primary'>CARTÓN 2</span>
    </div>
<?php
for ($c = 0; $c < $numfilas; $c ++) {
    echo "<div id='canvas-1' class='row m-0 mt-2 p-0 justify-content-center align-items-center'>";
    $coloractual = $colores[$c];
    for ($i = 0; $i < $anchocarton; $i ++) {
        echo "<span id='carton-$c-" . $carton[$c][$i] . "' class='fichascrabble letrascrabble-md bg-light' style='color: $coloractual;'  onclick='comprueba(this)'>" . $carton[$c][$i] . "</span>
";
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
<!-- ************ Modal ready ************* -->
<div class='modal fade sombra' id='ready' tabindex='-1' role='dialog'>
	<div class='modal-dialog modal-md '
		role='document'>
		<div class='modal-content'>
			<div class='modal-header text-center bg-warning'>
				<span class='letrascrabble-md'>EMPEZAMOS</span>
			</div>
		</div>
	</div>
</div>
<!-- ************ FIN Modal  exito ************* -->
<!-- End your project here-->


<script type="text/javascript">
var modal_exito = 'exito';
var numfilas= <?php echo $numfilas; ?>;
var anchocarton = '<?php echo $anchocarton; ?>';
var numerototal = numfilas*anchocarton;
var colores = [ 'red', 'cyan', 'magenta', 'yellow'];
var colorespalabra =['rojo', 'azul', 'morado', 'amarillo'];
var secuencia = [<?php 
    foreach ($secuencia as $value) echo "[".$value[0].",".$value[1]."],";
?>];

contador_sorteo =0;

function empieza(){
	document.getElementById('sorteo').childNodes[0].remove;
	document.getElementById('sorteo').innerText='?';
	$('#ready').modal('show');
	habla('EMPEZAMOS');
	sleep(1000).then(() =>	{ $('#ready').modal('hide'); sorteo();} );
}

function sorteo() {
	cronometro = setInterval(
		function(){
			sorteonum=secuencia[contador_sorteo][1];
			sorteocolor=secuencia[contador_sorteo][0];
			habla(sorteonum + " " + colorespalabra[sorteocolor]);
			document.getElementById('sorteo').innerText=sorteonum;
			document.getElementById('sorteo').style.color = colores[sorteocolor];
			document.getElementById('matriz-'+sorteocolor+"-"+sorteonum).style.opacity=1;
			document.getElementById('matriz-'+sorteocolor+"-"+sorteonum).classList.add("bg-dark");
			contador_sorteo++;
			if (contador_sorteo==secuencia.length) { clearInterval(cronometro); }
		}
		,4000);
}

function comprueba(elmnt){
		tocado=elmnt.id.replace("carton", "matriz");

    if (document.getElementById(tocado).className.search('bg-dark')>0) { 
                    beep(25, 520, 50); //beep
            elmnt.classList.remove("bg-light");
            elmnt.classList.add("bg-success");
			elmnt.classList.add("ok");
			

			let correctos = document.getElementsByClassName("ok");
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