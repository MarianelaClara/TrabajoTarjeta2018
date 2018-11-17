<?php

namespace TrabajoTarjeta;

class Tiempo implements TiempoInterface {
    public function tiempo() {
        return time();
    }
}