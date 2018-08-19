<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    public $valor;

    public function __construct() {
        $orginal= (new tarjeta)->valor;
        $this->valor=$orginal/2;
    }

}