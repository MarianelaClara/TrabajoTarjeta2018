<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $pagaPlus;
    protected $valor;
    protected $idTarjeta;
    protected $tipoTarjeta;
    protected $saldoActual;
    protected $tipoBoleto;
    protected $linea;
    protected $empresa;
    protected $numeroColectivo;
    protected $fecha;
    /**
     * Se encarga de darle los parametros iniciales al boleto.
     *
     * @param string $pagaPlus, float $valor, int $idTarjeta, string $tipoTarjeta, float $saldoActual, string $tipoBoleto, 
     * string $linea, string $empresa, int $numeroColectivo, string $fecha.
     * Siendo estos: un indicador si se paga el plus, el valor del coste del viaje, el id de la tarjeta, el tipo de la tarjeta,
     * el saldo actual luego de pagar el viaje, el tipo del boleto, la linea de colectivo usado, la empresa del mismo, su número
     * y la fecha en la que se hace el viaje.
     */
    public function __construct($pagaPlus, $valor, $idTarjeta, $tipoTarjeta, $saldoActual, $tipoBoleto, $linea, $empresa, $numeroColectivo, $fecha) {
        $this->pagaPlus = $pagaPlus;
        $this->valor = $valor;
        $this->idTarjeta = $idTarjeta;
        $this->tipoTarjeta = $tipoTarjeta;
        $this->saldoActual = $saldoActual;
        $this->tipoBoleto = $tipoBoleto;
        $this->linea = $linea;
        $this->empresa = $empresa;
        $this->numeroColectivo = $numeroColectivo;
        $this->fecha = $fecha;
    }

    /**
     * Devuelve el valor del boleto. Ejemplo: 14.80.
     *
     * @return float
     * El flotante retornado representa el valor del boleto en pesos.
     */
    public function obtenerValor() {
        return $this->valor;
    }
    /**
     * Devuelve el ID de la tarjeta que se usó para pagar el viaje. Ejemplo: 1.
     *
     * @return int
     * El entero retornado representa el ID de la tarjeta que se usó para pagar el viaje.
     */
    public function obtenerIdTarjeta() {
        return $this->idTarjeta;
    }
    /**
     * Devuelve el tipo de tarjeta que se usó para pagar el viaje. Ejemplo: "Medio".
     *
     * @return string
     *  El string indica de que tipo era la tarjeta que se usó para pagar el viaje.
     */
    public function obtenerTipoTarjeta() {
        return $this->tipoTarjeta;
    }
    /**
     * Devuelve el saldo actual de la tarjeta justo despues de pagar el viaje. Ejemplo: 50.5.
     *
     * @return float
     *  El flotante retornado indica en pesos el saldo restante de la tarjeta.
     */
    public function obtenerSaldoActual() {
        return $this->saldoActual;
    }
    /**
     * Devuelve el tipo del boleto emitido al realizar el viaje. Ejemplo: "Primer Plus".
     *
     * @return string
     *  El string indica que tipo de boleto fue el que se emitió al pagar el viaje.
     */
    public function obtenerTipoBoleto() {
        return $this->tipoBoleto;
    }
    /**
     * Devuelve la línea del colectivo que se usó para viajar. Ejemplo: "122 Negro".
     *
     * @return string
     *  El color y número del colectivo que se utilizó para viajar.
     */
    public function obtenerLinea() {
        return $this->linea;
    }
    /**
     * Devuelve el nombre de la empresa de colectivo que se abordó. Ejemplo: "Semtur".
     *
     * @return string
     *  El nombre de la empresa de colectivo.
     */ 
    public function obtenerEmpresa() {
        return $this->empresa;
    }
    /**
     * Devuelve el numero que representa el colectivo. Ejemplo: 3.
     *
     * @return int
     *  Representando al numero de colectivo de esa línea.
     */
    public function obtenerNumeroColectivo() {
        return $this->numeroColectivo;
    }
    /**
     * Devuelve la fecha en la que se emitio el boleto.
     *
     * @return strign
     *  Indica en fecha y tiempo el momento en el cual se emite el boleto.
     */
    public function obtenerFecha() {
        return $this->fecha;
    }
}
