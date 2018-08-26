<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class DescuentodesaldoTest extends TestCase {

    /**
     * Comprueba que se descuente los viajes plus del saldo.
     */
     
    public function Descuentodeplus() {
        $tarjeta = new Tarjeta;
        $tarjeta->saldo= 0.0;
        $tarjeta->viajesplus=0;

        $this->assertTrue($tarjeta->recargar(20));
        $this->assertEquals($tarjeta->obtenerSaldo(), 3.20);
    } 
}
