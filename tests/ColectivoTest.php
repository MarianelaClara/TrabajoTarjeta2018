<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {
     /**
     * Comprueba que la linea del colectivo es la establecida.
     */
	public function testAlgoUtil() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($cole->linea(), "122 negro");
	}
	 /**
     * Comprueba que no es posible un viaje sin tener plus ni saldo suficiente para
	 * tarjetas normales.
     */
	public function testSinPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta(1);
		$tiempo = new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}
     /**
     * Comprueba que no es posible un viaje sin tener plus ni saldo suficiente para
	 * tarjetas de medio boleto.
     */
	public function testSinPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new TarjetaMedio();
		$tiempo = new TiempoFalso(60*5);
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}
	 /**
     * Comprueba que no es posible un viaje sin tener plus ni saldo suficiente para
	 * tarjetas de medio boleto universitario.
     */
	public function testSinPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new TarjetaMedioUni(1);
		$tiempo = new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjeta, $tiempo));
	}
	 /**
     * Comprueba que siempre es posible un viaje para tarjeta de jubilados.
     */
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
	 /**
     * Comprueba que es posible un viaje emitiendo un boleto sin usos de plus si se tiene
	 * saldo para el mismo, para tarejtas normales.
     */	
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
	/**
     * Comprueba que es posible un viaje emitiendo un boleto sin usos de plus si se tiene
	 * saldo para el mismo, para tarejtas de medio boleto.
     */	
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
	/**
     * Comprueba que es posible un viaje emitiendo un boleto sin usos de plus si se tiene
	 * saldo para el mismo, para tarejtas de medio boleto universitario.
     */	
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
	/**
     * Comprueba que es si no se posee el saldo para un viaje se podra efectuar de todas
	 * formas utilizando el primer plus, para tarejtas normales.
     */	
	public function testUsarPrimerPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si no se posee el saldo para un viaje se podra efectuar de todas
	 * formas utilizando el primer plus, para tarejtas de medio boleto.
     */	
	public function testUsarPrimerPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si no se posee el saldo para un viaje se podra efectuar de todas
	 * formas utilizando el primer plus, para tarejtas de medio boleto universitario.
     */	
	public function testUsarPrimerPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje pagando ambos, para
	 * tarjetas normales.
     */	
	public function testPagarUnPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->usarPlus();
		$tarjeta->recargar(30);
		$boleto= new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-$tarjeta->obtenerValor()*2, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje pagando ambos, para
	 * tarjetas medio boleto.
     */	
	public function testPagarUnPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->recargar(30);
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje pagando ambos, para
	 * tarjetas medio boleto universitario.
     */	
	public function testPagarUnPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(30);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si no se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje utilizando el segundo
	 * viaje plus, para tarjetas normales.
     */	
	public function testUsarSegundoPlusNormal(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tiempo= new TiempoFalso;
		$tarjeta->usarPlus();
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si no se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje utilizando el segundo
	 * viaje plus, para tarjetas de medio boleto.
     */	
	public function testUsarSegundoPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si no se posee el saldo suficiente para pagar el unico plus adeudado
	 * y para pagar el viaje correspondiente, se podra realizar el viaje utilizando el segundo
	 * viaje plus, para tarjetas de medio boleto universitario.
     */	
	public function testUsarSegundoPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar dos plus adeudados y para
	 * pagar el viaje correspondiente, se podra realizar el viaje pagando todos los plus
	 * y el viaje actual, para tarjetas normales.
     */	
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
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar dos plus adeudados y para
	 * pagar el viaje correspondiente, se podra realizar el viaje pagando todos los plus
	 * y el viaje actual, para tarjetas de medio boleto.
     */	
	public function testPagarSegundoPlusMedio(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedio= new TarjetaMedio;
		$tiempo= new TiempoFalso;
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->usarPlus();
		$tarjetaMedio->recargar(50);
		$tiempo->avanzar(60*5);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-$tarjetaMedio->obtenerValor()*5, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que es si se posee el saldo suficiente para pagar dos plus adeudados y para
	 * pagar el viaje correspondiente, se podra realizar el viaje pagando todos los plus
	 * y el viaje actual, para tarjetas de medio boleto universitario.
     */	
	public function testPagarSegundoPlusMedioUni(){
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjetaMedioUni= new TarjetaMedioUni;
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*5, "Normal", $cole->linea(), $cole->empresa(),$cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que no es posible realizar un viaje con tarjeta de medio boleto si desde el
	 * ultimo viaje no ah pasado el tiempo límite.
     */	
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
	/**
     * Comprueba que la tarjeta de medio boleto universitario solo puede realizar 2 viajes
	 * de medio boleto al día. 
     */	
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
	/**
     * Comprueba que las tarjetas de medio boleto, aunque puedan realizar el viaje de medio boleto
	 * por el tiempo, si no poseen el saldo suficiente se utilizara un viaje plus
     */	
	public function testPrimerPlusMedio(){
		$tarjetaMedio = new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso(5*60);
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, ni saldo suficiente para un viaje normal, utilizaran un viaje plus.
     */	
	public function testPrimerPlusSinMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero si saldo suficiente para un viaje normal y el plus adeudado,
	 * se realizará el viaje descontando dos viajes normales de su saldo.
     */	

	public function testPagarPrimerPlusSinMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedioUni->obtenerValor()*2, $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*4, "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, adeuda un plus, y no posee saldo suficiente para 2 viajes normales,
	 * utilizaran el segundo viaje plus.
     */	
	public function testSegundoPlusSinMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarPlus();
		$boleto= new Boleto("", $tarjetaMedioUni->obtenerValor()*2, $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, y adeuda dos plus, pero si posee saldo suficiente para tres viaje normal,
	 * se realizará el viaje descontando 3 viajes normales de su saldo.
     */	

	public function testPagarDosPlusSinMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedioUni->obtenerValor()*2, $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*6, "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, no posee plus para utilizar, ni saldo suficiente para 3 viajes normales,
	 * no se podrá realizar el viaje
     */	

	public function testSinSaldoSinMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarMedio();
		$tarjetaMedioUni->usarPlus();
		$tarjetaMedioUni->usarPlus();
		$this->assertFalse($cole->pagarCon($tarjetaMedioUni, $tiempo));
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero se intenta realizar un viaje el día siguiente, y no posee el saldo suficiente
	 * para pagarlo, sera posible hacerlo utilizando un plus.
     */	

	public function testNuevoDiaUsarPlusMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
		$tiempo->avanzar(24*60*60);
		$boleto = new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Primer Plus", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 0);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero se intenta realizar un viaje el día siguiente, y se posee el saldo suficiente
	 * para pagarlo junto con el plus adeudado, sera posible hacerlo.
     */	
	public function testPagarPlusNuevoDiaMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
		$tiempo->avanzar(24*60*60);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 1);
		$tarjetaMedioUni->recargar(30);
		$boleto= new Boleto("Paga 1 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*3, "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 1);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero se intenta realizar un viaje el día siguiente, y no posee el saldo suficiente
	 * para pagarlo junto con con el plus adeudado, sera posible hacerlo utilizando el segundo plus.
     */	
	public function testUsarSegundoPlusNuevoDiaMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 1);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
		$tiempo->avanzar(24*60*60);
		$boleto = new Boleto("", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo(), "Segundo Plus", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 0);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero se intenta realizar un viaje el día siguiente, y se posee el saldo suficiente
	 * para pagarlo junto con los dos plus adeudados, sera posible hacerlo.
     */	
	public function testPagarSegundoPlusNuevoDiaMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 1);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 2);
		$tiempo->avanzar(24*60*60);
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", $tarjetaMedioUni->obtenerValor(), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*5, "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 0);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 1);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario no posee medios boletos disponibles
	 * en el día, pero se intenta realizar un viaje el día siguiente, y no posee el saldo suficiente
	 * para pagarlo junto con con los plus adeudados, no sera posible realizar el viaje.
     */	
	public function testNoSaldoNuevoDiaMedioUni(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjetaMedioUni->recargar(20);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 1);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerPlus(), 2);
		$tiempo->avanzar(24*60*60);
		$this->assertFalse($cole->pagarCon($tarjetaMedioUni, $tiempo));
	}
	/**
     * Comprueba que si una tarjeta normal realiza un viaje y dentro del tiempo permito, en otra linea,
	 * y con saldo suficiente sera posible implementar el viaje transbordo.
     */	
	public function testTransbordoNormal(){
		$tarjeta= new Tarjeta;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjeta->recargar(100);
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo() - $tarjeta->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
		$tiempo->avanzar(10);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-($tarjeta->obtenerValor()*33)/100, "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjeta, $tiempo), $boleto2);
		$boleto= new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo() - $tarjeta->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjeta, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta normal realiza un viaje adeudando un plus y dentro del tiempo permito, en otra linea,
	 * y con saldo suficiente para el transbordo y un viaje normal sera posible implementar
	 * el viaje transbordo pagando el plus adeudado.
     */	
	public function testTransbordoNormalPrimerPlus(){
		$tarjeta= new Tarjeta;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjeta->recargar(20);
		$cole->pagarCon($tarjeta, $tiempo);
		$cole->pagarCon($tarjeta, $tiempo);
		$tiempo->avanzar(10);
		$tarjeta->recargar(100);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("Paga 1 plus", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-($tarjeta->obtenerValor()*33)/100-$tarjeta->obtenerValor(), "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjeta, $tiempo), $boleto2);
	}
	/**
     * Comprueba que si una tarjeta normal realiza un viaje adeudando ya el segundo plus y dentro del tiempo permito, en otra linea,
	 * y con saldo suficiente para el transbordo y dos viajes normales sera posible implementar
	 * el viaje transbordo pagando los plus adeudados.
     */	
	public function testTransbordoNormalSegundoPlus(){
		$tarjeta= new Tarjeta;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tarjeta->recargar(20);
		$cole->pagarCon($tarjeta, $tiempo);
		$cole->pagarCon($tarjeta, $tiempo);
		$cole->pagarCon($tarjeta, $tiempo);
		$tiempo->avanzar(10);
		$tarjeta->recargar(100);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("Paga 2 plus", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo()-($tarjeta->obtenerValor()*33)/100-$tarjeta->obtenerValor()*2, "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjeta, $tiempo), $boleto2);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto realiza un viaje y dentro del tiempo
	 * permito, en otra linea, y con saldo suficiente sera posible implementar
	 *  el viaje transbordo.
     */	

	public function testTransbordoMedio(){
		$tarjetaMedio= new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tiempo->avanzar(60*60);
		$tarjetaMedio->recargar(100);
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo() - $tarjetaMedio->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
		$tiempo->avanzar(60*60);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("", (($tarjetaMedio->obtenerValor()*33)/100), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo()-($tarjetaMedio->obtenerValor()*33)/100, "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjetaMedio, $tiempo), $boleto2);
		$boleto= new Boleto("", $tarjetaMedio->obtenerValor(), $tarjetaMedio->obtenerId(), "Medio", $tarjetaMedio->obtenerSaldo() - $tarjetaMedio->obtenerValor(), "Normal", $cole->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole->pagarCon($tarjetaMedio, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto realiza un viaje adeudando un plus y
	 * dentro del tiempo permito, en otra linea, y con saldo suficiente para el transbordo y
	 * un viaje normal sera posible implementar el viaje transbordo pagando el plus adeudado.
     */	
	public function testTransbordoMedioPrimerPlus(){
		$tarjeta= new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tiempo->avanzar(60*5);
		$tarjeta->recargar(10);
		$cole->pagarCon($tarjeta, $tiempo);
		$tiempo->avanzar(60*5);
		$cole->pagarCon($tarjeta, $tiempo);
		$this->assertEquals($tarjeta->obtenerPlus(), 1);
		$tiempo->avanzar(60*5);
		$tarjeta->recargar(100);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("Paga 1 plus", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo()-($tarjeta->obtenerValor()*33)/100-$tarjeta->obtenerValor()*2, "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjeta, $tiempo), $boleto2);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto realiza un viaje adeudando ya el segundo
	 * plus y dentro del tiempo permito, en otra linea, y con saldo suficiente para el
	 * transbordo y dos viajes normales sera posible implementarel viaje transbordo pagando
	 * los plus adeudados.
     */	
	public function testTransbordoMedioSegundoPlus(){
		$tarjeta= new TarjetaMedio;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tiempo= new TiempoFalso;
		$tiempo->avanzar(60*5);
		$tarjeta->recargar(10);
		$cole->pagarCon($tarjeta, $tiempo);
		$tiempo->avanzar(60*5);
		$cole->pagarCon($tarjeta, $tiempo);
		$tiempo->avanzar(60*5);
		$cole->pagarCon($tarjeta, $tiempo);
		$this->assertEquals($tarjeta->obtenerPlus(), 2);
		$tiempo->avanzar(60*5);
		$tarjeta->recargar(100);
		$cole2= new Colectivo ("121 negro", 1, "Semtur");
		$boleto2= new Boleto("Paga 2 plus", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo()-($tarjeta->obtenerValor()*33)/100-$tarjeta->obtenerValor()*4, "Transbordo", $cole2->linea(), $cole2->empresa(), $cole2->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole2->pagarCon($tarjeta, $tiempo), $boleto2);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje y dentro del tiempo
	 * permito, en otra linea, y con saldo suficiente sera posible implementar
	 *  el viaje transbordo.
     */	
	public function testUniTransbordoSinPlus(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(100);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 1);
		$boleto = new Boleto ("", (($tarjetaMedioUni->obtenerValor()*33)/100), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-($tarjetaMedioUni->obtenerValor()*33/100), "Transbordo", $cole1->linea(), $cole1->empresa(), $cole1->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje adeudando un plus y
	 * dentro del tiempo permito, en otra linea, y con saldo suficiente para el transbordo y
	 * un viaje normal sera posible implementar el viaje transbordo pagando el plus adeudado.
     */	
	public function testUniPrimerPlusTransbordo(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(10);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto ("Paga 1 plus", ($tarjetaMedioUni->obtenerValor()*33/100), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-($tarjetaMedioUni->obtenerValor()*33/100)-$tarjetaMedioUni->obtenerValor()*2, "Transbordo", $cole1->linea(), $cole->empresa(), $cole->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);

	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje adeudando
	 * ya el segundo plus y dentro del tiempo permito, en otra linea, y con saldo suficiente
	 * para el transbordo y dos viajes normales sera posible implementarel viaje transbordo
	 * pagando los plus adeudados.
     */	
	public function testUniSegundoPlusTransbordo(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(10);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", (($tarjetaMedioUni->obtenerValor()*33)/100), $tarjetaMedioUni->obtenerId(), "MedioUni", $tarjetaMedioUni->obtenerSaldo()-$tarjetaMedioUni->obtenerValor()*4-(($tarjetaMedioUni->obtenerValor()*33)/100), "Transbordo", $cole1->linea(), $cole1->empresa(), $cole1->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje, quedandose
	 * sin medios boletos y dentro del tiempo permito, en otra linea, y con saldo suficiente
	 * para un transbordo normal sera posible implementar el viaje transbordo.
     */	
	public function testUniSinPlusSinMedio(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(50);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$boleto= new Boleto("", (($tarjetaMedioUni->obtenerValor()*2*33)/100), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo()- (($tarjetaMedioUni->obtenerValor()*2*33)/100), "Transbordo", $cole1->linea(), $cole1->empresa(), $cole1->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje, quedandose
	 * sin medios boletos con un plus adeudado y dentro del tiempo permito, en otra linea,
	 * y con saldo suficiente para un transbordo normal y un viaje normal sera posible
	 * implementar el viaje transbordo pagando el plus debido.
     */	
	public function testUniSinMedioUnPlusTransbordo(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(20);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 1 plus", (($tarjetaMedioUni->obtenerValor()*2*33)/100), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo()-(($tarjetaMedioUni->obtenerValor()*2*33)/100)-$tarjetaMedioUni->obtenerValor()*2, "Transbordo", $cole1->linea(), $cole1->empresa(), $cole1->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
	/**
     * Comprueba que si una tarjeta de medio boleto universitario realiza un viaje, quedandose
	 * sin medios boletos con 2 plus adeudados y dentro del tiempo permito, en otra linea,
	 * y con saldo suficiente para un transbordo normal y dos viajes normales sera posible
	 * implementar el viaje transbordo pagando los plus debidos.
     */	
	public function testUniSinMedioDosPlusTransbordo(){
		$tarjetaMedioUni= new TarjetaMedioUni;
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$cole1= new Colectivo ("121 negro", 1, "Semtur");
		$tarjetaMedioUni->recargar(20);
		$tiempo= new TiempoFalso;
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$cole->pagarCon($tarjetaMedioUni, $tiempo);
		$tarjetaMedioUni->recargar(50);
		$boleto= new Boleto("Paga 2 plus", (($tarjetaMedioUni->obtenerValor()*2*33)/100), $tarjetaMedioUni->obtenerId(), "Normal", $tarjetaMedioUni->obtenerSaldo()-(($tarjetaMedioUni->obtenerValor()*2*33)/100)-$tarjetaMedioUni->obtenerValor()*4, "Transbordo", $cole1->linea(), $cole1->empresa(), $cole1->numero(), date("d/m/Y H:i:s", $tiempo->tiempo()));
		$this->assertEquals($cole1->pagarCon($tarjetaMedioUni, $tiempo), $boleto);
	}
}
