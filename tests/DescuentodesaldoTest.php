<?php
namespace TrabajoTarjeta;
use PHPUnit\Framework\TestCase;
class DescuentodesaldoTest extends TestCase {
    /**
     * Comprueba que se descuente los viajes plus del saldo.
     */
     
    public function testDescuentoDeUnPlus() {
        $tarjeta = new Tarjeta();
        $tarjeta->saldo= 100.0;
        $tarjeta->viajesplus=1;
        $cole= new Colectivo(NULL,NULL,NULL);
        $boleto= new Boleto($cole,$tarjeta,$valor=29.60);

        $this->assertEquals($cole->pagarCon($tarjeta), $boleto);
        $this->assertEquals($tarjeta->obtenerSaldo(),(100.0-29.60));
    } 
    public function testDescuentoDeDosPlus() {
        $tarjeta = new Tarjeta();
        $tarjeta->saldo= 100.0;
        $tarjeta->viajesplus=0;
        $cole= new Colectivo(NULL,NULL,NULL);
        $boleto= new Boleto($cole,$tarjeta,$valor=44.4);

        $this->assertEquals($cole->pagarCon($tarjeta), $boleto);
        $this->assertEquals($tarjeta->obtenerSaldo(),(100.0-44.40));
    } 
}