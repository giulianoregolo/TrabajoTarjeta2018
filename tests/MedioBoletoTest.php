<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testpagarmontoEstandar() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto);
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-7.40));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con un viaje plus acumulado
     */
    public function testpagarmontoviajeplusSimple() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto);
        $medioboleto->gastarPlus();
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-22.2));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con dos viajes plus acumulados
     */
    public function testpagarmontoviajeplusDoble() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo("mixta","133",420);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto);
        $medioboleto->gastarPlus();
        $medioboleto->gastarPlus();
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-37.0));
    }
}
