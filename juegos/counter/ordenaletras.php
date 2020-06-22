<?php

include_once '../inc/head_counter.inc';


$carpetaletras = '../elementos/letras';


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
        $urls[] = $carpeta . '/' . $archivo;
        
    }
}
do {
$num = floor(rand(0, count($imagenes) - 0.1));
$palabra = sinacentos(strtoupper($imagenes[$num]));
} while (strpos($palabra,'Ñ')!=false);
$palabra_url = $urls[$num];
$numerototal = strlen($palabra);


?>
<div class='container-fluid'>
	<!-- EMPIEZA container -->

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->

		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('ORDENA LAS LETRAS DE <?php echo $palabra; ?>')"
				style='cursor: pointer; margin-bottom: 0px;'>ORDENA LAS LETRAS DE <span
				class='marca fld-WARNING'> <?php echo $palabra; ?> </span></span>
		</div>

		<!-- 		CAJA CANVAS -->

		<div id='canvas'
			class='row justify-content-center align-items-center mt-3'>
			<div class='col mx-auto '>
				<div id='idimagen'
					class='row m-0 p-0 justify-content-center align-items-center'>
					<img class='img-fluid celdaimagen sombra w-75'
						onmouseover="habla('<?php echo $imagenes[$num]; ?>')"
						src='<?php echo $urls[$num]; ?>'
						alt='<?php echo $imagenes[$num]; ?>'>
				</div>
			</div>
			<div class='col-8 mx-auto '>
				<div id='canvas1'
					class='row  justify-content-center align-items-center mt-3' style='min-height: 7vw'>
					</div>
				<div id='canvas2'
					class='row  justify-content-center align-items-center mt-3'>
<?php

for ($i = 0; $i < $numerototal; $i ++) {
    echo "<div name='" . $palabra[$i] . "' id='caja-" . $palabra[$i] . "-" . $i . "'><span class='fichascrabble letrascrabble-lg bg-light' style='opacity:0.4;;'>" . $palabra[$i] . "</span></div>";
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
var palabra = sinacentos(palabra_bruta.toUpperCase());

var lista=[];


for (z=0;z<numerototal; z++) { lista[z]=palabra.charAt(z);}

lista.sort(function(a, b){return 0.5 - Math.random()});

lista.forEach(pintamoviles);

function pintamoviles(value, index) {
		let txto = "";
		document.getElementById("canvas1").innerHTML += "<div class='movilidad '  onclick=\"habla('"+value+"')\" id='myelemento-" + value + "-" + index + "' style='left:" + calculaposini(index) + "vw; filter: drop-shadow(5px 5px 5px gray)'>"+txto+"<span class='letrascrabble-lg' style='cursor: pointer'>"+value+"</span></div>";
	}


	var moviles = document.getElementsByClassName("movilidad");
	var num= moviles.length;
	
//Make the DIV element draggagle:
	moviles.forEach(hacerdragables);
		



function hacerdragables(value, index) {
	dragElement(document.getElementById(value.id));
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
	    tipobj = elmnt.id.substring(11, 12);
	//cajas posibles
		cajasposibles = document.getElementsByName(tipobj);    

    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";

    // busco en las cajas posibles
    cajasposibles.forEach(buscoencajas);
  }

function buscoencajas(value, index){
    //Ver si ha alcanzado la posicion correcta
    pos = getPos(elmnt);
	continente = getPos(value);
    if (pos[0]>(continente[0]-5) && pos[1]>(continente[1]-5) && pos[0]<(continente[0]+30) && pos[1]<(continente[1]+30)) { 
                    beep(25, 520, 50); //beep
                    
            elmnt.removeChild(elmnt.childNodes[0]);
			value.childNodes[0].style.opacity=1;
			elmnt.classList.add("ok"); // etiqueto como correcto para luego contar
			value.classList.add("papel"); 
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


function getPos(elem){

    let tmp=elem;
    let left=tmp.offsetLeft;
    let top=tmp.offsetTop;
    while (tmp=tmp.offsetParent) left += tmp.offsetLeft;
    tmp=elem;
    while(tmp=tmp.offsetParent) top+=tmp.offsetTop;
    return [left,top];
}

}



function calculaposini(num) {
	
	var w = window.innerWidth;
	var izq = parseInt((document.getElementById('idimagen').clientWidth*100)/w);
	var ancho = 76-izq;
	var imgpercent = 4;
	let separation = 2;
	anchototal=(separation + imgpercent)*numerototal;
	espaciovacio = parseInt(70 - anchototal);
	console.log(parseInt(espaciovacio/2)+"-"+espaciovacio+"--"+anchototal);
	return parseInt( parseInt(espaciovacio/2) + parseInt(separation + imgpercent)*num);
// 	var imgpercent = parseInt(5000/w);
// 	var espacio = parseInt(100 - izq - (10 * imgpercent));
// 	let separation = parseInt(espacio/10);
// 	anchototal=(separation + imgpercent)*numerototal;
// 	espaciovacio = parseInt(100 - izq - anchototal);
// 	return izq + parseInt( (espaciovacio/2) + (separation + imgpercent)*num);
}


habla('ORDENA LAS LETRAS DE <?php echo $palabra; ?>');

</script>