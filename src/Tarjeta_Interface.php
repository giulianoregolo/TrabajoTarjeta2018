<?php

namespace TrabajoTarjeta;

interface Tarjeta_Interface {

    /**
     * Recarga una tarjeta con un cierto valor de dinero.
     *
     * @param float $monto
     *
     * @return bool
     *   Devuelve TRUE si el monto a cargar es válido, o FALSE en caso de que no
     *   sea valido.
     */
    public function recargar( $monto );

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtener_saldo();
    
    public function obetener_plus();
    
    public function pagar_tarjeta( $colectivo );
    
    public function gastar_plus();

    public function obtener_valor();
    
    public function obtener_costo();

    public function obtener_id();

    public function obtener_costo_plus();
    
    public function obtener_tipo();

    public function es_trasbordo( $colectivo );

}
