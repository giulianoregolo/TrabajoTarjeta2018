<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaviajeplusTest extends TestCase {

    /**
     * Comprueba que si puede usar viajes plus.
     */
	 public function testusarviajesplus(){
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
		$colectivo = new Colectivo("mixta","103",420);

        $this->assertEquals($colectivo->pagarCon($tarjeta), new Boleto($colectivo,$tarjeta));

        $this->assertEquals($colectivo->pagarCon($tarjeta), new Boleto($colectivo,$tarjeta));

	 }
	/**
     * Comprueba que no si puede usar mas de 2 viajes plus.
     */
	public function testnousarmasviajesplus(){
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
		$colectivo = new Colectivo("mixta","103",420);
        $colectivo->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->obetenerPlus(), 1);
        $colectivo->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->obetenerPlus(), 0);
        $this->assertEquals($colectivo->pagarCon($tarjeta), False);

	}


}
