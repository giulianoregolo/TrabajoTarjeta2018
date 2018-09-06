<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testpagarmontoEstandar() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto,$valor=7.40);
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-7.40));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con un viaje plus acumulado
     */
    public function testpagarmontoviajeplusSimple() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto,$valor=22.2);
        $medioboleto->gastarPlus();
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-22.2));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con dos viajes plus acumulados
     */
    public function testpagarmontoviajeplusDoble() {
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $medioboleto->recargar(50.0);
        $boleto= new Boleto($colectivo,$medioboleto,$valor=37.0);
        $medioboleto->gastarPlus();
        $medioboleto->gastarPlus();
        $this->assertEquals($colectivo->pagarCon($medioboleto), $boleto);
        $this->assertEquals($medioboleto->obtenerSaldo(),(50.0-37.0));
    }
}
