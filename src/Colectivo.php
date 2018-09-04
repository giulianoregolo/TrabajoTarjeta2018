<?php
namespace TrabajoTarjeta;
class Colectivo implements ColectivoInterface {
    protected $empresa;
    protected $linea;
    protected $numero;
    
    public function __construct($empresa, $linea, $numero) {
        $this->empresa = $empresa;
        $this->linea = $linea;
        $this->numero = $numero;
    }

    public function empresa(): string {
        return $this->empresa;
    }

    public function linea(): string {
        return $this->linea;
    }

    public function numero(): int {
        return $this->numero;
    }

    public function pagarCon(TarjetaInterface $tarjeta) {
        if(!$tarjeta->pagarTarjeta()) return false;
        return new Boleto($tarjeta->obtenervalor(),$this,$tarjeta);
    }

}