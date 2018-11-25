<?php

namespace TrabajoTarjeta;

interface Boleto_Interface {

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtener_valor();

    public function obtener_linea();

    public function obtener_tarjeta_id();

    public function obtener_saldo();

    public function obtenertipo_tarjeta();

    public function obtener_costo_total();

    public function obtener_tipo_boleto();
    
    public function obtener_costo_plus();
}
