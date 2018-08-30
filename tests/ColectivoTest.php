<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

	public function testAlgoUtil() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($cole->linea(), "122 negro");
  }

 	 public function testPagarConSaldo() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tarjeta->recargar(10);
		$tarjeta->recargar(20);
		$boleto = new Boleto ($tarjeta->obtenerValor(), $cole, ($tarjeta->obtenerSaldo()-$tarjeta->obtenerValor()));
		$this->assertEquals($cole->pagarCon($tarjeta), $boleto);
	}

	public function testJubilados(){
		$tarjetaJubilado= new TarjetaJubilados;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$boleto = new Boleto ($tarjetaJubilado->obtenerValor(), $cole, $tarjetaJubilado->obtenerSaldo());
		$this->assertEquals($cole->pagarCon($tarjetaJubilado), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilado), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilado), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilado), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilado), $boleto);
	}
	public function testPagarMedio(){
		$tarjetaMedio = new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio->recargar(10);
		$tarjetaMedio->recargar(20);
		$boleto = new Boleto ($tarjetaMedio->obtenerValor(), $cole, ($tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio), $boleto);
	}
		
 	 public function testSinSaldo(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tarjeta->pagar();
		$tarjeta->pagar();
		$this->assertFalse($cole->pagarCon($tarjeta));
	}

	public function testSinSaldoPlus(){
		$tarjetaMedio = new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio->pagar();
		$tarjetaMedio->pagar();
		$this->assertEquals($tarjetaMedio->obtenerPlus(), 2);
		$this->assertFalse($cole->pagarCon($tarjetaMedio));
		}
}
