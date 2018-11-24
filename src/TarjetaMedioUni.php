<?php

namespace TrabajoTarjeta;

class TarjetaMedioUni extends Tarjeta {
    protected $usoDeMedio = 0;
    protected $diaDeUso;
     /**
     * Le da los parametros iniciales a la tarjeta creada.
     *
     * @param int $id
     *  Siendo este el ID que poseera la tarjeta.
     */
    public function __construct($dia = 1) {
        $this->valor = $this->valor / 2;
        $this->diaDeUso = $dia;
    }

    /**
     * Aumenta en uno la cantidad de medios utilizados.
     */
    public function usarMedio() {
        $this->usoDeMedio++;    
    }
        /**
     * Devuelve la cantidad de medios utilizados en el día.
     *
     * @return int
     *  Siendo este el número de medios que se utilizaron en un día.
     */
    public function obtenerUsoDeMedio() {
        return $this->usoDeMedio;
    }
     /**
     * Actualiza el día en el que se usa la tarjeta y resetea los medios usados.
     *
     * @param string $diaNuevo
     *  Siendo este el día en el que se está usando la tarjeta.
     */
    public function actualizarDia($diaNuevo) {
        $this->diaDeUso = $diaNuevo;
        $this->usoDeMedio = 0;
    }
    /**
     * Devuelve el día en el que se uso la tarjeta la ultima vez.
     *
     * @return string
     *  Ultima fecha en la que se usó la tarjeta.
     */
    public function obtenerDiaDeUso() {
        return $this->diaDeUso;
    }
     /**
     * Paga el transbordo correspondiente a un viaje normal.
     */
    public function normalTransbordo() {
        $this->saldo -= ($this->valor * 2) * 33 / 100;
    }
}