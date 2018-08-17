<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testAlgoUtil() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$this->assertEquals($cole->linea(), "122 negro");
    }

    public function testPagarCon() {
		$cole= new Colectivo ("122 negro", 1, "Semtur");
		$tarjeta= new Tarjeta;
		$tarjeta->recargar(10);
        $this->assertFalse($cole->pagarCon($tarjeta));
		$tarjeta->recargar(10);
		$boleto = new Boleto (14.80, $cole, (20-14.80));
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
		
		}







		}



}
