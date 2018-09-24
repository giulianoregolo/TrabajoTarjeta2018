<?php

namespace TrabajoTarjeta;

class TarjetamedioBoletoUniversitario extends Tarjeta {
    protected $valor = 14.80;
    protected $ultimopago;
    protected $cantidadpagos = 0;
    
    public function obtenerValorBoleto(){
        if ($this->medioDisponible()) return $this->valor/2;
        else return $this->valor;
    }

    public function pagarTarjeta(){
        $valoraux = obtenerValorBoleto();
        if($this->saldo < $valoraux){
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
                    $valoraux= $valoraux+14.80+14.80;
                    if($this->saldo < $valoraux){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $valoraux;
                            if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                        }
                        $this->ultimopago = $this->tiempo->time();
                            return true;
                    }

                case 1:
                    $valoraux= $valoraux+14.80;
                    if($this->saldo < $this->valoraux){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->valoraux;
                        if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                        }
                        $this->ultimopago = $this->tiempo->time();
                        return true;
                    }
                
                case 2:
                    $this->saldo = $this->saldo - $valoraux;
                    if ($this->cantidadpagos < 2){
                        $this->cantidadpagos = $this->cantidadpagos + 1;
                    }
                    $this->ultimopago = $this->tiempo->time();
                    return true;
                    break;
            }
        }
    }
    public function tiempoDeEsperaCumplido(){
        $ultimopago = $this->ultimopago;
        $fecha_actual = $this->tiempo->time();
        $diferencia_fechas = $fecha_actual - $ultimopago;
        if($diferencia_fechas >= $this->obtenerTiempoDeEspera()){
                return TRUE;
        }
        return FALSE;
    }

    public function medioDisponible(){
        if($this->cantidadpagos < 2){
            return TRUE;
        }
        if($this->tiempoDeEsperaUltimoMedioCumplido()){
          $this->cantidadpagos = 0;
          return TRUE;
        }
        return FALSE;

    }

    public function tiempoDeEsperaUltimoMedioCumplido(){
        $fecha_ultima = $this->obtenerUltimaFechaPagada();

        $fecha_ultima = date("d/m/y", $fecha_ultima);

        $fecha_actual = $this->tiempo->time();
        $fecha_actual = date("d/m/y", $fecha_actual);

        if($fecha_ultima < $fecha_actual){
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

