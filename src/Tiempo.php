<?php

namespace TrabajoTarjeta;

class Tiempo implements TiempoInterface {
        /**
     * Devuelve un número que formateado daría el tiempo real.
     *
     * @return int
     */
    public function tiempo() {
        return time();
    }
}