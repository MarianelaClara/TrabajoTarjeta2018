<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaJubiladosTest extends TestCase {
    /**
     * Verifica la tarjeta Jubilados siempre pueda realizar un viaje.
     */
    public function testPagar (){
        $i=0;
        $tarjetaJubilado = new TarjetaJubilados;
        for($i=0;$i<10;$i++){
            $this->assertTrue($tarjetaJubilado->pagar());
        }   
    }
}