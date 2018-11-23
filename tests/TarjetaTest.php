<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);

        $this->assertTrue($tarjeta->recargar(10));
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $this->assertTrue($tarjeta->recargar(20));
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);
    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);

      $this->assertFalse($tarjeta->recargar(15));
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
    }
}
