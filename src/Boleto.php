<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $hora;

    protected $id;

    protected $tipoTarjeta;

    protected $costoTotal;

    protected $linea;

    protected $saldo;

    protected $cantViajesplus;

    protected $tipoBoleto;


    public function __construct($tarjeta,$colectivo) {
        $this->valor = $tarjeta->obtenervalor();
        $this->hora = $colectivo->obtenerhora();
        $this->id = $tarjeta->obtenerId();
        $this->tipoTarjeta = $tarjeta->obtenerTipo();
        $this->linea = $colectivo->linea();
        $this->saldo = $tarjeta->obtenerSaldo();
        $this->canViajesplus = $tarjeta->obtenerPlus();
        $this->costoTotal = $tarjeta->obtenerCostoPlus();
        $this->tipoBoleto = $tarjeta->caso;
    }

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

    public function obtenerCostoTotal(){
        return $this->costoTotal;
    }

    public function obtenerTipoBoleto(){
        return $this->tipoBoleto;
    } 
}
