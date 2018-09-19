<?php

namespace TrabajoTarjeta;

class TarjetamedioBoleto extends Tarjeta {
    protected $valor = 7.40;
    protected $ultimopago;
    
    public function _construct(){
        $this->ultimopago = new DateTime();
    }
    
    public function pagarTarjeta(){
        $tiempoactual = new DateTime();
        $diferenciadetiempo = date_diff($this->ultimopago, $tiempoactual);
        if ($diferenciadetiempo->getTimestamp() < 300){
            return false;
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
                    $this->valor= $this->valor+14.80+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valor;
                        $this->obtenerSaldo();
                        $this->ultimopago = new DateTime();
                        return true;
                    }

                case 1:
                    $this->valor= $this->valor+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valor;
                        $this->obtenerSaldo();
                        $this->ultimopago = new DateTime();
                        return true;
                    }
                
                case 2:
                    $this->saldo = $this->saldo - $this->valor;
                    $this->obtenerSaldo();
                    $this->ultimopago = new DateTime();
                    return true;
                    break;
            }
        }
    
    }
}
