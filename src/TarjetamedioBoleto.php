<?php

namespace TrabajoTarjeta;

class TarjetamedioBoleto extends Tarjeta {
    protected $tipo = "Medio";
    protected $tiempo_de_espera = 300;
    protected $valor = 7.40;
    protected $ultimopago = null;

    public function pagarTarjeta(){
        if ($this->ultimopago == null  || tiempoDeEsperaCumplido()){
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
                        $this->ultimopago = $this->tiempo->time();
                        return true;
                    }

                case 1:
                    $this->valor= $this->valor+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valor;
                        $this->ultimopago = $this->tiempo->time();
                        return true;
                    }
                
                case 2:
                    $this->saldo = $this->saldo - $this->valor;                    
                    $this->ultimopago = $this->tiempo->time();
                    return true;
                    break;
            }
        }
    
    }

    public function tiempoDeEsperaCumplido(){
        $ultimopago = $this->obtenerUltimaFechaPagada();
        $fecha_actual = $this->tiempo->time();
        $diferencia_fechas = $fecha_actual - $ultimopago;
        if($diferencia_fechas >= $this->obtenerTiempoDeEspera()){
                return TRUE;
        }
        return FALSE;
    }
    public function obtenerTiempoDeEspera(){
        return $this->tiempo_de_espera;
    }
    public function obtenerUltimaFechaPagada(){
        return $this->ultimopago;
      }
}
