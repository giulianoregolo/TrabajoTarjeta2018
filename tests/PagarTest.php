<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest extends TestCase {

    /**
     * Comprueba que la tarjeta pueda pagar con saldo.
     */
    public function testpagarmontoConsaldo() {
        $tarjeta = new Tarjeta;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $boleto= new Boleto($colectivo,$tarjeta,$valor);
        $tarjeta->saldo = 14.80;
        
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $boleto);

    }

    /**
     * Comprueba que la tarjeta puede pagar sin saldo.
     */
    public function testpagarmontoSinsaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo(NULL,NULL,NULL);
		$tarjeta->saldo = 0;

        $this->assertEquals($colectivo->pagarCon( $tarjeta), $boleto);
    }    
}
