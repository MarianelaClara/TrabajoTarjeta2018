<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testObtenerValor() {
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
    public function testObtenerIdTarjeta(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 3, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerIdTarjeta(), 3);
    }
    
    public function testObtenerTipoTarjeta(){
       $valor = 14.80;
       $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
       $this->assertEquals($boleto->obtenerTipoTarjeta(),"Medio");
    }

    public function testObtenerSaldoActual(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 10.56, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerSaldoActual(),10.56);
    }

    public function testObtenerTipoBoleto(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerTipoBoleto(), "Segundo Plus");
    }

    public function testObtenerLinea(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerLinea(),"123 Negro");
    }

    public function testObtenerEmpresa(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerEmpresa(), "Semtur");
    }

    public function testObtenerNumeroColectivo(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 2, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerNumeroColectivo(), 2);
    }

    public function testObtenerFecha(){
        $valor = 14.80;
        $fecha=date("d/m/Y H:i:s", 100);
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 100));
        $this->assertEquals($boleto->obtenerFecha(), $fecha);
    }
}
