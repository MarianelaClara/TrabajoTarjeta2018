<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface {
    
    protected $tiempito;
    protected $feriadito;
        /**
     * Se encarga de dar los parametros iniciales al tiempoFalso.
     *
     * @param int $iniciar, bool $feriado.
     *  Siendo estos, un número que indicara en cuanto iniciara el "cronometro" y una bandera indicando si el día es feriado o no.
     */
    public function __construct($iniciar = 0, $feriado = FALSE) {
        $this->tiempito = $iniciar;
        $this->feriadito = $feriado;
    }
    /**
     * Avanza en el tiempo adelantando el "cronometro".
     *
     * @param int $futuro
     *  Indicando el tiempo que se debe avanzar.
     */
    public function avanzar($futuro) {
        $this->tiempito += $futuro;
    }
    /**
     * Retrocede en el tiempo atrazando el "cronometro".
     *
     * @param $pasado.
     *  Indica el tiempo que se debe retroceder.
     */
    public function retroceder($pasado) {
        $this->tiempito -= $pasado;
    }
    /**
     * Devuelve el si el tiempo es feriado o no.
     *
     * @return Bool.
     *  Siendo TRUE si es feriado o FALSE en caso contrario.
     */
    public function obtenerFeriado() {
        return $this->feriadito;
    }
    /**
     * Resetea el contador del tiempo.
     */
    public function reset() {
        $this->tiempito = 0;
    }
        /**
     * Devuelve el contador del "cronometro".
     *
     * @return int
     *  El tiempo transcurrido.
     */
    public function tiempo() {
        return $this->tiempito;
    }
}