<?php

namespace TrabajoTarjeta;

class TarjetamedioBoletoUniversitario extends TrabajoTarjeta\Tarjeta {
    protected $valor = 7.40;
    protected $ultimopago;
    protected $cantidadpagos = 0;
    
    public function _construct(){
        $this->ultimopago = new DateTime();
    }
    
    public function pagarTarjeta(){
        $tiempoactual = new DateTime();
        if ($tiempoactual->getTimestamp() / 60 > $this->ultimopago->getTimestamp()){
            $this->cantidadpagos = 0;
        }
        if($this->saldo < $this->valor){
            switch($this->viajesplus){
                case 0:
                    return false;
                    break;
                case 1:
                    $this->gastarplus();
                    return true;
                    break;
                case 2:
                    $this->gastarplus();
                    return true;
                    break;
            }
        }
        else{
            switch($this->viajesplus){
                case 0:
                    if ($this->cantidadpagos == 2){
                            $this->valor = 14.80;
                    }
                    $this->valor= $this->valor+14.80+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valor;
                        $this->obtenerSaldo();
                        $this->ultimopago = new DateTime();
                        if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                        }
                        $this->ultimopago = new DateTime();
                        return true;
                    }

                case 1:
                    if ($this->cantidadpagos == 2){
                            $this->valor = 14.80;
                    }
                    $this->valor= $this->valor+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valor;
                        $this->obtenerSaldo();
                        $this->ultimopago = new DateTime();
                        if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                        }
                        $this->ultimopago = new DateTime();
                        return true;
                    }
                
                case 2:
                    if ($this->cantidadpagos == 2){
                            $this->valor = 14.80;
                    }
                    $this->saldo = $this->saldo - $this->valor;
                    $this->obtenerSaldo();
                    $this->ultimopago = new DateTime();
                    if ($this->cantidadpagos < 2){
                        $this->cantidadpagos = $this->cantidadpagos + 1;
                    }
                    $this->ultimopago = new DateTime();
                    return true;
                    break;
            }
        }
    }
}