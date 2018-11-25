<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class medio_boletoUniversitarioTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function test_medio_boleto_universitario_tiempo() {
        $tiempo = new Tiempo_Falso();
        $tiempo->avanzar( 36000 );
        $medio_boleto = new Tarjeta_Medio_Boleto_Universitario($tiempo, null);
        $colectivo = new Colectivo( 'mixta', '103', 420 );
        $colectivo2 = new Colectivo(  'mixta',  '102',  421 );
        $medio_boleto->recargar( 50.0 );
        $medio_boleto->pagar_tarjeta($colectivo);
        $this->assertEquals( $medio_boleto->obtener_costo(), 7.40 );
        $tiempo->avanzar( 300 );
        $medio_boleto->pagar_tarjeta( $colectivo2 );
        $this->assertEquals( $medio_boleto->obtener_costo(), 2.442 );
        $tiempo->avanzar( 7200 );
        $medio_boleto->pagar_tarjeta( $colectivo );
        $this->assertEquals( $medio_boleto->obtener_costo(), 14.80 );
    }
    public function testmedio_boleto_un_viajeplus(){
        $tiempo = new Tiempo_Falso();
        $tiempo->avanzar( 36000 );
        $medio_boleto = new Tarjeta_Medio_Boleto_Universitario( $tiempo, null );
        $colectivo = new Colectivo( 'mixta', '133', 420 );
        $this->assertEquals( $medio_boleto->obtener_cantidad_viajes_plus(), 2 );
        $medio_boleto->pagar_tarjeta($colectivo);
        $this->assertEquals( $medio_boleto->obtener_cantidad_viajes_plus(), 1 );
        $medio_boleto->gastar_plus();
        $this->assertEquals( $medio_boleto->obtener_cantidad_viajes_plus() ,0 );
        $medio_boleto->pagar_tarjeta( $colectivo );
        $this->assertEquals( $medio_boleto->pagar_tarjeta( $colectivo ), false );
    }
    public function testmedio_boleto_trasbordo_normal(){
        $tiempo = new Tiempo_Falso();
        $tiempo->avanzar( 36000 );
        $medio_boleto = new Tarjeta_Medio_Boleto_Universitario( $tiempo, null );
        $colectivo = new Colectivo( 'mixta', '133', 420 );
        $colectivo2 = new Colectivo(  'mixta',  '102',  421 );
        $medio_boleto->recargar( 50.0 );
        $medio_boleto->pagar_tarjeta( $colectivo );
        $this->assertEquals( $medio_boleto->obtener_costo(), 7.40 );
        $tiempo->avanzar( 300 );
        $medio_boleto->pagar_tarjeta( $colectivo2 );
        $this->assertEquals( $medio_boleto->obtener_costo(), 2.442 );
    }
    public function testmedio_boleto_trasbordo_CUVP(){
        $tiempo = new Tiempo_Falso();
        $tiempo->avanzar( 36000 );
        $medio_boleto = new Tarjeta_Medio_Boleto_Universitario( $tiempo, null );
        $colectivo = new Colectivo( 'mixta', '133', 420 );
        $colectivo2 = new Colectivo(  'mixta',  '102',  421 );
        $medio_boleto->recargar( 50.0 );
        $medio_boleto->pagar_tarjeta( $colectivo );
        $this->assertEquals( $medio_boleto->obtener_costo(), 7.40 );
        $medio_boleto->gastar_plus();
        $tiempo->avanzar( 300 );
        $medio_boleto->pagar_tarjeta( $colectivo2 );
        $this->assertEquals( $medio_boleto->obtener_costo(), 17.242 );
    }
    public function testmedio_boleto_trasbordo_plus(){
        $tiempo = new Tiempo_Falso();
        $tiempo->avanzar( 36000 );
        $medio_boleto = new Tarjeta_Medio_Boleto_Universitario( $tiempo, null );
        $colectivo = new Colectivo( 'mixta', '133', 420 );
        $colectivo2 = new Colectivo(  'mixta',  '102',  421 );
        $medio_boleto->recargar( 50.0 );
        $medio_boleto->pagar_tarjeta( $colectivo );
        $this->assertEquals( $medio_boleto->obtener_costo(), 7.40 );
        $medio_boleto->gastar_plus();
        $medio_boleto->gastar_plus();
        $tiempo->avanzar( 300 );
        $medio_boleto->pagar_tarjeta( $colectivo2 );
        $this->assertEquals( $medio_boleto->obtener_costo(), 32.042 );
    }
}