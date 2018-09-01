<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
}
