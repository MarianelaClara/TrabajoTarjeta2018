<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

  protected $linea;
  protected $numero;
  protected $empresa;
    /**
     * Se encarga de darle los parametros iniciales al objeto colectivo.
     *
     * @param string $linea, int $numero, string $empresa
     *  Siendo estos, la linea, el numero y la empresa del colectivo a crear.
     */
  public function __construct($linea, $numero, $empresa) {
      $this->linea = $linea;
    $this->numero = $numero;
    $this->empresa = $empresa;
  }
    /**
     * Devuelve el nombre de la linea. Ejemplo '142 Negro'
     *
     * @return string
     */
  public function linea() {
    return $this->linea;
  }
    /**
     * Devuelve el nombre de la empresa. Ejemplo 'Semtur'
     *
     * @return string
     */
  public function empresa() {
    return $this->empresa;
  }
    /**
     * Devuelve el numero de unidad. Ejemplo: 12
     *
     * @return int
     */
  public function numero() {
    return $this->numero;
  }
    /**
     * Paga un viaje en el colectivo con una tarjeta en particular.
     *
     * @param TarjetaInterface $tarjeta, TiempoInterface $tiempo
     *  Siendo estos, la tarjeta con la que se pagaŕa, y el la fecha en la que se hará.
     *
     * @return BoletoInterface|FALSE
     *  El boleto generado por el pago del viaje. O FALSE si no hay saldo
     *  suficiente en la tarjeta.
     */	
  public function pagarCon(TarjetaInterface $tarjeta, TiempoInterface $tiempo) {

    if ($tarjeta instanceof TarjetaMedio) {
      if (($tiempo->tiempo() - $tarjeta->ultimoViaje) >= $tarjeta->obtenerTiempoEspera()) {
        if ($tarjeta->obtenerPlus() == 0) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            return new Boleto("", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado());
            $tarjeta->pagarNormal();
            $tarjeta->ultimoViaje = $tiempo->tiempo();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            $tarjeta->usarPlus();
            $tarjeta->ultimoViaje = $tiempo->tiempo();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
        }
        if ($tarjeta->obtenerPlus() == 1) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 2) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            return new Boleto("Paga 1 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 3) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->ultimoViaje = $tiempo->tiempo();
            return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            $tarjeta->usarPlus();
            $tarjeta->ultimoViaje = $tiempo->tiempo();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
        }
        if ($tarjeta->obtenerPlus() == 2) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 4) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            return new Boleto("Paga 2 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 5) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;	
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->ultimoViaje = $tiempo->tiempo();
            return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Medio", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            return FALSE;
          }
        }
      }
      else {
        return FALSE;
      }
    }
    if ($tarjeta instanceof TarjetaMedioUni) {
      $diaActual = date("d/m/Y", $tiempo->tiempo());
      if ($diaActual == $tarjeta->obtenerDiaDeUso()) {
        if ($tarjeta->obtenerUsoDeMedio() != 2) {
          if ($tarjeta->obtenerPlus() == 0) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100) {
              $tarjeta->usarTransbordo();
              $tarjeta->pagarTransbordo();
              $tarjeta->usarMedio();
              return new Boleto("", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()) {
              $tarjeta->resetTransbordo();
              $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
              $tarjeta->pagarNormal();
              $tarjeta->usarMedio();
              return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              $tarjeta->usarPlus();
              return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
          }
          if ($tarjeta->obtenerPlus() == 1) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 2) {
              $tarjeta->usarTransbordo();
              $tarjeta->pagarTransbordo();
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->usarMedio();
              return new Boleto("Paga 1 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 3) {
              $tarjeta->resetTransbordo();
              $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->usarMedio();
              $tarjeta->pagarNormal();
              return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              $tarjeta->usarPlus();
              return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
          }
          if ($tarjeta->obtenerPlus() == 2) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 4) {
              $tarjeta->usarTransbordo();
              $tarjeta->pagarTransbordo();
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->usarMedio();
              return new Boleto("Paga 2 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 5) {
              $tarjeta->resetTransbordo();
              $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->usarMedio();
              return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              return FALSE;
            }
          }
        }
        else {
          if ($tarjeta->obtenerPlus() == 0) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 2 * 33 / 100) {
              $tarjeta->usarTransbordo();
              $tarjeta->normalTransbordo();
              return new Boleto("", (($tarjeta->obtenerValor() * 2 * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 2) {
              $tarjeta->resetTransbordo();
              $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              return new Boleto("", $tarjeta->obtenerValor() * 2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              $tarjeta->usarPlus();
              return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
          }
          if ($tarjeta->obtenerPlus() == 1) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 2 * 33 / 100 + $tarjeta->obtenerValor() * 2) {
              $tarjeta->usarTransbordo();
              $tarjeta->normalTransbordo();
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              return new Boleto("Paga 1 plus", (($tarjeta->obtenerValor() * 2 * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 4) {
              $tarjeta->resetTransbordo();
              $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              return new Boleto("Paga 1 plus", $tarjeta->obtenerValor() * 2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              $tarjeta->usarPlus();
              return new Boleto("", $tarjeta->obtenerValor() * 2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
          }
          if ($tarjeta->obtenerPlus() == 2) {
            if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 2 * 33 / 100 + $tarjeta->obtenerValor() * 4) {
              $tarjeta->usarTransbordo();
              $tarjeta->normalTransbordo();
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              return new Boleto("Paga 2 plus", (($tarjeta->obtenerValor() * 2 * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 6) {
              $tarjeta->pagarPlus();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              $tarjeta->pagarNormal();
              return new Boleto("Paga 2 plus", $tarjeta->obtenerValor() * 2, $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
            }
            else {
              return FALSE;
            }
          }
        }
      }
      else {
        $tarjeta->actualizarDia($diaActual);
        if ($tarjeta->obtenerPlus() == 0) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            $tarjeta->usarMedio();
            return new Boleto("", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
            $tarjeta->pagarNormal();
            $tarjeta->usarMedio();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            $tarjeta->usarPlus();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
        }
        if ($tarjeta->obtenerPlus() == 1) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 2) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->usarMedio();
            return new Boleto("Paga 1 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 3) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->usarMedio();
            return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            $tarjeta->usarPlus();
            return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
        }
        if ($tarjeta->obtenerPlus() == 2) {
          if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 4) {
            $tarjeta->usarTransbordo();
            $tarjeta->pagarTransbordo();
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->usarMedio();
            return new Boleto("Paga 2 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 5) {
            $tarjeta->resetTransbordo();
            $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
            $tarjeta->pagarPlus();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->pagarNormal();
            $tarjeta->usarMedio();
            return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "MedioUni", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
          }
          else {
            return FALSE;
          }
        }
      }
    }
    if ($tarjeta instanceof TarjetaJubilados) {
      return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Jubilado", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
    }
    else {
      if ($tarjeta->obtenerPlus() == 0) {
        if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100) {
          $tarjeta->usarTransbordo();
          $tarjeta->pagarTransbordo();
          return new Boleto("", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor()) {
          $tarjeta->resetTransbordo();
          $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
          $tarjeta->pagarNormal();
          return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        else {
          $tarjeta->usarPlus();
          return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Primer Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
      }
      if ($tarjeta->obtenerPlus() == 1) {
        if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor()) {
          $tarjeta->usarTransbordo();
          $tarjeta->pagarTransbordo();
          $tarjeta->pagarPlus();
          return new Boleto("Paga 1 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 2) {
          $tarjeta->resetTransbordo();
          $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
          $tarjeta->pagarPlus();
          $tarjeta->pagarNormal();
          return new Boleto("Paga 1 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        else {
          $tarjeta->usarPlus();
          return new Boleto("", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Segundo Plus", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
      }
      if ($tarjeta->obtenerPlus() == 2) {
        if ($tarjeta->obtenerTransbordo() == 0 && $tarjeta->obtenerUltimoCole() != $this->linea && $tarjeta->obtenerLimite() > date("d/m/Y H:i:s", $tiempo->tiempo()) && $tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 33 / 100 + $tarjeta->obtenerValor() * 2) {
          $tarjeta->usarTransbordo();
          $tarjeta->pagarTransbordo();
          $tarjeta->pagarPlus();
          return new Boleto("Paga 2 plus", (($tarjeta->obtenerValor() * 33) / 100), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Transbordo", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        if ($tarjeta->obtenerSaldo() >= $tarjeta->obtenerValor() * 3) {
          $tarjeta->resetTransbordo();
          $tarjeta->actualizarViaje($tiempo->tiempo(), $this->linea, $tiempo->obtenerFeriado()); ;
          $tarjeta->pagarPlus();
          $tarjeta->pagarNormal();
          return new Boleto("Paga 2 plus", $tarjeta->obtenerValor(), $tarjeta->obtenerId(), "Normal", $tarjeta->obtenerSaldo(), "Normal", $this->linea, $this->empresa, $this->numero, date("d/m/Y H:i:s", $tiempo->tiempo()));
        }
        else {
          return FALSE;
        }
      }

    }
  }
}
