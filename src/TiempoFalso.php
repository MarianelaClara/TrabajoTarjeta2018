<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface {
    
    protected $tiempito;
    protected $feriadito;

    public function __construct($iniciar = 0, $feriado=FALSE) {
        $this->tiempito = $iniciar;
        $this->feriadito = $feriado;
    }

    public function avanzar($futuro) {
        $this->tiempito += $futuro;
    }

    public function retroceder($pasado) {
        $this->tiempito -= $pasado;
    }

    public function obtenerFeriado() {
        return $this->feriadito;
    }

    public function reset() {
        $this->tiempito = 0;
    }
    public function tiempo() {
        return $this->tiempito;
    }
}