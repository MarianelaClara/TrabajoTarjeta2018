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
		$boleto = new Boleto ($tarjeta->valor, $cole, ($tarjeta->saldo - $tarjeta->valor));
		$this->assertEquals($cole->pagarCon($tarjeta), $boleto);
	}
		
  public function testSinSaldo(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$boleto = new Boleto ($tarjeta->valor, $cole, ($tarjeta->saldo - $tarjeta->valor));
		$this->assertEquals($cole->pagarCon($tarjeta), $boleto);
		$boleto1 = new Boleto ($tarjeta->valor, $cole, ($tarjeta->saldo - $tarjeta->valor));
		$this->assertEquals($cole->pagarCon($tarjeta), $boleto1);
		$this->assertFalse($cole->pagarCon($tarjeta));
		$tarjeta->recargar(10);
		$this->assertFalse($cole->pagarCon($tarjeta));
		$tarjeta->recargar(10);
		$this->assertEquals($tarjeta->plus,1);
		$boleto2 = new Boleto ($tarjeta->valor, $cole, ($tarjeta->saldo - $tarjeta->valor));
		$this->assertEquals($cole->pagarCon($tarjeta), $boleto2);
		$this->assertFalse($cole->pagarCon($tarjeta));
	}
}
