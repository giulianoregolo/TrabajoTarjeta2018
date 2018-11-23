<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest2 extends TestCase {

    /**
     * Comprueba que la tarjeta pueda pagar con saldo.
     */
    public function testpagarmontoConsaldo() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $colectivo = new Colectivo("mixta","103",420);
        $tarjeta->recargar(50.0);
        $this->assertEquals($tarjeta->obtenerSaldo(),35.2);
    }

    /**
     * Comprueba que la tarjeta puede pagar sin saldo.
     */
    public function testpagarmontoSinsaldo() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
		$colectivo = new Colectivo("mixta","103",420);
        $boleto = $colectivo->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->obetenerPlus(),1);
        $this->assertEquals($tarjeta->obtenerSaldo(),0.0);
    }    
}
