<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    protected $valor;

    public function __construct() {
        $this->valor= $this->obtenerValor()/2;
    }

}