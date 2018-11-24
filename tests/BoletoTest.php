<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {
    /**
     * Verifica que el boleto tenga el valor establecido.
     */
    public function testObtenerValor() {
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
    /**
     * Verifica que el boleto tenga el ID de tarjeta establecido.
     */
    public function testObtenerIdTarjeta(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 3, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerIdTarjeta(), 3);
    }
    /**
     * Verifica que el boleto tenga el tipo de tarjeta establecido.
     */
    public function testObtenerTipoTarjeta(){
       $valor = 14.80;
       $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
       $this->assertEquals($boleto->obtenerTipoTarjeta(),"Medio");
    }
    /**
     * Verifica que el boleto tenga el saldo restante de la tarjeta correspondiente.
     */
    public function testObtenerSaldoActual(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 10.56, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerSaldoActual(),10.56);
    }
    /**
     * Verifica que el boleto sea del tipo correspondiente al indicado.
     */
    public function testObtenerTipoBoleto(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerTipoBoleto(), "Segundo Plus");
    }
    /**
     * Verifica que el boleto tenga la línea correspondiente al colectivo indicado.
     */
    public function testObtenerLinea(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerLinea(),"123 Negro");
    }
    /**
     * Verifica que el boleto tenga la empresa correspondiente al colectivo indicado.
     */
    public function testObtenerEmpresa(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerEmpresa(), "Semtur");
    }
    /**
     * Verifica que el boleto tenga el número al colectivo indicado
     */
    public function testObtenerNumeroColectivo(){
        $valor = 14.80;
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 2, date("d/m/Y H:i:s", 0));
        $this->assertEquals($boleto->obtenerNumeroColectivo(), 2);
    }
    /**
     * Verifica que el boleto tenga la fecha indicada.
     */
    public function testObtenerFecha(){
        $valor = 14.80;
        $fecha=date("d/m/Y H:i:s", 100);
        $boleto = new Boleto("", $valor, 1, "Medio", 1, "Segundo Plus", "123 Negro", "Semtur", 1, date("d/m/Y H:i:s", 100));
        $this->assertEquals($boleto->obtenerFecha(), $fecha);
    }
}
