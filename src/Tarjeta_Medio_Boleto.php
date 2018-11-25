<?php

namespace TrabajoTarjeta;

class Tarjeta_Medio_Boleto extends Tarjeta {

    protected $tipo = 'Medio';

    protected $tiempo_de_espera = 300;

    protected $valor = 14.80;

    protected $ultimopago = null;

    public function pagar_tarjeta( $colectivo ) {
        $this->valor = 14.80;
        if ( $this->tiempo_de_espera_cumplido() ) {
		    $this->valor = $this->valor / 2; 	
        } else {
            $this->valor = 14.80;
        }
        if ( $this->saldo < $this->valor ) {
            switch ( $this->viajesplus ) {
                case 0:
                    return false;
                case 1:
                    $this->gastar_plus();
                    $this->costo = 0.0;
                    $this->caso = 'Viaje Plus';
                    $this->guardo_cole( $colectivo );
                    $this->trasbordo = true;
                    return true;
                case 2:
                    $this->gastar_plus();
                    $this->costo = 0.0;
                    $this->caso = 'Viaje Plus';
                    $this->guardo_cole( $colectivo );
                    $this->trasbordo = true;
                    return true;
            }
        } else {
            switch ( $this->viajesplus ) {
                case 0:
                    $this->costo_plus = 14.80 + 14.80;
                    if ( $this->saldo < $this->costo ) {
                        return false;
                    } else {
                        if ( $this->hay_trans ( $colectivo ) ) {
                            $this->valor = ( $this->valor * 33 ) / 100;
                            $this->costo = $this->costo_plus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = 'Trasbordo';
                            $this->ultimo_pago = $this->tiempo->time();
                            $this->guardo_cole( $colectivo );
                            $this->trasbordo = false;
                            $this->viajes_plus = 2;
                            return true;
                        } else {
                            $this->costo = $this->costo_plus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = 'Pagando Plus';
                            $this->ultimo_pago = $this->tiempo->time();
                            $this->guardo_cole( $colectivo );
                            $this->trasbordo = true;
                            $this->viajes_plus = 2;
                            return true;
                        }
                    }

                case 1:
                    $this->costo_plus = 14.80;
                    if ( $this->saldo < $this->costo ) {
                        return false;
                    } else {
                        if ( $this->hay_trans( $colectivo ) ) {
                            $this->valor = ( $this->valor * 33 ) / 100;
                            $this->costo = $this->costo_plus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = 'Trasbordo';
                            $this->ultimo_pago = $this->tiempo->time();
                            $this->guardo_cole ($colectivo );
                            $this->trasbordo = false;
                            $this->viajes_plus = 2;
                            return true;
                        } else {
                            $this->costo = $this->costo_plus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = 'Pagando Plus';
                            $this->ultimo_pago = $this->tiempo->time();
                            $this->guardo_cole( $colectivo );
                            $this->trasbordo = true;
                            $this->viajes_plus = 2;
                            return true;
                        }
                    }
                case 2:
                    if( $this->hay_trans( $colectivo ) ) { 
                        $this->valor = ( $this->valor * 33 ) / 100;
                        $this->costo = $this->costo_plus + $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = 'Trasbordo';
                        $this->ultimo_pago = $this->tiempo->time();
                        $this->guardo_cole( $colectivo );
                        $this->trasbordo = false;
                        return true;
                    } else{
                        $this->costo = $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = 'Medio';
                        $this->ultimo_pago = $this->tiempo->time();
                        $this->guardo_cole( $colectivo );
                        $this->trasbordo = true;
                        return true;
                    }    
            }
        }
    
    }

    public function tiempo_de_espera_cumplido() {
        $ultimo_pago = $this->obtener_ultima_fecha_pagada();
        $fecha_actual = $this->tiempo->time();
        $diferencia_fechas = $fecha_actual - $ultimo_pago;
        if( $diferencia_fechas >= $this->obtener_tiempo_de_espera() ) {
            return true;
        } else {
            return false;
        }
    }
    public function obtener_tiempo_de_espera() {
        return $this->tiempo_de_espera;
    }
    public function obtener_ultima_fecha_pagada() {
        return $this->ultimo_pago;
    }
}
