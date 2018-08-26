<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaviajeplusTest extends TestCase {

    /**
     * Comprueba que si puede usar viajes plus.
     */
	 public function testusarviajesplus(){
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo(NULL,NULL,NULL);
		$tarjeta->saldo = 0;

        
        $this->assertEquals($colectivo->pagarCon($tarjeta), True);

        
        $this->assertEquals($colectivo->pagarCon($tarjeta), True);

	 }
	/**
     * Comprueba que no si puede usar mas de 2 viajes plus.
     */
	public function testnousarmasviajesplus(){
        $tarjeta = new Tarjeta;
		$colectivo = new Colectivo(NULL,NULL,NULL);
		$tarjeta->saldo = 0;

        ;
        $this->assertEquals($colectivo->pagarCon($tarjeta), True);

        
        $this->assertEquals($colectivo->pagarCon($tarjeta), True);

        
        $this->assertEquals($colectivo->pagarCon($tarjeta), False);

	}


}
