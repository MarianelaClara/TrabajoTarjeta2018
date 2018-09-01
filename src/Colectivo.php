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

		if($tarjeta instanceof TarjetaMedio){
			if($tarjeta->obtenerPlus() ==0 ){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
					$tarjeta->pagarNormal();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 1){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 2){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					return FALSE;
				}
			}
		}
		if($tarjeta instanceof TarjetaMedioUni){
			if($tarjeta->obtenerPlus() ==0 ){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
					$tarjeta->pagarNormal();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 1){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 2){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					return FALSE;
				}
			}
		}
		if($tarjeta instanceof TarjetaJubilados){
			return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Jubilado", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
		}
		else{
			if($tarjeta->obtenerPlus() ==0 ){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
					$tarjeta->pagarNormal();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 1){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
			}
			if($tarjeta->obtenerPlus() == 2){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", time()));
				}
				else{
					return FALSE;
				}
			}

		}
	}
}
