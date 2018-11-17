<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface {
    
    protected $tiempito;
    
    public function __construct($iniciar = 0) {
        $this->tiempito = $iniciar;
    }

    public function avanzar($futuro) {
        $this->tiempito += $futuro;
    }

    public function retroceder($pasado) {
        $this->tiempito -= $pasado;
    }

    public function reset() {
        $this->tiempito = 0;
    }
    public function tiempo() {
        return $this->tiempito;
    }
}