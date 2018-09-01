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
	
	public function pagarCon(TarjetaInterface $tarjeta, TiempoInterface $tiempo) {

		if($tarjeta instanceof TarjetaMedio){
			if(($tiempo->tiempo()-$tarjeta->ultimoViaje)>= $tarjeta->obtenerTiempoEspera()){
				if($tarjeta->obtenerPlus() ==0 ){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
						$tarjeta->pagarNormal();
						$tarjeta->ultimoViaje= $tiempo->tiempo();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						$tarjeta->usarPlus();
						$tarjeta->ultimoViaje= $tiempo->tiempo();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 1){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
						$tarjeta->pagarPlus();
						$tarjeta->ultimoViaje= $tiempo->tiempo();
						return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						$tarjeta->usarPlus();
						$tarjeta->ultimoViaje= $tiempo->tiempo();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 2){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
						$tarjeta->pagarPlus();
						$tarjeta->ultimoViaje= $tiempo->tiempo();
						return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						return FALSE;
					}
				}
			}
			else{
				return FALSE;
			}
		}
		if($tarjeta instanceof TarjetaMedioUni){
			$diaActual= date("d", $tiempo->tiempo());
			if($diaActual==$tarjeta->obtenerDiaDeUso()){
				if($tarjeta->obtenerUsoDeMedio()!=2){
					if($tarjeta->obtenerPlus() ==0 ){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
							$tarjeta->pagarNormal();
							$tarjeta->usarMedio();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							$tarjeta->usarMedio();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 1){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
							$tarjeta->pagarPlus();
							$tarjeta->usarMedio();
							return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							$tarjeta->usarMedio();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 2){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
							$tarjeta->pagarPlus();
							$tarjeta->usarMedio();
							return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							return FALSE;
						}
					}
				}
				else{
					if($tarjeta->obtenerPlus() ==0 ){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
							$tarjeta->pagarNormal();
							$tarjeta->pagarNormal();
							return new Boleto("", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 1){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
							$tarjeta->pagarPlus();
							$tarjeta->pagarNormal();
							return new Boleto("Paga 1 plus", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							return new Boleto("", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 2){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*4){
							$tarjeta->pagarPlus();
							$tarjeta->pagarNormal();
							return new Boleto("Paga 2 plus", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							return FALSE;
						}
					}
				}
			}
			else{
				$tarjeta->actualizarDia($diaActual);
				if($tarjeta->obtenerPlus() ==0 ){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
						$tarjeta->pagarNormal();
						$tarjeta->usarMedio();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						$tarjeta->usarPlus();
						$tarjeta->usarMedio();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 1){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
						$tarjeta->pagarPlus();
						$tarjeta->usarMedio();
						return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						$tarjeta->usarPlus();
						$tarjeta->usarMedio();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 2){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
						$tarjeta->pagarPlus();
						$tarjeta->usarMedio();
						return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						return FALSE;
					}
				}
			}
		}
		if($tarjeta instanceof TarjetaJubilados){
			return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Jubilado", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
		}
		else{
			if($tarjeta->obtenerPlus() ==0 ){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
					$tarjeta->pagarNormal();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
			}
			if($tarjeta->obtenerPlus() == 1){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
				else{
					$tarjeta->usarPlus();
					return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
			}
			if($tarjeta->obtenerPlus() == 2){
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
					$tarjeta->pagarPlus();
					return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
				else{
					return FALSE;
				}
			}

		}
	}
}
