<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest extends TestCase {

    /**
     * Comprueba que la tarjeta pueda pagar con saldo.
     */
    public function testpagarmontoConsaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo;
		$tarjeta->saldo = 14.80;

        $this->assertTrue($tarjeta->viajeplus(14.80));
        $this->assertEquals($colectivo->pagarCon , True);

    }

    /**
     * Comprueba que la tarjeta puede pagar sin saldo.
     */
    public function testpagarmontoSinsaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo;
		$tarjeta->saldo = 0;

        $this->assertTrue($tarjeta->viajeplus(14.80));
        $this->assertEquals($colectivo->pagarCon , True);
    }    
}
