<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

	protected $linea;
	protected $numero;
	protected $empresa;

	public function __construct($linea, $numero, $empresa) {
        $this->linea = $linea;
		$this->numero = $numero;
		$this->empresa = $empresa;
	}

	public function linea() {
		return $this->linea;
	}
	public function empresa() {
		return $this->empresa;
	}
	public function numero() {
		return $this->numero;
	}
	
	public function pagarCon(TarjetaInterface $tarjeta) {
		
		if($tarjeta->saldo >= 14.80){
			$tarjeta->saldo -= 14.80;
			return (new Boleto(14.80, $this, $tarjeta->saldo));
		}
		return FALSE;
	}
}
