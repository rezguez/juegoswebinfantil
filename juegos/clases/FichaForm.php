<?php

class Encabezado
{

    var $titulo;

    var $boton;

    var $tipoboton;

    var $target;

    var $prefijoclase;

    public function __construct($titulo, $boton, $tipoboton, $target, $prefijoclase)
    {
        $this->titulo = $titulo;

        $this->boton = $boton;

        $this->tipoboton = $tipoboton;

        $this->target = $target;

        $this->prefijoclase = $prefijoclase;
    }

    public function getEncabezado()
    {
        $data = '';

        if (is_null($this->boton)) {

            $data = "<h5 style='font-weight: 500;'>$this->titulo</h5>\n";

            return $data;
        }

        $data = "<div class='row'>\n
            <div class='col'> </div>\n
            <div class='col-8'><h5 style='font-weight: 500;'>$this->titulo</h5></div>\n
            <div class='col'>";

        if ($this->target == 'submit') {

            $data .= "<button class='btn btn-md m-0 " . $this->prefijoclase . "but2' " . "type='submit'>$this->boton</button></div>\n</div>\n";
        } else {

            $data .= "<button type='button' class='btn btn-md m-0 " . $this->prefijoclase . "but2' " . "data-toggle='modal' data-target='$this->target'>$this->boton</button></div>\n</div>\n";
        }

        return $data;
    }
}

class FichaCard
{

    // Atributos
    var $id;

    var $Encab;

    var $definition;

    var $header;

    var $body;

    var $footer;

    var $ending;

    // M�todos
    public function __construct($id, $titulo, $boton, $tipoboton, $target, $prefijoclase)
    {
        $this->id = $id;

        $this->Encab = new Encabezado($titulo, $boton, $tipoboton, $target, $prefijoclase);
    }

    public function setDefinition($definition = '')
    {
        $this->definition = "<!-- ************ CARD $this->id  ************* -->\n<div id='$this->id' class='card card-lg sombra'>\n" . $definition;
    }

    public function setHeader()

    {
        $this->header = "<div class='card-header mb-0 text-center " . $this->Encab->prefijoclase . "'>\n" . $this->Encab->getEncabezado() . "</div>\n";
    }

    public function setBody($body)

    {
        $this->body = "<div id='" . $this->id . "-body' style='padding-top: 10px;' class='card-body pb-3 " . $this->Encab->prefijoclase . "fondo'>\n\n" . $body . "\n</div>\n";
    }

    public function setFooter($footer = '')

    {
        if ($footer == '') {

            $this->footer = "";

            return "";
        }

        $this->footer = "<div class='card-footer " . $this->Encab->prefijoclase . "fondo' style='width: 100%'>" . $footer . "</div>\n";
    }

    public function setEnding($ending = '')

    {
        $this->ending = $ending . "</div>\n<!-- ************ END $this->id  ************* -->";
    }

    public function setCard($body, $definition = '', $footer = '', $ending = '')
    {
        $this->setDefinition($definition);

        $this->setHeader();

        $this->setBody($body);

        $this->setFooter($footer);

        $this->setEnding($ending);
    }

    public function getCard()
    {
        return $this->definition . $this->header . $this->body . $this->footer . $this->ending;
    }
}

class FichaModal
{

    // Atributos
    var $id;

    var $Encab;

    var $definition;

    var $header;

    var $body;

    var $footer;

    var $ending;

    var $size = 'lg';

    // M�todos
    public function __construct($id, $titulo, $prefijoclase, $size = 'lg', $boton = '', $tipoboton = '', $target = '')
    {
        $this->id = $id;

        $this->size = $size;

        $this->Encab = new Encabezado($titulo, $boton, $tipoboton, $target, $prefijoclase);
    }

    public function setDefinition($definition = '')
    {
        $this->definition = " <!-- ************ Modal $this->id ************* -->" . 
        "<div class='modal fade sombra' id='$this->id' tabindex='-1' role='dialog'>" . 
        "<div class='modal-dialog modal-$this->size modal-dialog-centered' role='document'>" . 
        "<div class='modal-content'>" . $definition;
    }

    public function setHeader()

    {
        $this->header = "<div class='modal-header text-center " . $this->Encab->prefijoclase . "'><h5 style='font-weight: 500;'>" . $this->Encab->titulo . "</h5></div>";
    }

    public function setBody($body)

    {
        $this->body = "<div style='padding-top: 10px;' class='modal-body pb-3 " . $this->Encab->prefijoclase . "fondo'>\n\n" . $body . "\n</div>\n";
    }

    public function setFooter($footer = '')

