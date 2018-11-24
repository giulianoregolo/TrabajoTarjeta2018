<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioBoletoUniversitarioTest extends TestCase {

    /**
     * Comprueba que el medio boleto page la mitad que una tarjeta normal en un pago estandar.
     */
    public function testmedioboletouniversitarioTiempo() {
        $tiempo = new TiempoFalso();
        $tiempo->avanzar(36000);
        $medioboleto = new TarjetaMedioBoletoUniversitario($tiempo, null);
        $colectivo = new Colectivo("mixta","103",420);
        $colectivo2 = new Colectivo("mixta","102",421);
        $medioboleto->recargar(50.0);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(), 7.40);
        $tiempo->avanzar(240);
        $medioboleto->pagarTarjeta($colectivo2);
        $this->assertEquals($medioboleto->obtenerCosto(), 2.442);
        $tiempo->avanzar(7200);
        $medioboleto->pagarTarjeta($colectivo);
        $this->assertEquals($medioboleto->obtenerCosto(), 14.80);
    }
}