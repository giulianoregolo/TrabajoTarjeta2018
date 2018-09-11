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
        if(!$tarjeta->pagarTarjeta()) {
            return false;
        }
        switch($tarjeta->caso){
            case "Normal":
                return new Boleto($tarjeta->obtenerCosto(),time(),$tarjeta->obtenerId(),$tarjeta->tipo,$tarjeta->obtenerSaldo(),$this->linea);
            case "viajeplus":
                return new BoletoPlus($this->linea,time(),$tarjeta->obtenerCosto(),$tarjeta->obtenerId(),$tarjeta->obtenerSaldo());
            case "pagandoPlus":
            return new BoletoPagandoPlus($this->linea,time(),$tarjeta->obtenerCosto(),$tarjeta->obtenerId(),$tarjeta->obtenerSaldo(),$tarjeta->obtenerostoCostoPlus(),$tarjeta->obtenervalor());
        }
    }

}
