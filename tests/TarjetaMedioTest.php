<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaMedioTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tarjetaMedio = new TarjetaMedio;

        $this->assertTrue($tarjetaMedio->recargar(10));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 10);

        $this->assertTrue($tarjetaMedio->recargar(20));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 30);

        $this->assertTrue($tarjetaMedio->recargar(30));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 60);

        $this->assertTrue($tarjetaMedio->recargar(50));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 110);

        $this->assertTrue($tarjetaMedio->recargar(100));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 210);

        $this->assertTrue($tarjetaMedio->recargar(510.15));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 802.08);
        

        $this->assertTrue($tarjetaMedio->recargar(962.59));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 1986.25);


    }
    
    public function testCargaSaldoInvalido() {
        $tarjetaMedio = new TarjetaMedio;

        $this->assertFalse($tarjetaMedio->recargar(15));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 0);
    }
     
    public function testPagar(){
        $tarjetaMedio = new TarjetaMedio;
        $tarjetaMedio->recargar(20);
        $this->assertTrue($tarjetaMedio->pagar());
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 20-$tarjetaMedio->obtenerValor());
    }
    
    public function testPlus(){
        $tarjetaMedio = new TarjetaMedio;
        $this->assertTrue($tarjetaMedio->pagar());
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), $tarjetaMedio->obtenerValor() * -1);
        $this->assertEquals($tarjetaMedio->obtenerPlus(), 1);
        $this->assertTrue($tarjetaMedio->pagar());
        $this->assertEquals($tarjetaMedio->obtenerPlus(), 2);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), $tarjetaMedio->obtenerValor() * -2);
        $this->assertFalse($tarjetaMedio->pagar());
        $this->assertTrue($tarjetaMedio->recargar(10));
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), $tarjetaMedio->obtenerValor() * -2+10);
        $this->assertEquals($tarjetaMedio->obtenerPlus(), 1);
    }


}