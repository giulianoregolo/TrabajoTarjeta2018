<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class Datos_Boleto_Test extends TestCase {

    public function test_boleto_normal() {
        $tiempo_prueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempo_prueba, NULL);
        $colectivo = new Colectivo( 'mixta', '103', 420 );
        $tarjeta->recargar( 20.0 );
        $boleto = $colectivo->pagar_con( $tarjeta );
        $this->assertEquals( $boleto->obtener_valor(), 14.80 );
        $this->assertEquals( $boleto->obtener_saldo(), 5.20 );
        $this->assertEquals( $boleto->obtener_tarjeta_id(), $tarjeta->obtenerId() );
        $this->assertEquals( $boleto->obtener_linea(), '103' );
        $this->assertEquals( $boleto->obtener_tipo_boleto(), 'Normal' );
    }
    public function test_boleto_plus() {
        $tiempo_prueba = new Tiempo();
        $tarjeta = new Tarjeta( $tiempo_prueba, NULL );
        $colectivo = new Colectivo( 'mixta', '103', 420 );
        $boleto = $colectivo->pagar_con( $tarjeta );
        $this->assertEquals( $boleto->obtener_costo_total(), 0.0 );
        $this->assertEquals( $boleto->obtener_saldo(), 0.0 );
        $this->assertEquals($boleto->obtener_tarjeta_id(), $tarjeta->obtenerId() );
        $this->assertEquals($boleto->obtener_linea(), '103' );
        $this->assertEquals($boleto->obtener_tipo_boleto(), 'viajeplus' );
    }
    public function test_boleto_pagando_plus() {
        $tiempo_prueba = new Tiempo();
        $tarjeta = new Tarjeta( $tiempo_prueba, NULL );
        $colectivo = new Colectivo( 'mixta', '103', 420 );
        $tarjeta->gastar_plus();
        $tarjeta->recargar( 50.0 );
        $boleto = $colectivo->pagar_con( $tarjeta );
        $this->assertEquals( $boleto->obtener_valor(), 14.80 );
        $this->assertEquals( $boleto->obtener_costo_plus(), 14.80 );
        $this->assertEquals( $boleto->obtener_costo_total(), 29.6 );
        $this->assertEquals( $boleto->obtener_saldo(), 20.4 );
        $this->assertEquals( $boleto->obtener_tarjeta_id(), $tarjeta->obtener_id() );
        $this->assertEquals( $boleto->obtener_linea(), '103' );
        $this->assertEquals( $boleto->obtener_tipo_boleto(), 'Pagando Plus' );
    }
}