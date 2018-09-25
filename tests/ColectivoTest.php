<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testmuestralinea() {
	$colectivo = new Colectivo("mixta","103",420);
    $this->assertEquals($colectivo->empresa(),"mixta");
	$this->assertEquals($colectivo->linea(),"103");
	$this->assertEquals($colectivo->numero(),420);
    }
}
