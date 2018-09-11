<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;
    
    protected $tarjeta;

    protected $hora;

    protected $id;

    protected $tipoTarjeta;

    protected $costoPlus;

    protected $linea;

    protected $saldo;

    public function __construct($colectivo, $tarjeta, $valor, $hora, $id, $tipoTarjeta, $saldo, $linea, $costoPlus ) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->hora = $hora;
        $this->id = $id;
        $this->tipoTarjeta= $tipoTarjeta;
        $this->costoPlus = $costoPlus;
        $this->linea = $linea; 
        $this->saldo= $saldo;
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
    public function obtenerColectivo(){
        return $this->colectivo;
    }

    public function obtenerlinea() {
        return $this->linea;
    }

    public function obtenerTarjetaId(){
        return $this->id;
    }
    public function obtenerCostoplus(){
        return $this->costoPlus;
    }

    public function obtenersaldo(){
        return $this->saldo;
    }

    public function obtenertipoTarjeta(){
        return $this->tipoTarjeta;       
    }

    public function obtenerhora(){
        return $this->hora;
    }

}
