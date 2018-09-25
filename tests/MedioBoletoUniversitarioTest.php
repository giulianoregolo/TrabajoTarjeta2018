<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoUniversitarioTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testmedioboletouniversitarioTiempo() {
        $tiempo = new Tiempo();
        $medioboleto = new TarjetamedioBoletoUniversitario($tiempo, null);
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta();
        $medioboleto->pagarTarjeta();
        $medioboleto->pagarTarjeta();
        $this->assertEquals($medioboleto->obtenerSaldo(), 20.4);
    }
}