<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest2 extends TestCase {

    /**
     * Comprueba que la tarjeta pueda pagar con saldo.
     */
    public function testpagarmontoConsaldo() {
        $tarjeta = new Tarjeta;
        $colectivo = new Colectivo("mixta","103",420);
        $tarjeta->recargar(14.80);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), new Boleto($colectivo,$tarjeta));
        $this->assertEquals($tarjeta->obtenerSaldo,0.0);
    }

    /**
     * Comprueba que la tarjeta puede pagar sin saldo.
     */
    public function testpagarmontoSinsaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo("mixta","103",420);
        $this->assertEquals($colectivo->pagarCon( $tarjeta), new Boleto($colectivo,$tarjeta));
        $this->assertEquals($tarjeta->obetenerPlus,1);
        $this->assertEquals($tarjeta->obtenerSaldo,0.0);
    }    
}
