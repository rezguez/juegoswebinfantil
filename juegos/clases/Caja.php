<?php
namespace clases;

class Caja

{

    // Atributos
    var $id;

    var $prefijoclase;

    // string con lista clases. La última, el color
    var $precode;

    var $header;

    var $body;

    var $footer;

    var $postcode;

    public function __construct($id, $titulo, $prefijoclase, $class = 'm-0 text-center')
    {
        $this->id = $id;

        $this->prefijoclase = $prefijoclase;

        $this->header = "<div class='card-header $class " . $this->prefijoclase . "'>\n" . $titulo . "</div>\n";
    }

    /**
     *
     * @param mixed $precode
     *
     */
    public function setPrecode($precode, $class = 'card-lg sombra')

    {
        $this->precode = "<!-- ************ CARD $this->id  ************* -->\n<div id='$this->id' class='card $class'>\n" . $precode;
    }

    /**
     *
     * @param mixed $body
     *
     */
    public function setBody($body, $class = 'p-1')

    {
        $this->body = "<div id='" . $this->id . "-body' class='card-body $class'>\n\n" . $body . "\n</div>\n";
    }

    /**
     *
     * @param mixed $footer
     *
     */
    public function setFooter($footer, $class = 'p-1')

    {
        if (is_null($footer)) {

            $this->footer = "";

            return "";
        }

        $this->footer = "<div class='card-footer $class'>" . $footer . "</div>\n";
    }

    /**
     *
     * @param mixed $postcode
     *
     */
    public function setPostcode($postcode)

    {
        $this->postcode = $postcode . "</div>\n<!-- ************ END $this->id  ************* -->";
    }

    public function getCaja()
    {
        return $this->precode . $this->header . $this->body . $this->footer . $this->postcode;
    }
}

class Emergente

{

    // Atributos
    var $id;

    var $prefijoclase;

    // string con lista clases. La última, el color
    var $precode;

    var $header;

    var $body;

    var $footer;

    var $postcode;

    public function __construct($id, $titulo, $prefijoclase, $boton = "<button type='button' class='close btn-dark' data-dismiss='modal'>&times;</button>")

    {
        $this->id = $id;

        $this->prefijoclase = $prefijoclase;

        $this->header = "<div class='modal-header col-12 text-lg-center " . $this->prefijoclase . " h5 mb-0'>" . 
        $titulo . $boton . "</div>";
    }

    /**
     *
     * @param string $precode
     *
     */
    public function setPrecode($precode, $class)

    {
        $this->precode = "<!-- ************ Modal " . $this->id . " ************* -->
<div class='modal fade sombra' id='" . $this->id . "' tabindex='-1' role='dialog'>
	<div class='modal-dialog  $class'	role='document'>" . 
        $precode . "<div class='modal-content'>";
    }

    /**
     *
     * @param mixed $body
     *
     */
    public function setBody($body, $class)

    {
        $this->body = "<div id='" . $this->id . "-body' class='modal-body " . $this->prefijoclase . "fondo $class'>" . $body . "</div>";
    }

    /**
     *
     * @param mixed $footer
     *
     */
    public function setFooter($footer, $class)

    {
        $this->footer = "<div class='modal-footer " . $this->prefijoclase . "fondo $class'>" . $footer . "</div>";
    }

    /**
     *
     * @param mixed $postcode
     *
     */
    public function setPostcode($postcode)

    {
        $this->postcode = $postcode . "</div></div></div>\n<!-- ************ END $this->id  ************* -->";
    }

    public function getEmergente()
    {
        return $this->precode . $this->header . $this->body . $this->footer . $this->postcode;
    }
}
