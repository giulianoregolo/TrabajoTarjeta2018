<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class Colectivo_Test extends TestCase {

    public function test_muestra_linea() {
	$colectivo = new Colectivo( 'mixta', '103', 420 );
    $this->assertEquals( $colectivo->empresa(), 'mixta' );
	$this->assertEquals( $colectivo->linea(), '103' );
	$this->assertEquals( $colectivo->numero(), 420 );
    }
}
