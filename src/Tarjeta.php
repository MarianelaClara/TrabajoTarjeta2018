<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    public $saldo;
    public $plus=0;
    public $valor=14.80;

    public function recargar($monto) {
      
      if ($monto == 10 || $monto == 20 || $monto == 30 || $monto == 50 || $monto == 100) {
        $this->saldo += $monto;
        if($this->saldo>=($this->valor * -1) && $this->plus==2){
          $this->plus--;
        }
        if($this->saldo>=0){
         $this->plus=0;
        }
	      return TRUE;
      }

      if ($monto == 510.15) {
        $this->saldo += ($monto + 81.93);
        $this->plus=0;
        	return TRUE;
      }
      if ($monto == 962.59) {
        $this->plus=0;
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

}
