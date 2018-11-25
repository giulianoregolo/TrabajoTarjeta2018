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
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-7.40));
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
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-22.2));
        $this->assertEquals($medioboleto->obetenerPlus(),1);
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
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-37.0));
        $this->assertEquals($medioboleto->obetenerPlus(),0);
    }
    
    public function testmedioboletoTiempo() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetamedioBoleto($tiempo, null);
        $medioboleto->recargar(50.0);
        $tiemponuevo = new TiempoFalso();
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->pagarTarjeta($colectivo), false);
    }
    

}
