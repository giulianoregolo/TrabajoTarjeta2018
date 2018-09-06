<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest2 extends TestCase {

    /**
     * Comprueba que la tarjeta pueda pagar con saldo.
     */
    public function testpagarmontoConsaldo() {
        $tarjeta = new Tarjeta;
        $colectivo = new Colectivo(NULL,NULL,NULL);
        $boleto= new Boleto($colectivo,$tarjeta,$valor=14.80);
        $tarjeta->recargar(14.80);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $boleto);

    }

    /**
     * Comprueba que la tarjeta puede pagar sin saldo.
     */
    public function testpagarmontoSinsaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo(NULL,NULL,NULL);
        $boleto= new Boleto($colectivo,$tarjeta,$valor=14.80);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), $boleto);
    }    
}