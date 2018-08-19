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

	public function testJubilados(){
		$tarjetaJub = new TarjetaJubilados;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($tarjetaJub->obtenerSaldo(), 0);
		$boleto = new Boleto($tarjetaJub->valor, $cole, $tarjetaJub->saldo);
		$this->assertEquals($cole->pagarCon($tarjetaJub),$boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJub), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJub), $boleto);
		$this->assertEquals($tarjetaJub->obtenerSaldo(), 0);
	}
	public function testPagarMedio(){
		$tarjetaMedio = new TarjetaMedio;
		$tarjeta = new Tarjeta;
		$this->assertEquals($tarjeta->valor/2,$tarjetaMedio->valor);
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio->recargar(20);
		$this->assertEquals($tarjetaMedio->obtenerSaldo(),20);
		$boleto = new Boleto($tarjetaMedio->valor, $cole, $tarjetaMedio->obtenerSaldo()- $tarjetaMedio->valor);
		$this->assertEquals($cole->pagarCon($tarjetaMedio), $boleto);
		$this->assertEquals($tarjetaMedio->obtenerSaldo(),20-$tarjetaMedio->valor);
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
	public function testMedioPlus(){
		$tarjetaMedio = new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($tarjetaMedio->plus, 0);
		$this->assertEquals($tarjetaMedio->saldo,0);
		$boleto = new Boleto ($tarjetaMedio->valor, $cole, ($tarjetaMedio->saldo - $tarjetaMedio->valor));
		$this->assertEquals($cole->pagarCon($tarjetaMedio), $boleto);
		$this->assertEquals($tarjetaMedio->plus, 1);
		$this->assertEquals($tarjetaMedio->saldo,(-($tarjetaMedio->valor)));
		$boleto1 = new Boleto ($tarjetaMedio->valor, $cole, ($tarjetaMedio->saldo - $tarjetaMedio->valor));
		$this->assertEquals($cole->pagarCon($tarjetaMedio), $boleto1);
		$this->assertFalse($cole->pagarCon($tarjetaMedio));
		$this->assertEquals($tarjetaMedio->plus, 2);
		$this->assertEquals($tarjetaMedio->saldo,(-($tarjetaMedio->valor))*2);
		$tarjetaMedio->recargar(10);
		$this->assertEquals($tarjetaMedio->plus, 1);
		$this->assertEquals($tarjetaMedio->saldo,(((-($tarjetaMedio->valor))*2)+10));
		$boleto2 = new Boleto ($tarjetaMedio->valor, $cole, ($tarjetaMedio->saldo - $tarjetaMedio->valor));
		
		}
}
