<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;
	
    protected $saldoActual;

    public function __construct($valor, $colectivo, $saldo) {
        $this->valor = $valor;
	    $this->colectivo= $colectivo;
	    $this->saldoActual= $saldo;
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        return $this->valor;
    }

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo() {
	    return $this->colectivo;
    }

}
