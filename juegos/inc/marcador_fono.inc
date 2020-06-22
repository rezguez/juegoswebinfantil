<!-- EMPIEZA marcador --><nav class='navbar navbar-expand-md m-0 p-0 navbar-dark orb'>	<button class='navbar-toggler' type='button' data-toggle='collapse'		data-target='#navbarmarcador'>		<span class='navbar-toggler-icon'></span>	</button>	<a class="navbar-brand h5 ml-4" href="#">Marcador</a>	<div class='collapse navbar-collapse' style="padding-bottom: 0px;"		id='navbarmarcador'>		<ul class="navbar-nav">			<li class="nav-item"><a class="nav-link" data-toggle="collapse"				href="#logroscollapse">Logros</a></li>			<li class="nav-item"><a class="nav-link dropdown-toggle"				id="navresultados" role="button" data-toggle="dropdown">Marcador</a>				<ul class="dropdown-menu">					<span class="dropdown-item">Intentos <span id='idcontador'						class='badge badge-sm badge-primary ml-1 p-1'						style='font-size: 1.2rem;'>0</span></span>					<span class="dropdown-item">Aciertos <span id='idaciertos'						class='badge badge-sm badge-success ml-1 p-1'						style='font-size: 1.2rem;'>0</span></span>					<span class="dropdown-item">Errores <span id='iderrores'						class='badge badge-sm badge-danger ml-1 p-1'						style='font-size: 1.2rem;'>0</span></span>				</ul></li>			<li class="nav-item"><a class="nav-link  dropdown-toggle"				id="navbarDropdown" role="button" data-toggle="dropdown">Condiciones</a>				<div class="dropdown-menu">					<span class="dropdown-item">Nivel: <span						class='marca badge-dark badge-pill' id='nivel'><?php echo $_POST['nivel']; ?></span></span>					<span class="dropdown-item">Min: <span						class='marca badge-dark badge-pill' id='tiempo'><?php echo $_POST['tiempo']; ?></span></span>					<span class="dropdown-item">Palabras: <span						class='marca badge-dark badge-pill' id='palabras'><?php echo $_POST['palabras']; ?></span></span>					<span class="dropdown-item">Aciertos: <span						class='marca badge-dark badge-pill' id='aciertos'><?php echo $_POST['aciertos']; ?></span></span>				</div></li>		</ul>	</div></nav><?php

function sinacentos($str)
{
    $str = str_replace("Á", "A", $str);

    $str = str_replace("É", "E", $str);

    $str = str_replace("Í", "I", $str);

    $str = str_replace("Ó", "O", $str);

    $str = str_replace("Ú", "U", $str);

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

        $imagenes_orig[] = mb_strtoupper($archivo3[0], 'UTF-8');

        $urls_orig[] = $carpeta . '/' . $archivo;
    }
}

// Seleccionamos un grupo de palabras que no se repitan

for ($i = 1; $i <= $_POST['palabras'] + 1; $i ++) {

    $m = floor(rand(0, count($imagenes_orig) - 1));

    $imagenes[$i - 1] = $imagenes_orig[$m];

    $urls[$i - 1] = $urls_orig[$m];

    $imagenes = array_unique($imagenes);

    $urls = array_unique($urls);

    $i = count($imagenes);
}

?>
