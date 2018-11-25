<?php

namespace TrabajoTarjeta;

class TarjetaMedioBoletoUniversitario extends Tarjeta {
    protected $valor = 14.80;
    protected $ultimopago;
    public $tipo = "Medio Universitario";
    protected $cantidadpagos = 0;
    protected $tiempo_de_espera = 300;
    
    public function obtenerValorBoleto(){
        if ($this->medioDisponible()){
            return ($this->valor)/2;
        } 
        else {
            return $this->valor;
        }
    }

    public function pagarTarjeta($colectivo){
        $valorAux = $this->obtenerValorBoleto();
        if($this->saldo < $valorAux){
            switch($this->viajesplus){
                case 0:
                    return false;
                case 1:
                    $this->gastarplus();
                    $this->costo = 0.0;
                    $this->caso = "viajeplus";
                    $this->guardoCole($colectivo);
                    $this->trasbordo = true;
                    return true;
                case 2:
                    $this->gastarplus();
                    $this->costo = 0.0;
                    $this->caso = "viajeplus";
                    $this->guardoCole($colectivo);
                    $this->trasbordo = true;
                    return true;
            }
        }
        else{
            switch($this->viajesplus){
                case 0:
                    $this->costoPlus = 14.80+14.80;
                    $this->costo = $valorAux + $this->costoPlus;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $valorAux = ($valorAux *33)/100;
                            $this->costo = $this->costoPlus + $valorAux;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            if ($this->cantidadpagos < 2){
                                $this->cantidadpagos = $this->cantidadpagos + 1;
                                }
                            $this->viajesplus = 2;
                            return true;
                        }
                        else{
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->trasbordo = true;
                            $this->guardoCole($colectivo);
                            if ($this->cantidadpagos < 2){
                                $this->cantidadpagos = $this->cantidadpagos + 1;
                                }
                            return true;
                            $this->viajesplus = 2;
                        }
                    }

                case 1:
                    $this->costoPlus = 14.80;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $valorAux = ($valorAux *33)/100;
                            $this->costo = $this->costoPlus + $valorAux;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            if ($this->cantidadpagos < 2){
                                $this->cantidadpagos = $this->cantidadpagos + 1;
                                }
                            $this->viajesplus = 2;
                            return true;
                        }
                        else{
                            $this->costo=$this->costoPlus + $valorAux;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->trasbordo = true;
                            $this->guardoCole($colectivo);
                            if ($this->cantidadpagos < 2){
                                $this->cantidadpagos = $this->cantidadpagos + 1;
                                }
                            $this->viajesplus = 2;
                            return true;
                        }
                    }
                case 2:
                    if($this->haytrans($colectivo)){ 
                        $valorAux = ($valorAux *33)/100;
                        $this->costo = $this->costoPlus + $valorAux;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Trasbordo";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = false;
                        if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                            }
                        return true;
                    }
                    else{
                        $this->costo = $this->costoPlus + $valorAux;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Medio Universitario";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = true;
                        if ($this->cantidadpagos < 2){
                            $this->cantidadpagos = $this->cantidadpagos + 1;
                            }
                        return true;
                    }    
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
        if($this->cantidadpagos < 2 ){
            if($this->tiempoDeEsperaCumplido()){
                return True;
            }    
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

