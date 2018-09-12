<?php

namespace TrabajoTarjeta;

interface BoletoInterface {

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor();

    public function obtenerlinea();

    public function obtenerTarjetaId();

    public function obtenersaldo();

    public function obtenertipoTarjeta();

    //public function obtenerhora();

    public function obtenerCostoTotal();

    public function obtenerTipoBoleto();
}
