<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoUniversitarioTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testmedioboletouniversitarioTiempo() {
        $tiempo = new Tiempo();
        $medioboleto = new TarjetaMedioBoletoUniversitario($tiempo, null);
        $colectivo = new Colectivo("mixta","103",420);
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta($colectivo);
        $medioboleto->pagarTarjeta($colectivo);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerSaldo(), 20.4);
    }
}