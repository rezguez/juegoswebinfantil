<?php

include_once '../inc/head_counter.inc';
                                                                                                       
$carpeta = '../elementos/campo/';                                                                      
$directorio = opendir($carpeta); // ruta actual                                                        
while ($archivo = readdir($directorio)) // obtenemos un archivo y luego otro sucesivamente             
{                                                                                                      
    if (! is_dir($archivo) && $archivo != 'Thumbs.db') // verificamos si es o no un directorio         
    {                                                                                                  
        $elem_url[] = $carpeta . '/' . $archivo;                                                       
    }                                                                                                  
}                                                                                                      
                                                                                                       
$numerototal = floor(rand(1, 9));                                                                      
$dibujo = floor(rand(0, count($elem_url) - 0.5));  

// CAJA CANVAS
$anchorecipiente = 600;
$izq_recipiente = 0;


$top_recip = 0;
$anchoetiqueta = ($anchorecipiente / 8);
$anchoicono = ($anchoetiqueta);



// audios con los numeros
$div_audios='';
for ($a = 0; $a < 9; $a ++) {
    $div_audios .= "<audio id='audio-myelemento-" . $a . "' src='../elementos/" . ($a + 1) . ".mp3'></audio>\n";
}

//Galería de botones con dibujos
$body = "";
for ($i = 0; $i < count($elem_url); $i ++) {
    $body .= "<button class='btn ".($i==$dibujo ? 'btn-outline-dark' : 'btn-dark')." sombra m-2 p-1' ".($i==$dibujo ? '' : 'disabled')."><img class='img-fluid' id='idimg-" . $i . "' ";
    if ($i == $dibujo)
        $body .= "onclick='copia(this)'";
        $body .= "  src='" . $elem_url[$i] . "' width=50 ></button>\n";
}

?>

	<div class='mainbox  mx-auto'>
		<!-- EMPIEZA mainbox -->
		
		<!-- 		CAJA TITULO -->
		<div class='row p-2 vin justify-content-center mt-0'>
			<a class="col-2  bertateka ml-1" href="index.php">Bertateka</a><span
				class='col titulobarra text-center' onclick='openFullscreen()'
				onmouseover="habla('CUENTA LOS ELEMENTOS')"
				style='cursor: pointer; margin-bottom: 0px;'>CUENTA LOS ELEMENTOS</span>
		</div>

<!-- CAJA CANVAS -->
		<div class='row m-2'>
			<div class='col-12 col-lg-4'>
			<?php 
			echo $div_audios;
			echo $body;
			?>
			</div>
			<div class='col-12 col-lg-8'>

				<div class='row m-1  '>
					<div id='canvas' style='z-index: 90; height: 100px;' class='col-12'></div>
					<div class='row m-1  '>
						<div id='canvas1' style='z-index: 80;' class='col-10'>
							<img id='img-fondo'
								style='z-index: -15; left: <?php echo $izq_recipiente; ?> px; top: <?php echo $top_recip; ?> px; position: relative;'
								class='img-fluid celdaimagen sombra' src='../inc/campo.svg'
								width=<?php echo $anchorecipiente; ?>>
						</div>
						<div id='canvas2' style='z-index: 200;'
							class='col-2 '>
							<img id='img-quiz-fondo'
								class='img-fluid ' src='../elementos/<?php echo $numerototal; ?>.svg'
								width=<?php echo $anchoetiqueta; ?> >
							<img id='img-quiz-tema'
								class='img-fluid celdaimagen' src='<?php echo $elem_url[$dibujo]; ?>'
								width=<?php echo $anchoicono; ?>>

						</div>
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
var numerototal= <?php echo $numerototal; ?>;
var modal_exito = 'exito';

function copia(e) {
	var urlimg = e.src;
	var x = document.getElementById("canvas").innerHTML;
	var moviles = document.getElementsByClassName("movilidad");
	
	var num= moviles.length;
	if (num>=numerototal) return;
	let identificador = "myelemento-" + num;
	let txto = `<img  src='../elementos/${num + 1}.svg' class='numero' width=50>`;
	document.getElementById("canvas").innerHTML = `<div class='movilidad' style='z-index:1${num}; left: ${num*60}px;' id='myelemento-${num}'>${txto}\n
		<img  src='${urlimg}' class='numerado' width=75 style='filter: drop-shadow(5px 5px 5px gray)'></div>${x}`;

//Make the DIV element draggagle:
moviles.forEach(hacerdragables);
		
}


function hacerdragables(value, index) {
	dragElement(document.getElementById("myelemento-"+index));
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

    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    let pos = getPos(elmnt);
    let continente = getPos(document.getElementById('img-fondo'));
    if (pos[0]>continente[0] && pos[1]>continente[1]) { 
        elmnt.classList.add('correcto');
        elmnt.classList.remove('movilidad');
    }
    else {
         elmnt.classList.remove('correcto');
         elmnt.classList.add('movilidad');
    }
  }

  function closeDragElement() {
	 document.getElementById("audio-"+elmnt.id).play();
	 let correctos = document.getElementsByClassName("correcto");
    /* stop moving when mouse button is released:*/
   elmnt.onmouseup = null;
    elmnt.ontouchend = null;
    elmnt.onmousemove = null;
    elmnt.ontouchmove = null;
    if (correctos.length>=numerototal) { 
		beep(100, 520, 100); //beep
		beep(100, 520, 200); //beep
		$('#exito').modal('show');
		sleep(2000).then(() =>	{ $('#exito').modal('hide');
		location.reload();} );
    	
    }
    //document.getElementById(elmnt.id + "header").removeclassName("visible");
  }
}

function getPos(elem){

    var tmp=elem;
    var left=tmp.offsetLeft;
    var top=tmp.offsetTop;
    while (tmp=tmp.offsetParent) left += tmp.offsetLeft;
    tmp=elem;
    while(tmp=tmp.offsetParent) top+=tmp.offsetTop;
    return [left,top];
}

a=new AudioContext(); // browsers limit the number of concurrent audio contexts, so you better re-use'em

function beep(vol, freq, duration){
  v=a.createOscillator()
  u=a.createGain()
  v.connect(u)
  v.frequency.value=freq
  v.type="square"
  u.connect(a.destination)
  u.gain.value=vol*0.01
  v.start(a.currentTime)
  v.stop(a.currentTime+duration*0.001)
}

function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
}
</script>