    {
        if (is_null($footer)) {

            $this->footer = "";

            return;
        }

        $this->footer = "<div class='modal-footer " . $this->Encab->prefijoclase . "fondo' style='width: 100%'>
            <div>" . $footer . "</div><button class='btn btn-$this->size btn-dark p-2 sombra' class='close' data-dismiss='modal'>
            <img src='inc/repeticion.png'></button> <button class='btn btn-$this->size " . $this->Encab->prefijoclase . " p-2 sombra' type='submit'><img src='inc/boton-de-play.png'></button></div>\n";
    }

    public function setEnding($ending = '')

    {
        $this->ending = $ending . "</div>\n	</div>\n  </div>\n\n
            <!-- ************ FIN Modal  $this->id ************* -->\n\n";
    }

    public function setCard($body, $definition = '', $footer = '', $ending = '')
    {
        $this->setDefinition($definition);

        $this->setHeader();

        $this->setBody($body);

        $this->setFooter($footer);

        $this->setEnding($ending);
    }

    public function getCard()
    {
        return $this->definition . $this->header . $this->body . $this->footer . $this->ending;
    }
}

class Campo
{

    // Atributos
    var $nombre;

    var $tipo;

    // text, date, select, pass
    var $label;

    var $options = [];

    // Array con los valores del select
    var $placeholder;

    var $required = false;

    // boolean
    var $readonly = false;

    // boolean

    // M�todos
    public function Iniciar(array $campo)
    {
        $this->nombre = $campo['nombre'];

        $this->tipo = $campo['tipo'];

        $this->label = $campo['label'];

        $this->placeholder = $campo['placeholder'];

        $this->required = $campo['required'];

        $this->readonly = $campo['readonly'];

        $this->options = $campo['opcionescampo'];

        // $this->options= explode(',', $campo['opcionescampo']); si viene de $tablas_modelo = $TablasModelo->leercampos();
    }
}

class CampoForm
{

    // Atributos
    var $Campo;

    var $display;

    // fila, col, hidden
    var $value = '';

    var $size = '';

    // '' sm lg
    var $class = '';

    // Metodos
    public function __construct(array $campo)
    {
        $this->Campo = new Campo();

        $this->Campo->Iniciar($campo);

        $this->display = $campo['display'];

        $this->setValue($campo['value']);
    }

    public function setEstilo($class, $size)
    {
        $this->size = $size;

        $this->class = $class;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCampoForm()
    {
        if ($this->display == 'fila')
            $data = $this->getCampoFormfila();

        else
            $data = $this->getCampoFormcol();

        return $data;
    }

    public function getCampoFormcol()
    {
        $tamlab = ($this->size != '') ? "col-form-label-" . $this->size : '';

        $tamcon = ($this->size != '') ? "form-control-" . $this->size : '';

        $required = ($this->Campo->required) ? ' required ' : '';

        $readonly = ($this->Campo->readonly) ? ' readonly ' : '';

        if ($this->Campo->tipo != 'sel') {

            $data = "\n<!-- 		Campo col " . $this->Campo->nombre . "	 -->\n" . 
            "<div class='form-group col mb-2 pl-0'>\n" . 
            "<label for='" . $this->Campo->nombre . "' class='col-form-label " . $tamlab . " label pl-2 " . $this->class . "label' style='width:100%; border-top-left-radius: .25rem;border-top-right-radius: .25rem;'>" . 
            $this->Campo->label . "</label>\n" . 
            "<input type='" . $this->Campo->tipo . "' " . $required . $readonly . " class='form-control " . $tamcon . "' name='" . $this->Campo->nombre . "' placeholder='" . $this->Campo->placeholder . "' value='" . $this->value . "'>\n" . 
            "</div>\n\n";
        } 
        else {

            $data = "\n<!-- 		Select col " . $this->Campo->nombre . "	 -->\n";

            $data .= "<div class='form-group col mb-2 pl-0'>";

            $data .= "<label for='" . $this->Campo->nombre . "' class='col-form-label " . $tamlab . " mb-0 label pl-2 " . $this->class . "label' style=' border-top-left-radius: .25rem;border-top-right-radius: .25rem; width:100%;'>" . $this->Campo->label . "</label>";

            $data .= "<select $required class='form-control " . $tamcon . "' name='" . $this->Campo->nombre . "' " . $readonly . ">\n";

            foreach ($this->Campo->options as $ops) {

                $data .= "<option ";

                if ($ops == $this->value) {

                    $data .= " selected='selected'";
                }

                $data .= ">" . $ops . "</option>\n";
            }

            $data .= "</select>\n</div>\n";
        }

        return $data;
    }

    public function getCampoFormfila()
    {
        $tamlab = ($this->size != '') ? "col-form-label-" . $this->size : '';

        $tamcon = ($this->size != '') ? "form-control-" . $this->size : '';

        $tamgroup = ($this->size != '') ? "input-group-" . $this->size : '';

        $required = ($this->Campo->required) ? ' required ' : '';

        $readonly = ($this->Campo->readonly) ? ' readonly ' : '';

        if ($this->Campo->tipo != 'sel') {

            $data = "\n<!-- 		Campo fila " . $this->Campo->nombre . "	 -->\n" . 
            "<div class='input-group " . $tamgroup . " mb-3 pl-0 pr-3'>\n" . 
            "<div class='input-group-prepend col-2 pl-0 pr-0'><div class='input-group-text " . $this->class . "label col col-form-label " . $tamlab . "' style='border-top-right-radius: 0; border-bottom-right-radius: 0;'>" . $this->Campo->label . "</div></div>\n" . 
            "<input type='" . $this->Campo->tipo . "' " . $required . " class='form-control " . $tamcon . "' name='" . $this->Campo->nombre . "' placeholder='" . $this->Campo->placeholder . "' value='" . $this->value . "' " . $readonly . ">\n" . 
            " </div>\n\n";
        } else {

            $data = "<!-- 		Select fila " . $this->Campo->nombre . "	 -->\n";

            $data .= "<div class='input-group " . $tamgroup . " mb-3 pr-3'>\n";

            $data .= "<div class='input-group-prepend col-2 pl-0 pr-0'><span class='input-group-text " . $this->class . "label col col-form-label " . $tamlab . "' style='border-top-right-radius: 0; border-bottom-right-radius: 0;'>" . $this->Campo->label . "</span></div>\n";

            $data .= "<select " . $required . " class='form-control " . $tamcon . "' name='" . $this->Campo->nombre . "' " . $readonly . ">\n";

            foreach ($this->Campo->options as $ops) {

                $data .= "<option ";

                if ($ops == $this->value) {

                    $data .= " selected='selected'";
                }

                $data .= ">" . $ops . "</option>\n";
            }

            $data .= "</select>\n</div>\n";
        }

        return $data;
    }
}

class FilaForm
{

