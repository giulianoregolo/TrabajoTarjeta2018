<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $colectivo = new Colectivo("mixta","103",420);
        $valor=14.80;
        $boleto = new Boleto($colectivo,$tarjeta);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
}
