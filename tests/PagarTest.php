<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class PagarTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo;
		$tarjeta->saldo = 14.80;

        $this->assertTrue($tarjeta->viajeplus(14.80));
        $this->assertEquals($colectivo->pagarCon , True);

    }

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
      $tarjeta = new Tarjeta;

      $this->assertFalse($tarjeta->recargar(15));
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
  }
}
