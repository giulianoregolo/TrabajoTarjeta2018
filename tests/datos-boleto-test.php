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
        $this->assertEquals( $boleto->obtenerValor(), 14.80 );
        $this->assertEquals($boleto->obtenersaldo(),5.20);
        $this->assertEquals($boleto->obtenerTarjetaId(),$tarjeta->obtenerId());
        $this->assertEquals($boleto->obtenerlinea(),"103");
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Normal");
    }
    public function testBoletoplus() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $colectivo = new Colectivo("mixta","103",420);
        $boleto = $colectivo->pagarCon($tarjeta);
        $this->assertEquals($boleto->obtenerCostoTotal(),0.0);
        $this->assertEquals($boleto->obtenersaldo(),0.0);
        $this->assertEquals($boleto->obtenerTarjetaId(),$tarjeta->obtenerId());
        $this->assertEquals($boleto->obtenerlinea(),"103");
        $this->assertEquals($boleto->obtenerTipoBoleto(),"viajeplus");
    }
    public function testBoletoPagandoPlus() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $colectivo = new Colectivo("mixta","103",420);
        $tarjeta->gastarPlus();
        $tarjeta->recargar(50.0);
        $boleto = $colectivo->pagarCon($tarjeta);
        $this->assertEquals($boleto->obtenerValor(),14.80);
        $this->assertEquals($boleto->obtenerCostoPlus(),14.80);
        $this->assertEquals($boleto->obtenerCostoTotal(),29.6);
        $this->assertEquals($boleto->obtenersaldo(),20.4);
        $this->assertEquals($boleto->obtenerTarjetaId(),$tarjeta->obtenerId());
        $this->assertEquals($boleto->obtenerlinea(),"103");
        $this->assertEquals($boleto->obtenerTipoBoleto(),"pagandoPlus");
    }
}