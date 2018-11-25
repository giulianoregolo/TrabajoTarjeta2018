<?php

namespace TrabajoTarjeta;

class TarjetaMedioBoletoUniversitario extends Tarjeta {
    protected $valor = 14.80;
    protected $ultimopago;
    protected $cantidadpagos = 0;
    
    public function obtenerValorBoleto(){
        if ($this->medioDisponible()) return $this->valor/2;
        else return $this->valor;
    }

    public function pagarTarjeta($colectivo){
        $this->valor = 14.80;
        $this->costo = $this->obtenerValorBoleto();
        if($this->saldo < $this->costo){
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
                    $this->costoPlus = $this->valor*2;
                    $this->costo = $this->costo + $this->costoPlus;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $this->valor = ($this->valor /33)*10;
                            $this->costo = $this->costoPlus + $this->valor;
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
                    $this->costoPlus = $this->valor;
                    $this->costo= $this->costo+$this->costoPlus;
                    if($this->saldo < $this->this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $this->valor = ($this->valor /33)*10;
                            $this->costo = $this->costoPlus + $this->valor;
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
                            $this->viajesplus = 2;
                            return true;
                        }
                    }
                case 2:
                    if($this->haytrans($colectivo)){ 
                        $this->valor = ($this->valor /33)*10;
                        $this->costo = $this->costoPlus + $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Trasbordo";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = flase;
                        return true;
                    }
                    else{
                        $this->valor = 14.80;
                        $this->costo = $this->costoPlus + $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Normal";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = true;
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

