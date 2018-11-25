<?php

namespace TrabajoTarjeta;

class Boleto implements Boleto_Interface {

    protected $valor;

    protected $id;

    protected $tipoTarjeta;

    protected $costoTotal;

    protected $linea;

    protected $saldo;

    protected $canViajesplus;

    protected $tipoBoleto;

    protected $costoplus;


    public function __construct( $colectivo, $tarjeta ) {
        $this->valor = $tarjeta->obtenervalor();
        $this->hora = $tarjeta->obtenerhora();
        $this->id = $tarjeta->obtenerId();
        $this->tipoTarjeta = $tarjeta->obtenerTipo();
        $this->linea = $colectivo->linea();
        $this->saldo = $tarjeta->obtenerSaldo();
        $this->canViajesplus = $tarjeta->obetenerPlus();
        $this->costoTotal = $tarjeta->obtenerCosto();
        $this->tipoBoleto = $tarjeta->caso;
        $this->costoplus = $tarjeta->obtenerCostoPlus();
    }

    public function obtener_valor() {
        return $this->valor;
    }

    public function obtener_linea() {
        return $this->linea;
    }

    public function obtener_tarjeta_id() {
        return $this->id;
    }

    public function obtener_saldo() {
        return $this->saldo;
    }

    public function obtener_tipo_tarjeta() {
        return $this->tipoTarjeta;       
    }

    public function obtener_hora() {
        return $this->hora;
    }

    public function obtener_costo_total() {
        return $this->costoTotal;
    }

    public function obtener_tipo_boleto() {
        return $this->tipoBoleto;
    } 
    public function obtener_costo_plus() {
        return $this->costoplus;
    }

}
