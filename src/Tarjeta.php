<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo = 0;
    protected $plus = 0;
    protected $valor = 14.80;
    protected $id;
    protected $transbordo = 0;
    protected $viajeTransbordo = 0;
    protected $ultimoCole;
    protected $limiteTransbordo = 0;
      /**
     * Se encarga de darle los parametros iniciales al objeto tarjeta.
     *
     * @param int $id.
     *  Siendo este el id de la tarjeta.
     */
    public function __construct($id = 1) {
      $this->id = $id;
    }
    /**
     * Verifica si es posible cargar el saldo deseado, en caso afirmativo realiza la carga de la tarjeta.
     *
     * @param float $monto
     *  El saldo que se desea recargar en la tarjeta.
     * 
     * @return Bool
     *  TRUE en caso de que sea un saldo valido, FALSE en caso contrario.
    */
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
     * Devuelve el número de transbordos utilizados. Ejemplo: 1 o 0.
     *
     * @return int
     *  Siendo este la cantidad de transbordos utilizados.
     */
    public function obtenerTransbordo() {
      return $this->transbordo;
    }
    /**
     * Aumenta el número de transbordos utiliados.
     */
    public function usarTransbordo() {
      $this->transbordo++;
    }
     /**
     * Reinicia la cantidad de transbordos utilizados.
     */
    public function resetTransbordo() {
      $this->transbordo = 0;
    }
     /**
     * Resta del saldo actual el valor de un viaje transbordo.
     */
    public function pagarTransbordo() {
      $this->saldo -= ($this->valor * 33) / 100;
    }
    /**
     * Devuelve el la línea del ultimo colectivo usado con esta tarjeta. Ejemplo: "122 Negro".
     *
     * @return string
     *  Siendo este el color y número del colectivo.
     */
    public function obtenerUltimoCole() {
      return $this->ultimoCole;
    }
    /**
     * Devuelve el momento en la cual el transbordo deja de ser válido.
     *
     * @return string
     *  Indicando mediante fecha y hora el "vencimiento" del usó del transbordo.
     */
    public function obtenerLimite() {
      return $this->limiteTransbordo;
    }
    /**
     * Actualiza las condiciones para usar el transbordo, el tiempo límite como el último colectivo usado.
     * 
     * @param int $fecha, string $cole, bool $feriado.
     * Siendo estos un número que formateado dará la fecha en la que se emitío el último viaje, la línea de colectivo utilizada,
     * y luego indicandonos si ese día es feriado o no.
     */
    public function actualizarViaje($fecha, $cole, $feriado) {
      $this->viajeTransbordo = date("d/m/Y H:i:s", $fecha);
      $this->ultimoCole = $cole;
      if (date("H", $fecha) >= 22 || date("H", $fecha) < 6) {
        $this->limiteTransbordo = date("d/m/Y H:i:s", ($fecha + 90 * 60));
      }
      elseif (date("w", $fecha) >= 1 && date("w", $fecha) <= 5 && $feriado != TRUE) {
        $this->limiteTransbordo = date("d/m/Y H:i:s", ($fecha + 60 * 60));
      }
      else {
        $this->limiteTransbordo = date("d/m/Y H:i:s", ($fecha + 90 * 60));
      }
    }


    /**
     * Devuelve el saldo que le queda a la tarjeta. Ejemplo : 15.80.
     *
     * @return float
     *  Siendo este el saldo restante de la tarjeta.
     */
    public function obtenerSaldo() {
      return $this->saldo;
    }
    /**
     * Devuelve el ID de la tarjeta. Ejemplo: 3.
     *
     * @return int
     *  Siendo este el id de la tarjeta.
     */
    public function obtenerId() {
      return $this->id;
    }
    /**
     * Devuelve el valor del boleto que se pagara con esta tarjeta. Ejemplo: 14.80.
     *
     * @return float
     *  Siendo este el valor que se pagará.
     */
    public function obtenerValor() {
      return $this->valor;
    }
    /**
     * Devuelve el número de plus sin pagar que se realizaron con la tarjeta. Ejemplo: 2.
     *
     * @return int
     *  Siendo este el número de plus usados.
     */
    public function obtenerPlus() {
      return $this->plus;
    }
    /**
     * Descuenta del saldo de la tarjeta el valor de un viaje normal.
     */
    public function pagarNormal() {
      $this->saldo -= $this->valor;
    }
        /**
     * Aumenta el número de plus utilizados.
     */
    public function usarPlus() {
      $this->plus++;
    
    }
        /**
     * Descuenta del saldo de la tarjeta, el valor necesario para pagar los plus adeudados, y luego los resetea.
     */
    public function pagarPlus() {
      if ($this->plus == 1)
        $this->saldo -= ($this->valor);
      else
      $this->saldo -= ($this->valor * 2);
      $this->plus = 0;
    }

}
