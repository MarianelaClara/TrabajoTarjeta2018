<?php

namespace TrabajoTarjeta;

class TarjetaMedio extends Tarjeta {
    public $ultimoViaje = 0;
    protected $tiempoEspera = 60 * 5;
    /**
     * Le da los parametros iniciales a la tarjeta.
     *
     * @param int $id.
     *  Siendo este el id de la tarjeta creada.
     */
    public function __construct($id = 1) {
        $this->valor = $this->valor / 2;
        $this->id = $id;
    }
    /**
     * Devuelve el tiempo que se debe esperar para poder utilizar el medio boleto otra vez.
     * 
     * @return float.
     *  La cantidad de minutos que se deben esperar.
     */
    public function obtenerTiempoEspera() {
        return $this->tiempoEspera;
    }

}