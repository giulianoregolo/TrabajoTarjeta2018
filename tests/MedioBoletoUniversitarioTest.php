<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoUniversitarioTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testmedioboletouniversitarioTiempo() {
        $tiempo = new TiempoFalso();
        $medioboleto = new TarjetaMedioBoletoUniversitario($tiempo, null);
        $colectivo = new Colectivo("mixta","103",420);
        $colectivo2 = new Colectivo("mixta","102",421);
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta($colectivo);
        $tiempo->avanzar(240);
        $medioboleto->pagarTarjeta($colectivo2);
        $tiempo->avanzar(7200);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(), 24.642);
    }
}