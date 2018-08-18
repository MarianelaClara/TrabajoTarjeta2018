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
    public function testPlus(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
        $tarjeta=new Tarjeta;
        $this->assertEquals($tarjeta->plus,0);
        $this->assertEquals($tarjeta->obtenerSaldo(),0);
        $cole->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->plus,1);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-1));
        $cole->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->plus,2);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-1)*2);
        $cole->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->plus,2);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-2));
        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->plus,2);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-2)+10);
        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->plus,1);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-2)+20);
        $tarjeta->recargar(10);
        $this->assertEquals($tarjeta->plus,0);
        $this->assertEquals($tarjeta->obtenerSaldo(),($tarjeta->valor*-2)+30);
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
