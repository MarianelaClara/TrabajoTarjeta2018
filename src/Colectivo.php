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
		
		if($tarjeta->saldo >= $tarjeta->valor){
			$tarjeta->saldo -= $tarjeta->valor;
			return (new Boleto($tarjeta->valor, $this, $tarjeta->saldo));
		}
		if($tarjeta->plus<2){
			$tarjeta->saldo -= $tarjeta->valor;
			$tarjeta->plus++;
			return (new Boleto($tarjeta->valor, $this, $tarjeta->saldo));
		}
		return FALSE;
	}
}
