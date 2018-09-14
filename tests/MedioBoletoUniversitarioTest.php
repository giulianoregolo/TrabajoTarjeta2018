<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testmedioboletouniversitarioTiempo() {
        $medioboleto = new TarjetamedioBoletoUniversitario;
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta();
        $medioboleto->pagarTarjeta();
        $medioboleto->pagarTarjeta();
        $this->assertEquals($medioboleto->obtenerSaldo(), 20.4);
    }
}