    var $col = [];

    var $size;

    var $class;

    var $anchocol = [];

    public function __construct($class = '', $size = '')
    {
        $this->class = $class;

        $this->size = $size;
    }

    public function addCol(Campoform $Campoform, $anchocol = 0)
    {
        $this->col[] = $Campoform;

        $this->anchocol[] = $anchocol;
    }

    public function getFilaForm()
    {
        $data = "<div class='row mx-auto'>\n";

        foreach ($this->col as $key => $value) {

            $colclass = ($this->anchocol[$key] != 0) ? "col pl-0 pr-0 col-" . $this->anchocol[$key] : 'col pl-0 pr-0';

            $value->setEstilo($this->class, $this->size);

            $data .= "<div class='" . $colclass . "'>";

            $data .= $value->getCampoForm();

            $data .= "</div>\n";
        }

        $data .= "</div>\n";

        return $data;
    }
}

class Form
{

    var $idform;

    var $action;

    var $size;

    var $class;

    var $filas = [];

    var $onsubmit = '';

    var $metodo = 'post';

    var $botones = [
        "no" => "CANCELAR",
        "yes" => "GUARDAR"
    ];

    public function __construct($idform, $action, $size, $class, $onsubmit = '', $metodo = 'post', $botones = [
        "no" => "CANCELAR",
        "yes" => "GUARDAR"
    ])
    {
        $this->idform = $idform;

        $this->action = $action;

        $this->size = $size;

        $this->class = $class;

        $this->onsubmit = $onsubmit;

        $this->metodo = $metodo;

        $this->botones = $botones;
    }

    public function addFilas(FilaForm $Filaform)
    {
        $this->filas[] = $Filaform;
    }

    public function generate_form($tabla_campos)
    {
        for ($i = 1; $i < count($tabla_campos) + 1; $i ++) {

            if ($tabla_campos[$i]['ordenform'] != '0')
                $camposform[($tabla_campos[$i]['ordenform'])] = new CampoForm($tabla_campos[$i]);
        }

        $n = - 1;

        $m = 0;

        for ($i = 0; $i < count($camposform); $i ++) {

            if ($m == 0 or $camposform[$i + 1]->display == 'fila') {

                $n ++;

                $fila[$n] = new FilaForm();

                $fila[$n]->addCol($camposform[$i + 1]);
            } 
            else
                $fila[$n]->addCol($camposform[$i + 1]);

            if ($camposform[$i + 1]->display == 'fila')
                $m = 0;

            else {

                $m ++;

                if ($m > 3) {

                    $m = 0;
                }
            }
        }

        foreach ($fila as $value) {

            $this->addFilas($value);
        }
    }

    public function getInicioForm()
    {
        $submit = ($this->onsubmit != '') ? "onsubmit=" . chr(34) . $this->onsubmit . chr(34) : "";

        $data = "\n<!-- ****** Fomulario " . $this->idform . " ***** -->\n";

        $data .= "<form role='form' method='" . $this->metodo . "' " . $submit . " id='" . $this->idform . "' action='" . $this->action . "'>\n";

        return $data;
    }

