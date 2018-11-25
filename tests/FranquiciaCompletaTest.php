<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class Franquicia_Completa_Test extends TestCase {

    /**
     * Comprueba que la Francuicia completa siempre pueda pagar.
     */
    public function test_pagar_monto_estandar() {
        $tiempo = new Tiempo();
        $franquicia_Completa = new Tarjeta_Franquicia_Completa ( $tiempo, null );
        $colectivo = new Colectivo( 'mixta', '103', 420 );
        $this->assertEquals( $colectivo->pagar_con( $fCompleta ), new Boleto( $colectivo, $fCompleta ) );
        $this->assertEquals( $fCompleta->obtener_saldo(), ( 0.0 ) );
    }
    
}
