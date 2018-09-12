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

    public function __construct($pagaPlus, $valor, $idTarjeta, $tipoTarjeta, $saldoActual, $tipoBoleto, $linea, $empresa, $numeroColectivo, $fecha) {
        $this->pagaPlus= $pagaPlus;
        $this->valor = $valor;
        $this->idTarjeta= $idTarjeta;
        $this->tipoTarjeta= $tipoTarjeta;
        $this->saldoActual= $saldoActual;
        $this->tipoBoleto= $tipoBoleto;
        $this->linea= $linea;
        $this->empresa= $empresa;
        $this->numeroColectivo= $numeroColectivo;
        $this->fecha= $fecha;
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        return $this->valor;
    }

    public function obtenerIdTarjeta(){
        return $this->idTarjeta;
    }

    public function obtenerTipoTarjeta(){
        return $this->tipoTarjeta;
    }

    public function obtenerSaldoActual(){
        return $this->saldoActual;
    }

    public function obtenerTipoBoleto(){
        return $this->tipoBoleto;
    }

    public function obtenerLinea(){
        return $this->linea;
    }

    public function obtenerEmpresa(){
        return $this->empresa;
    }

    public function obtenerNumeroColectivo(){
        return $this->numeroColectivo;
    }

    public function obtenerFecha(){
        return $this->fecha;
    }

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
}
