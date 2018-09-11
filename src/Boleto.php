<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $hora;

    protected $id;

    protected $tipoTarjeta;

    protected $linea;

    protected $saldo;

    public function __construct($valor, $hora, $id, $tipoTarjeta, $saldo, $linea ) {
        $this->valor = $valor;
        $this->hora = $hora;
        $this->id = $id;
        $this->tipoTarjeta= $tipoTarjeta;
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

    public function obtenerlinea() {
        return $this->linea;
    }

    public function obtenerTarjetaId(){
        return $this->id;
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
