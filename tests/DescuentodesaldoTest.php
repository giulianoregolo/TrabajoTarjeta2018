<?php
namespace TrabajoTarjeta;
use PHPUnit\Framework\TestCase;
class DescuentodesaldoTest extends TestCase {
    /**
     * Comprueba que se descuente los viajes plus del saldo.
     */
     
    public function testDescuentoDeUnPlus() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $cole= new Colectivo("mixta","103",420);        
        $tarjeta->recargar(100.0);
        $tarjeta->gastarPlus();
        
        $this->assertEquals($cole->pagarCon($tarjeta), $boleto= new Boleto($cole,$tarjeta));
        $this->assertEquals($tarjeta->obtenerSaldo(),(100.0-29.60));
    }
    public function testDescuentoDeDosPlus() {
        $tiempoprueba = new Tiempo();
        $tarjeta = new Tarjeta($tiempoprueba, NULL);
        $cole= new Colectivo("mixta","103",420);
        $tarjeta->recargar(100.0);
        $tarjeta->gastarPlus();
        $tarjeta->gastarPlus();
        $this->assertEquals($cole->pagarCon($tarjeta), $boleto= new Boleto($cole,$tarjeta));
        $this->assertEquals($tarjeta->obtenerSaldo(),(100.0-44.40));
    }
}