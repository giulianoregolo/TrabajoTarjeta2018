<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testpagarmontoEstandar() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $this->assertEquals($medioboleto->pagarTarjeta($colectivo),True);
        $this->assertEquals($medioboleto->obtenerCosto(),7.4);
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con un viaje plus acumulado
     */
    public function testpagarmontoviajeplusSimple() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $medioboleto->gastarPlus();
        $this->assertEquals($medioboleto->obetenerPlus(),1);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(),(22.2));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con dos viajes plus acumulados
     */
    public function testpagarmontoviajeplusDoble() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);;
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $medioboleto->gastarPlus();
        $medioboleto->gastarPlus();
        $this->assertEquals($medioboleto->obetenerPlus(),0);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(),(37.0));
    }
    
    public function testmedioboletoTiempo() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $medioboleto->recargar(50.0);
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->pagarTarjeta($colectivo);
        $tiempo->avanzar(240);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->pagarTarjeta($colectivo), true);
        $this->assertEquals($medioboleto->obtenerCosto(),14.80);
    }
    
    public function testMedioboletoViajeplus(){
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $colectivo = new Colectivo("mixta","133",420);
        $this->assertEquals($medioboleto->obetenerPlus(),2);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obetenerPlus(),1);
        $medioboleto->gastarPlus();
        $this->assertEquals($medioboleto->obetenerPlus(),0);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->pagarTarjeta(),false);
    }

    public function testMedioboletotrasbordoNormal(){
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $colectivo = new Colectivo("mixta","133",420);
        $colectivo2 = new Colectivo("mixta","102",421);
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(), 7.40);
        $tiempo->avanzar(300);
        $medioboleto->pagarTarjeta($colectivo2);
        $this->assertEquals($medioboleto->obtenerCosto(), 2.442);
    }
}