    public function getBodyForm()
    {
        $data = '';

        foreach ($this->filas as $value) {

            if ($value->class == '')
                $value->class = $this->class;

            if ($value->size == '')
                $value->size = $this->size;

            $data .= $value->getFilaForm();
        }

        return $data;
    }

    public function getFinalForm()
    {
        $data = "\n</form>\n<!-- ****** Final del Fomulario " . $this->idform . " ***** -->\n";

        return $data;
    }

    public function getForm()
    {
        $data = $this->getInicioForm() . $this->getBodyForm() . $this->getFinalForm();

        return $data;
    }
}

class FormModal
{

    var $Form;

    var $FichaModal;

    public function __construct(Form $Form, FichaModal $FichaModal)
    {
        $this->Form = $Form;

        $this->FichaModal = $FichaModal;
    }

    public function setFormModal()
    {
        $this->FichaModal->setDefinition($this->Form->getInicioForm());

        $this->FichaModal->setHeader();

        $this->FichaModal->setBody($this->Form->getBodyForm());

        $this->FichaModal->setFooter('');

        $this->FichaModal->setEnding($this->Form->getFinalForm());
    }

    public function getFormModal()
    {
        $this->setFormModal();

        $data = $this->FichaModal->getCard();

        return $data;
    }
}

class FormCard
{

    var $Form;

    var $FichaCard;

    public function __construct(Form $Form, FichaCard $FichaCard)
    {
        $this->Form = $Form;

        $this->FichaCard = $FichaCard;
    }

    public function setFormCard($footer)
    {
        $this->FichaCard->setDefinition($this->Form->getInicioForm());

        $this->FichaCard->setHeader();

        $this->FichaCard->setBody($this->Form->getBodyForm());

        $this->FichaCard->setFooter($footer);

        $this->FichaCard->setEnding($this->Form->getFinalForm());
    }

    public function getFormCard()
    {
        $data = $this->FichaCard->getCard();

        return $data;
    }
}

class AccordionCard
{

    // Atributos
    var $id;

    var $parent;

    var $header;

    var $body;

    var $footer;

    // M�todos
    public function __construct($id, $titulo, $parent, $prefijoclase)
    {
        $this->id = $id;

        $this->titulo = $titulo;

        $this->parent = $parent;

        $this->prefijoclase = $prefijoclase;
    }

    public function setHeader()

    {
        $this->header = "<!-- ************ ACORDION CARD $this->id  ************* -->\n
                        <div id='$this->id' class='card '>\n
                            <div class='card-header m-0 p-0 text-center " . $this->prefijoclase . "'>\n
                                <button class='btn  collapsed " . $this->prefijoclase . "but2' type='button'
				                    data-toggle='collapse' data-target='#" . $this->id . "-body'>" . $this->titulo . "</button></div>\n";
    }

    public function setBody($body, $footer)

    {
        $this->setFooter($footer);

        $this->body = "<div id='" . $this->id . "-body' class='collapse' data-parent='#" . $this->parent . "'><div class='card-body py-2 " . $this->prefijoclase . "fondo'>\n\n" . $body . $this->footer . "\n</div>\n</div>\n";
    }

    public function setFooter($footer)

    {
        $this->body = "<div class='card-footer py-2 " . $this->prefijoclase . "fondo'>\n\n" . $footer . "\n</div>\n";
    }

    public function getCard($body)
    {
        $this->setHeader();

        $this->setBody($body);

        return $this->header . $this->body;
    }
}

class TabGroupCard
{

    // Atributos
    var $tabs = [];

    var $parent;

    var $header;

    var $body;

    // M�todos
    public function __construct($id, array $tabs, $prefijoclase)
    {
        $this->id = $id;

        $this->prefijoclase = $prefijoclase;

        foreach ($tabs as $value) {

            $this->tabs[] = $value;
        }
    }

    public function setHeader()

    {
        $this->header = "<!-- ************ TAB GROUP CARD $this->id  ************* -->\n
                        <div id='$this->id' class='card sombra'>\n
                            <div class='card-header m-0 p-0 text-center " . $this->prefijoclase . "'>\n
                                <nav id='" . $this->id . "' class='nav nav-pills nav-fill'>\n";

        foreach ($this->tabs as $val) {

            $this->header .= "<button class='btn nav-item collapsed " . $this->prefijoclase . "but2' type='button'
				                    data-toggle='collapse' data-target='#" . $val->id . "-body'>" . $val->titulo . "</button>\n";
        }

        $this->header .= "</nav></div>\n";
    }

    public function getTabGroupCard()
    {
        $this->setHeader();

        return $this->header;
    }
}

?>
