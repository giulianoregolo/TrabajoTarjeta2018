<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class Boleto_Test extends TestCase {

    public function test_saldo_cero() {
        $tiempo_prueba = new Tiempo();
        $tarjeta = new Tarjeta( $tiempoprueba, NULL );
        $colectivo = new Colectivo( 'mixta','103', 420 );
        $valor = 14.80;
        $boleto = new Boleto( $colectivo, $tarjeta );
        $this->assertEquals( $boleto->obtener_valor(), $valor );
    }
}
