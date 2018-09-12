<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $tarjeta = new Tarjeta;
        $valor=14.80;
        $boleto = new Boleto(NULL,$tarjeta);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
}
