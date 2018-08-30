<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    public function __construct() {
        $this->valor = $this->valor /2;
    }
}