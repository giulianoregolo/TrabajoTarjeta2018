<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaviajeplusTest extends TestCase {

    /**
     * Comprueba que se puede usar viajes plus.
     */
	 public function testusarviajesplus(){
		 $tarjeta = new Tarjeta;

		 $this->asserTrue($tarjeta->gastarPlus());
		 $this->assertEqueals($tarjeta->obtenerPlus(),1);

		 $this->asserTrue($tarjeta->gastarPlus());
		 $this->assertEqueals($tarjeta->obtenerPlus(),2);

	 }
}
