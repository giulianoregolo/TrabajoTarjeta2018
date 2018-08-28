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
        switch ($tarjeta->tipo){
            case 0:
                $valor = 14.80;
            break;
            case 1:
                $valor = 7.40;
            break;
            case 2:
                $valor = 0.0;
            break;
        }
        if($tarjeta->saldo < $valor){
            switch($tarjeta->viajesplus){
                case 0:
                    return false;
                    break;
                case 1:
                    $tarjeta->gastarplus();
                    $boleto = new Boleto($this,$tarjeta,14.80); 
                    return $boleto;
                    break;
                case 2:
                    $tarjeta->gastarplus();
                    $boleto = new Boleto($this,$tarjeta,14.80); 
                    return $boleto;
                    break;
            }
        }
        else{
            switch($tarjeta->viajesplus){
                case 0:
                    $valor= $valor+14.80+14.80;
                    if($tarjeta->saldo < $valor){
                        return false;
                    }
                    else{
                        $tarjeta->pagarTarjeta($valor);
                        $tarjeta->obtenerSaldo();
                        $boleto=new Boleto($this,$tarjeta,$valor);
                        return $boleto;
                    }

                case 1:
                    $valor= $valor+14.80;
                    if($tarjeta->saldo < $valor){
                        return false;
                    }
                    else{
                        $tarjeta->pagarTarjeta($valor);
                        $tarjeta->obtenerSaldo();
                        $boleto=new Boleto($this,$tarjeta,$valor);
                        return $boleto;
                    }
                
                case 2:
                    $tarjeta->pagarTarjeta($valor);
                    $tarjeta->obtenerSaldo();
                    $boleto=new Boleto($this,$tarjeta,$valor);
                    return $boleto;
                    break;
            }
        }
    }

}