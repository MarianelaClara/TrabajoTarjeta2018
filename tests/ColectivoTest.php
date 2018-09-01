<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

	public function testAlgoUtil() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($cole->linea(), "122 negro");
	}
	
	public function testSinPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta(1);
		$tiempo = new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}

	public function testSinPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new TarjetaMedio(1);
		$tiempo = new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}

	public function testSinPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new TarjetaMedioUni(1);
		$tiempo = new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}
	public function testViajeJubilados(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaJubilados= new TarjetaJubilados;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjetaJubilados->obtenerValor(), $tarjetaJubilados->obtenerId(), "Jubilado", $tarjetaJubilados->obtenerSaldo(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
		$this->assertEquals($cole->pagarCon($tarjetaJubilados, $tiempo), $boleto);
	}

	public function testViajeNormalSinPlus(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->recargar(50);
		$boleto = new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-$tarjeta->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
		$boleto2 = new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-$tarjeta->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto2);
	}

	public function testViajeMedioSinPlus(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->recargar(50);
		$tiempo->avanzar(60*5);
		$boleto = new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
		$tiempo->avanzar(60*5);
		$boleto2 = new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto2);
	}

	public function testViajeMedioUniSinPlus(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(50);
		$boleto = new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
		$boleto2 = new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto2);
	}

	public function testUsarPrimerPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}


	public function utestUsarPrimerPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedi, $tiempo), $boleto);
	}
	
	public function testUsarPrimerPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}

	public function testPagarUnPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->recargar(30);
		$boleto= new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-$tarjeta->obtenerValor()*2, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}

	public function testPagarUnPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->recargar(30);
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor()*2, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}

	public function testPagarUnPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(30);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*2, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}

	public function testUsarSegundoPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->usarPlus();
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}

	public function testUsarSegundoPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	
	public function testUsarSegundoPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}

	public function testPagarSegundoPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$tarjeta->recargar(50);
		$boleto= new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-$tarjeta->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}

	public function testPagarSegundoPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->recargar(50);
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}

	public function testPagarSegundoPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}

	public function testMenosCincoMinutosMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$this->assertFalse($cole->pagarCon($tarjetaMedio, $tiempo));
		$tiempo->avanzar(40);
		$this->assertFalse($cole->pagarCon($tarjetaMedio, $tiempo));
		$tiempo->avanzar(20);
		$this->assertFalse($cole->pagarCon($tarjetaMedio, $tiempo));
		$tiempo->avanzar(3*60);
		$this->assertFalse($cole->pagarCon($tarjetaMedio, $tiempo));
		$tiempo->avanzar(59);
		$this->assertFalse($cole->pagarCon($tarjetaMedio, $tiempo));
	}

	public function testDosMediosUniPorDia(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso(60*60*24);
		$tarjetaMedioUni->recargar(50);
		$this->assertEquals($tarjetaMedioUni->obtenerSaldo(),50);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),0);
		$cole->pagarCon($tarjetaMedioUni,$tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerSaldo(),50-$tarjetaMedioUni->obtenerValor());
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),1);
		$cole->pagarCon($tarjetaMedioUni,$tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerSaldo(),50-$tarjetaMedioUni->obtenerValor()*2);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),2);
		$cole->pagarCon($tarjetaMedioUni,$tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerSaldo(),50-$tarjetaMedioUni->obtenerValor()*4);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),2);
		$tiempo->avanzar(24*60*60);
		$cole->pagarCon($tarjetaMedioUni,$tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),1);
		$this->assertEquals($tarjetaMedioUni->obtenerSaldo(),50-$tarjetaMedioUni->obtenerValor()*5);
	}

}
