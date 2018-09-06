<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testpagarmontoEstandar() {
        $tarjeta = new Tarjeta;
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $tarjeta->recargar(14.80);
        $medioboleto->recargar(7.40);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $colectivo->pagarCon( $medioboleto));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con un viaje plus acumulado
     */
    public function testpagarmontoviajeplusSimple() {
        $tarjeta = new Tarjeta;
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $colectivo->pagarCon($tarjeta);
        $colectivo->pagarCon($medioboleto);
        $tarjeta->recargar(29.60);
        $medioboleto->recargar(14.80);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $colectivo->pagarCon( $medioboleto));
    }
    
    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago con dos viajes plus acumulados
     */
    public function testpagarmontoviajeplusDoble() {
        $tarjeta = new Tarjeta;
        $medioboleto = new TarjetamedioBoleto;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $colectivo->pagarCon($tarjeta);
        $colectivo->pagarCon($tarjeta);
        $colectivo->pagarCon($medioboleto);
        $colectivo->pagarCon($medioboleto);
        $tarjeta->recargar(44.40);
        $medioboleto->recargar(22,20);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $colectivo->pagarCon( $medioboleto));
    }
}