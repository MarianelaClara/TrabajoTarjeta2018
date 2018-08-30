<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tarjeta = new Tarjeta;

        $this->assertTrue($tarjeta->recargar(10));
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $this->assertTrue($tarjeta->recargar(20));
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);

        $this->assertTrue($tarjeta->recargar(30));
        $this->assertEquals($tarjeta->obtenerSaldo(), 60);

        $this->assertTrue($tarjeta->recargar(50));
        $this->assertEquals($tarjeta->obtenerSaldo(), 110);

        $this->assertTrue($tarjeta->recargar(100));
        $this->assertEquals($tarjeta->obtenerSaldo(), 210);

        $this->assertTrue($tarjeta->recargar(510.15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 802.08);
        

        $this->assertTrue($tarjeta->recargar(962.59));
        $this->assertEquals($tarjeta->obtenerSaldo(), 1986.25);

    }
    public function testPagar(){
        $tarjeta = new Tarjeta;
        $tarjeta->recargar(20);
        $this->assertTrue($tarjeta->pagar());
        $this->assertEquals($tarjeta->obtenerSaldo(), 20-$tarjeta->obtenerValor());
    }
    
    public function testPlus(){
        $tarjeta = new Tarjeta;
        $this->assertTrue($tarjeta->pagar());
        $this->assertEquals($tarjeta->obtenerSaldo(), $tarjeta->obtenerValor() * -1);
        $this->assertEquals($tarjeta->obtenerPlus(), 1);
        $this->assertTrue($tarjeta->pagar());
        $this->assertEquals($tarjeta->obtenerPlus(), 2);
        $this->assertEquals($tarjeta->obtenerSaldo(), $tarjeta->obtenerValor() * -2);
        $this->assertFalse($tarjeta->pagar());
        $this->assertTrue($tarjeta->recargar(20));
        $this->assertEquals($tarjeta->obtenerSaldo(), $tarjeta->obtenerValor() * -2+20);
        $this->assertEquals($tarjeta->obtenerPlus(), 1);
    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
        $tarjeta = new Tarjeta;

        $this->assertFalse($tarjeta->recargar(15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 0);
    }
}
