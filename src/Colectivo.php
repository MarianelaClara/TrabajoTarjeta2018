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
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
						$tarjeta->pagarPlus();
						$tarjeta->pagarNormal();
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
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*5){
						$tarjeta->pagarPlus();
						$tarjeta->pagarNormal();
						$tarjeta->pagarNormal();
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
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 1){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
							$tarjeta->pagarPlus();
							$tarjeta->usarMedio();
							$tarjeta->pagarNormal();
							return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 2){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*5){
							$tarjeta->pagarPlus();
							$tarjeta->pagarNormal();
							$tarjeta->pagarNormal();
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
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*2){
							$tarjeta->pagarNormal();
							$tarjeta->pagarNormal();
							return new Boleto("", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 1){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*4){
							$tarjeta->pagarPlus();
							$tarjeta->pagarNormal();
							$tarjeta->pagarNormal();
							return new Boleto("Paga 1 plus", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
						else{
							$tarjeta->usarPlus();
							return new Boleto("", $tarjeta->obtenerValor()*2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
						}
					}
					if($tarjeta->obtenerPlus() == 2){
						if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*6){
							$tarjeta->pagarPlus();
							$tarjeta->pagarNormal();
							$tarjeta->pagarNormal();
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
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 1){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*3){
						$tarjeta->pagarPlus();
						$tarjeta->pagarNormal();
						$tarjeta->usarMedio();
						return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
					else{
						$tarjeta->usarPlus();
						return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
					}
				}
				if($tarjeta->obtenerPlus() == 2){
					if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()*5){
						$tarjeta->pagarPlus();
						$tarjeta->pagarNormal();
						$tarjeta->pagarNormal();
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
				if($tarjeta->obtenerTransbordo()==0 && $tarjeta->obtenerUltimoCole()!= $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo())){
					$tarjeta->usarTransbordo();
					$tarjeta->pagarTransbordo();
					return new Boleto("", (($tarjeta->obtenerValor()*33)/100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
				}
				if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()){
					$tarjeta->resetTransbordo();
					$tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea);
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
