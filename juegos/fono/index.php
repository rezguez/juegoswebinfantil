<?php
include_once '../inc/head_fono.inc';

include_once '../inc/main_fono.inc';

// Variables de configuracion

$baseclass = 'orb';

?><div class='col-11 col-md-9 col-sm-10 col-lg-8 mx-auto'>	<!-- ************ CARD config  ************* -->	<div id='config' class='card card-lg sombra'>		<!-- ****** Fomulario edit_lector ***** -->		<form role='form' method='post' onsubmit="cambiajuego()"			id='edit_lector' action=''>			<input id="player" name='player' type="hidden" value='USER'>			<div class='card-header mb-0 text-center <?php echo $baseclass; ?>'>				<h5 style='font-weight: 500;'>CONFIGURAR</h5>			</div>			<div id='config-body' style='padding-top: 10px;'				class='card-body pb-3 <?php echo $baseclass; ?>fondo'>				<div class='row mx-auto mb-3'>					<!-- 		Select col juego	 -->					<div class='col-12 col-sm-12 col-md-12 col-lg-2 '>						<span							class="input-group-text <?php echo $baseclass; ?>label mb-1 pl-1">Juego</span>					</div>					<div class='col-12 col-sm-12 col-md-12 col-lg-9 ml-3'>						<input id="juego" data-slider-value='3' class='form-control oxb'							style='width: 95%' name='juego' type="text"							data-slider-handle="round" data-slider-ticks="[1, 2, 3, 4, 5]"							data-slider-ticks-snap-bounds="100"							data-slider-ticks-labels="['Nombra','Localiza', 'Teclea', 'Busca', 'Frases']" />					</div>				</div>				<div class='row mx-auto mb-2'>					<!-- 		Select col nivel	 -->					<div class='col-12 col-sm-12 col-md-12 col-lg-2 '>						<span							class="input-group-text <?php echo $baseclass; ?>label mb-1 pl-1">Nivel</span>					</div>					<div class='col-12 col-sm-12 col-md-12 col-lg-9 ml-3'>						<input id="nivel" data-slider-value='3' class='form-control'							style='width: 50%;' name='nivel' type="text"							data-slider-handle="square" data-slider-ticks="[3, 4, 5]"							data-slider-ticks-snap-bounds="100"							data-slider-ticks-labels='["3", "4", "5"]' />					</div>				</div>				<div class='row mx-auto mb-3'>					<!-- 		Select col tiempo	 -->					<div class='col-12 col-sm-12 col-md-12 col-lg-2 '>						<span							class="input-group-text <?php echo $baseclass; ?>label mb-1 pl-1">Tiempo</span>					</div>					<div class='col-12 col-sm-12 col-md-12 col-lg-9 ml-3'>						<input id="tiempo" data-slider-value='3'							class='form-control col-10 ' style='width: 95%' name='tiempo'							type="text" data-slider-ticks="[0 ,1 ,2 ,3, 4, 5]"							data-slider-ticks-snap-bounds="100"							data-slider-ticks-labels="['0', '1', '2', '3', '4', '5']" />					</div>				</div>				<div class='row mx-auto mb-3'>					<!-- 		Select col palabras	 -->					<div class='col-12 col-sm-12 col-md-12 col-lg-2 '>						<span							class="input-group-text <?php echo $baseclass; ?>label mb-1 pl-1">Palabras</span>					</div>					<div class='col-12 col-sm-12 col-md-12 col-lg-9 ml-3'>						<input id="palabras" data-slider-value='4' class='form-control'							style='width: 95%' name='palabras' type="text"							data-slider-handle="diamond"							data-slider-ticks="[3, 4, 5, 10, 15]"							data-slider-ticks-snap-bounds="100"							data-slider-ticks-labels="['3','4', '5', '10', '15']" />					</div>				</div>				<div class='row mx-auto mb-3'>					<!-- 		Select col aciertos	 -->					<div class='col-12 col-sm-12 col-md-12 col-lg-2 '>						<span							class="input-group-text <?php echo $baseclass; ?>label mb-1 pl-1">Aciertos</span>					</div>					<div class='col-12 col-sm-12 col-md-12 col-lg-9 ml-3'>						<input id="aciertos" data-slider-value='20' type="text"							name='aciertos' class='form-control col-10' style='width: 95%'							data-slider-ticks="[10, 20, 30, 40, 50, 60, 70, 80, 90, 100]"							data-slider-ticks-snap-bounds="100"							data-slider-ticks-labels="['10', '20', '30', '40', '50', '60', '70', '80', '90', '100']" />					</div>				</div>				<div class='card-footer <?php echo $baseclass; ?>fondo'					style='width: 100%'>					<div class='col-12 m-0 px-0'>						<button							class='btn  col-sm-12 <?php echo $baseclass; ?> p-2 sombra'							type='submit'>							<img src='inc/boton-de-play.png'>						</button>					</div>				</div>				</form>		<!-- ****** Final del Fomulario edit_lector ***** -->	</div>	<!-- ************ END config  ************* --></div></div></div></div></div></main><!-- End your project here--><!-- jQuery --><script type="text/javascript" src="js/jquery.min.js"></script><!-- Bootstrap tooltips --><script type="text/javascript" src="js/popper.min.js"></script><!-- Bootstrap core JavaScript --><script type="text/javascript" src="js/bootstrap.min.js"></script><!-- MDB core JavaScript --><script type="text/javascript" src="js/mdb.min.js"></script><!-- Slider Bootstrap JavaScript --><script type="text/javascript" src="js/bootstrap-slider.min.js"></script><!-- Mis scpts --><script type="text/javascript" src="js/berta.js"></script><!-- Your custom scripts (optional) --><script>


function cambiajuego() {
	var destinos = { 1:'nombra.php', 
		2:'localiza.php', 
		3:'reloj.php',
		4:'busca.php' , 
		5:'frases.php' };

	var x = document.getElementById("edit_lector");
	x.action= destinos[x.elements.namedItem('juego').value];
}


var slider = new Slider("#nivel", {
	id: 'nivel',
    ticks: [3,4,5],
    ticks_labels: ['3', '4', '5'],
    ticks_snap_bounds: 100
});

var slider = new Slider("#tiempo", {
	id: 'tiempo',
    ticks: [0,1,2,3,4,5],
    ticks_labels: ['0', '1', '2', '3', '4', '5'],
    ticks_snap_bounds: 10,
    width: '50%'
});

var slider = new Slider("#palabras", {
	id: 'palabras',
    ticks: [3, 4, 5, 10, 15, 20],
    ticks_positions: [0, 12, 25, 50, 75, 100],
    ticks_labels: ['3','4', '5', '10', '15', '20'],
    ticks_snap_bounds: 100
});

var slider = new Slider("#juego", {
	id: 'juego',
    ticks: [1, 2, 3, 4, 5],
    ticks_labels: ['Nombra','Localiza', 'Teclea', 'Busca', 'Frases'],
    ticks_snap_bounds: 100
});

var slider = new Slider("#aciertos", {
	id: 'aciertos',
    ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
    ticks_labels: ['10', '20', '30', '40', '50', '60', '70', '80', '90', '100'],
    ticks_snap_bounds: 100
});

</script>