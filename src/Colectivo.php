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
        if ($tarjeta->obtenerPlus() == 0){
            return False;
        }
        else{
            $tarjeta->pagarTarjeta(14.80);
            if ($tarjeta->obtenerSaldo() < 0){
                $tarjeta->gastarPlus();
            }
           return True; 
        }
    }

}
