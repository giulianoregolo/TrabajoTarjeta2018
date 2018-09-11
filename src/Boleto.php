<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;
    
    protected $tarjeta;

    public function __construct($colectivo, $tarjeta, $valor) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        $this->valor = 14.80;
        return $this->valor;
    }

    public function obtenerColectivo() {
        return $this->colectivo;
    }

}
