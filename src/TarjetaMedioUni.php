<?php

namespace TrabajoTarjeta;

class TarjetaMedioUni extends Tarjeta {
    protected $usoDeMedio = 0;
    protected $diaDeUso;
 
    public function __construct($dia = 1) {
        $this->valor = $this->valor / 2;
        $this->diaDeUso = $dia;
    }
    public function usarMedio() {
        $this->usoDeMedio++;    
    }
    public function obtenerUsoDeMedio() {
        return $this->usoDeMedio;
    }
 
    public function actualizarDia($diaNuevo) {
        $this->diaDeUso = $diaNuevo;
        $this->usoDeMedio = 0;
    }

    public function obtenerDiaDeUso() {
        return $this->diaDeUso;
    }
    public function normalTransbordo() {
        $this->saldo -= ($this->valor * 2) * 33 / 100;
    }
}