<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo=0;
    protected $plus=0;
    protected $valor=14.80;
    protected $id;
    protected $transbordo=0;
    protected $viajeTransbordo=0;
    protected $ultimoCole;
    protected $limiteTransbordo=0;

    public function __construct($id = 1) {
      $this->id= $id;
    }
    public function recargar($monto) {
      
      if ($monto == 10 || $monto == 20 || $monto == 30 || $monto == 50 || $monto == 100) {
        $this->saldo += $monto;
	      return TRUE;
      }

      if ($monto == 510.15) {
        $this->saldo += ($monto + 81.93);
        	return TRUE;
      }
      if ($monto == 962.59) {
	      $this->saldo += ($monto + 221.58);
	      return TRUE;
      }

      return FALSE;
    }

    public function obtenerTransbordo(){
      return $this->transbordo;
    }

    public function usarTransbordo(){
      $this->transbordo ++;
    }

    public function resetTransbordo(){
      $this->transbordo=0;
    }
    
    public function pagarTransbordo(){
      $this->saldo -= ($this->valor*33)/100;
    }

    public function obtenerUltimoCole(){
      return $this->ultimoCole;
    }

    public function obtenerLimite(){
      return $this->limiteTransbordo;
    }

    public function actualizarViaje($fecha, $cole){
      $this->viajeTransbordo= date("d/m/Y H:i:s", $fecha);
      $this->ultimoCole= $cole;
      if(date("H", $fecha) >= 22 &&  date("H", $fecha) < 6){
        $this->limiteTransbordo= date("d/m/Y H:i:s", ($fecha+90*60));
      }
      elseif (date("w", $fecha) >= 1 &&  date("w", $fecha) <= 5 ){
        $this->limiteTransbordo= date("d/m/Y H:i:s", ($fecha+60*60));
      }
      else{
        $this->limiteTransbordo= date("d/m/Y H:i:s", ($fecha+90*60));
      }
    }


    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
    }

    public function obtenerId(){
      return $this->id;
    }

    public function obtenerValor(){
      return $this->valor;
    }

    public function obtenerPlus(){
      return $this->plus;
    }

    public function pagarNormal(){
      $this->saldo -= $this->valor;
    
    }
    public function usarPlus(){
      $this->plus ++;
    
    }
    public function pagarPlus(){
      if($this->plus == 1)
        $this->saldo -= ($this->valor);
      else
      $this->saldo -= ($this->valor *2);
      $this->plus = 0;
    }

}
