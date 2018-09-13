<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class FranquiciaCompletaTest extends TestCase {

    /**
     * Comprueba que la Francuicia completa siempre pueda pagar.
     */
    public function testpagarmontoestandar() {
        $fCompleta = new TarjetaFranquiciaCompleta;
        $colectivo = new Colectivo("mixta","103",420);
        $this->assertEquals($colectivo->pagarCon($fCompleta), new Boleto($colectivo,$fCompleta));
        $this->assertEquals($fCompleta->obtenerSaldo(),(0.0));
    }
    
}
