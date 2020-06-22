

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