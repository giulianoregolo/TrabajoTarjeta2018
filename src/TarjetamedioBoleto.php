<?php

namespace TrabajoTarjeta;

class TarjetamedioBoleto extends Tarjeta {
    protected $tipo = "Medio";
    protected $tiempo_de_espera = 300;
    protected $valor = 14.80;
    protected $ultimopago = null;

    public function pagarTarjeta($colectivo){
        if ($this->tiempoDeEsperaCumplido() && $this->ultimopago != null){
		$this->valor = $this->valor/2; 	
        }
        else{
            $this->valor = 14.80;
        }
        if($this->saldo < $this->valor){
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
                    $this->costo = $this->costoPlus + $this->valor;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $this->valor = ($this->valor /33)*100;
                            $this->costo = $this->costoPlus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            return true;
                        }
                        else{
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->trasbordo = true;
                            $this->guardoCole($colectivo);
                            return true;
                        }
                    }

                case 1:
                    $this->costoPlus = $this->valor;
                    $this->costo = $this->costoPlus + $this->valor;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        if($this->haytrans($colectivo)){
                            $this->valor = ($this->valor /33)*100;
                            $this->costo = $this->costoPlus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            return true;
                        }
                        else{
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = true;
                            return true;
                        }
                    }
                case 2:
                    if($this->haytrans($colectivo)){ 
                        $this->valor = ($this->valor /33)*100;
                        $this->costo = $this->costoPlus + $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Trasbordo";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = flase;
                        return true;
                    }
                    else{
                        $this->costo = $this->costoPlus + $this->valor;
                        $this->saldo = $this->saldo - $this->costo;
                        $this->caso = "Medio";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = true;
                        return true;
                    }    
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
