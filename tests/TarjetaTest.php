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
    public function testPagarNormal(){
        $tarjeta = new Tarjeta;
        $tarjeta->recargar(50);
        $tarjeta->PagarNormal();
        $this->assertEquals($tarjeta->obtenerSaldo(), 50-$tarjeta->obtenerValor());
        $tarjeta->PagarNormal();
        $this->assertEquals($tarjeta->obtenerSaldo(), 50-($tarjeta->obtenerValor())*2);
    }
    
    public function testUsarPlus(){
        $tarjeta = new Tarjeta;
        $tarjeta->UsarPlus();
        $this->assertEquals($tarjeta->obtenerPlus(), 1);
        $tarjeta->UsarPlus();
        $this->assertEquals($tarjeta->obtenerPlus(), 2);
        
    }

    public function testPagarPlus(){
    $tarjeta = new Tarjeta;
    $tarjeta->UsarPlus();
    $this->assertEquals($tarjeta->obtenerPlus(), 1);
    $tarjeta->recargar(30);
    $tarjeta->PagarPlus();
    $this->assertEquals($tarjeta->obtenerSaldo(), 30-($tarjeta->obtenerValor()));
    $this->assertEquals($tarjeta->obtenerPlus(), 0);
    $tarjeta->UsarPlus();
    $tarjeta->UsarPlus();
    $this->assertEquals($tarjeta->obtenerPlus(), 2);
    $tarjeta->recargar(50);
    $tarjeta->PagarPlus();
    $this->assertEquals($tarjeta->obtenerSaldo(),50+(30-($tarjeta->obtenerValor()))-($tarjeta->obtenerValor() * 2));
    $this->assertEquals($tarjeta->obtenerPlus(), 0);
    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
        $tarjeta = new Tarjeta;

        $this->assertFalse($tarjeta->recargar(15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 0);
    }

    public function testNocheTransbordo(){
        $tarjeta= new Tarjeta;
        $tiempo= new TiempoFalso;

        $this->assertEquals(date("w", $tiempo->tiempo()), 4);
        $this->assertEquals(date("H", $tiempo->tiempo()), 0);
        $tarjeta->actualizarViaje($tiempo->tiempo(), "122 Negro", $tiempo->obtenerFeriado());
        $this->assertEquals($tarjeta->obtenerLimite(), date("d/m/Y H:i:s", $tiempo->tiempo()+ 60*90));
    }

    public function testSemanaTransbordo(){
        $tarjeta= new Tarjeta;
        $tiempo= new TiempoFalso;

        $this->assertEquals(date("w", $tiempo->tiempo()), 4);
        $this->assertEquals(date("H", $tiempo->tiempo()), 0);
        $tiempo->avanzar(60*60*7);
        $tarjeta->actualizarViaje($tiempo->tiempo(), "122 Negro", $tiempo->obtenerFeriado());
        $this->assertEquals($tarjeta->obtenerLimite(), date("d/m/Y H:i:s", $tiempo->tiempo()+ 60*60));
    }

    public function testFindeTransbordo(){
        $tarjeta= new Tarjeta;
        $tiempo= new TiempoFalso;

        $this->assertEquals(date("w", $tiempo->tiempo()), 4);
        $this->assertEquals(date("H", $tiempo->tiempo()), 0);
        $tiempo->avanzar(60*60*24*2);
        $tiempo->avanzar(60*60*7);
        $this->assertEquals(date("w", $tiempo->tiempo()), 6);
        $this->assertEquals(date("H", $tiempo->tiempo()), 7);
        $tarjeta->actualizarViaje($tiempo->tiempo(), "122 Negro", $tiempo->obtenerFeriado());
        $this->assertEquals($tarjeta->obtenerLimite(), date("d/m/Y H:i:s", $tiempo->tiempo()+ 60*90));
    }
    
    public function testActualizarViaje(){
        $tarjeta = new Tarjeta;
        $tiempo= new TiempoFalso(0, TRUE);
        $this->assertEquals($tarjeta->obtenerLimite(), 0);
        $tarjeta->actualizarViaje($tiempo->tiempo(), "122 Negro", $tiempo->obtenerFeriado());
        $this->assertEquals($tarjeta->obtenerLimite(), date("d/m/Y H:i:s", 90*60));
    }
}
