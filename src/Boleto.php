<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;
    
    protected $tarjeta;

    public function __construct($colectivo, $tarjeta, $valor = 14.80) {
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
        switch ($caso){
           case 0: 
                $this->valor = 14.80;
                break;
           case 1: 
                $this->valor = 7.40;
                break;
           case 2:
                $this->calor = 0.0;
                break;
        }
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
