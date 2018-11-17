<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    public $ultimoViaje = 0;
    protected $tiempoEspera = 60 * 5;

    public function __construct($id = 1) {
        $this->valor = $this->valor / 2;
        $this->id = $id;
    }

    public function obtenerTiempoEspera() {
        return $this->tiempoEspera;
    }

}