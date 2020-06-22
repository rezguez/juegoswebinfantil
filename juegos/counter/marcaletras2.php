<?php

include_once '../inc/head_counter.inc';

function sinacentos($str)
{
    $str = str_replace("Á", "A", $str);
    $str = str_replace("É‰", "E", $str);
    $str = str_replace("Í", "I", $str);
    $str = str_replace("Ó“", "O", $str);
    $str = str_replace("Úš", "U", $str);
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
        $urls[] = $carpeta . '/' . $archivo;
        
    }
}

$num = floor(rand(0, count($imagenes) - 0.1));
$matriz=str_split(sinacentos(strtoupper($imagenes[$num])),1);
$letrasparabuscar = array_unique($matriz);
shuffle($letrasparabuscar);
$palabra=$letrasparabuscar[0];
$numerototal=count(array_intersect($matriz, array($palabra)));


?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->


		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('MARCA LAS LETRAS <?php echo $palabra; ?>')"
				style='cursor: pointer; margin-bottom: 0px;'>MARCA LAS LETRAS <span
				class='marca fld-WARNING'> <?php echo $palabra; ?> </span></span>
		</div>
		<!-- 		CAJA CANVAS -->

		<div id='canvas'
			class='row justify-content-center align-items-center mt-3'>
			<div class='col'>
				<div class='row m-0 mt-2 p-0 justify-content-center align-items-center'>
					<span onmouseover="habla('<?php echo $palabra; ?>')"
						class='letrascrabble-xl celdasorteo sombra'
						style='cursor: pointer;'><?php echo $palabra; ?></span>
				</div>
			</div>

			<div class='col-9 mx-auto '>
				<div id='idimagen'
					class='row m-0 p-0 justify-content-center align-items-center'>
					<img class='img-fluid celdaimagen sombra w-25'
						onmouseover="habla('<?php echo $imagenes[$num]; ?>')"
						src='<?php echo $urls[$num]; ?>'
						alt='<?php echo $imagenes[$num]; ?>'>
				</div>
				<div id='canvas-1'
					class='row m-0 p-0 justify-content-center align-items-center'>
		
<?php
for ($i = 0; $i < count($matriz); $i ++) {
    echo "<span id='$i' class='fichascrabble letrascrabble-lg bg-light' onmouseover=\"habla('" . $matriz[$i] . "')\" onclick='comprueba(this)'>" . $matriz[$i] . "</span>
";
 
}
?>
    </div>
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
var palabra_bruta = '<?php echo $palabra; ?>';
var palabra = sinacentos(palabra_bruta);



function comprueba(elmnt){

    if (elmnt.innerText == palabra) { 
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
        beep(50, 500, 50); //beep
        elmnt.classList.remove("bg-light");
        elmnt.classList.add("bg-danger");
        }
    
}



habla('MARCA LAS LETRAS <?php echo $palabra; ?>');

</script>