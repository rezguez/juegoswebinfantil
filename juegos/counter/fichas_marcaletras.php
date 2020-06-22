<?php

include_once '../inc/head_counter.inc';


$letrasparabuscar = array('A', 'E', 'I', 'O', 'U' );
shuffle($letrasparabuscar);




// cuadrado de 5 x 5  Hay que elegir al azar 25-7 letras distintas de $palabra que se pueden repetir
// y ponerlas en una matriz de divs de (0,0) a (4,4)
// Para evitar conflictos, quito la Ñ

$matriz = Array();

$dificultad=3;
$nivel=Array([0,0], [1,0], [1,1], [2,1], [2,2], [3,2], [3,3], [4,3], [4,4]);
$lado1=4+$nivel[$dificultad][1]; // max=8
$lado2=4+$nivel[$dificultad][0];

$matriztotal=$lado1*$lado2;
$palabra = $letrasparabuscar[0];
$numerototal = floor(rand(5,10.9));

$matriz=array_fill(0, $matriztotal, $palabra);

for ($i = 0; $i < ($matriztotal-$numerototal); $i++) {
    do {
       $matriz[$i] = chr(floor(rand(65 , 90.9)));

    } while ($matriz[$i]==$palabra);
}

shuffle($matriz);

?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->

		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'><span
				class='col titulobarra text-center'>COLOREA Y CUENTA LAS LETRAS IGUALES AL MODELO</span>
		</div>


		<!-- 		CAJA CANVAS -->
		<div id='canvas'
			class='row m-0 mt-2 p-0 justify-content-center align-items-center'>
			<div class='col-2 ml-3' style='max-width: 300px;'>
				<div
					class='row m-0 mt-2 p-0 justify-content-center align-items-center'>
					<span onmouseover="habla('<?php echo $palabra; ?>')"
						class='letrascrabble-lg circular-lg sombra'
						style='cursor: pointer;'><?php echo $palabra; ?></span>
				</div>
				<div
					class='row m-0 mt-2 p-0 justify-content-center align-items-center'>

					<span id='faltan' class='celda letrascrabble-lg'><span style='color:transparent'>9</span></span>
					
				</div>
			</div>
			<div class='col mx-auto '>
		
<?php

for ($i = 0; $i < $lado1; $i ++) {
    echo "<div id='canvas-" . $i . "' class='row m-0 mt-2 p-0 justify-content-center align-items-center'>";
    for ($j = 0; $j < $lado2; $j ++) {
        echo "<div class='col  col-lg-1 m-1 p-0'><span class='circular-md letrascrabble-md bg-light' onmouseover=\"habla('" . $matriz[($i * $lado2 + $j)] . "')\" onclick='comprueba(this)'>" . $matriz[($i * $lado2 + $j)] . "</span>
</div>";
    }

    echo "</div>";
}
?>
	</div>

		</div>
		
		<div class='row p-2 vin justify-content-center mt-5'><span
				class='col titulobarra text-center' style='border-top-style:dashed;'>REPASA LAS LETRAS</span>
		</div>
		<div id='canvas-A' class='row m-0 mt-2 p-0 justify-content-center align-items-center'>		
<?php


    echo "";
    for ($j = 0; $j < $numerototal; $j ++) {
        echo "<div class='col  col-lg-1 m-1 p-0'><span class='fichascrabble letrascrabble-lg bg-light' style='opacity:0.5'>" . $palabra . "</span>
</div>";
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
var dificultad= <?php echo $dificultad; ?>;
var numerototal= <?php echo $numerototal; ?>;
var palabra_bruta = '<?php echo $palabra; ?>';
var palabra = sinacentos(palabra_bruta);


function comprueba(elmnt){

    if (elmnt.innerText == palabra) { 
                    beep(25, 520, 50); //beep
            elmnt.classList.remove("bg-light");
            elmnt.classList.add("bg-success");
			elmnt.classList.add("ok");
			

			let correctos = document.getElementsByClassName("ok");
			document.getElementById('faltan').innerText=parseInt(numerototal-correctos.length);
			// ver si ya estan todos correctos
			if (correctos.length==numerototal) { 

				beep(100, 520, 200); //beep
				$('#exito').modal('show');
				sleep(2000).then(() =>	{ $('#exito').modal('hide');
				location.replace(location.pathname + "?dificultad="+ (dificultad + 1));} );
		    	
		    }
			
    }
    else  {
        beep(50, 500, 50); //beep
        elmnt.classList.remove("bg-light");
        elmnt.classList.add("bg-danger");
        xerror=document.getElementById('errores').innerText;
        document.getElementById('errores').innerText=parseInt(xerror)+1;
        }
    
}


habla('MARCA LAS LETRAS <?php echo $palabra; ?>');
</script>