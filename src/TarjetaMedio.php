<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    public $ultimoViaje= 0;
    protected $tiempoEspera= 60*5;

    public function __construct() {
        $this->valor = $this->valor /2;
    }

    public function obtenerTiempoEspera(){
        return $this->tiempoEspera;
    }

}