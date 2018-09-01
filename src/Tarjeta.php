<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo=0;
    protected $plus=0;
    protected $valor=14.80;
    protected $id;

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
        $this->saldo -= ($this->valor *2);
      else
      $this->saldo -= ($this->valor *3);
      $this->plus = 0;
    }

}
