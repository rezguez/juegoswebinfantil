<?php
include_once '../inc/head_fono.inc';

include_once '../inc/main_fono.inc';

// Variables de configuracion

$baseclass = 'orb';

?>


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