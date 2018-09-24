<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo = 0;
    protected $viajesplus = 2;
    protected $valor = 14.80;
    protected $costo;
    protected $id;
    protected $tipo = "Normal";
    public $caso;
    protected $costoPlus;
    protected $tiempo;

    public function __construct(TiempoInterface $tiempo, $id){
        $this->tiempo=$tiempo;
        $this->id = $id;
    }
    
    public function recargar($monto) {
	  if($monto == 10.0 || $monto == 20.0 || $monto == 30.0 || $monto == 50.0 || $monto == 100.0 || $monto == 510.15 || $monto == 962.59)
	  {
		if($this->saldo == 0.0){
			$this->saldo= $monto;
		}
		else {
	   		$this->saldo = $this->saldo + $monto;
		}

		return True;	    
	  }
	  else{
	  	  return False;
	  }
    }

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
    }
    
    public function obetenerPlus() {
        return $this->viajesplus;
    }
    
    public function pagarTarjeta(){
        if($this->saldo < $this->valor){
            switch($this->viajesplus){
                case 0:
                    return false;
                case 1:
                    $this->gastarplus();
                    $this->costo = 0.0;
                    $this->caso = "viajeplus";
                    return true;
                case 2:
                    $this->gastarplus();
                    $this->costo = 0.0;
                    $this->caso = "viajeplus";
                    return true;
            }
        }
        else{
            switch($this->viajesplus){
                case 0:
                    $this->costoPlus = 14.80*2;
                    $this->costo = $this->valor + $this->costoPlus ;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->costo;
                        $this->obtenerSaldo();
                        $this->caso = "pagandoPlus";
                        return true;
                    }

                case 1:
                    $this->costoPlus = 14.80;
                    $this->costo = $this->valor + $this->costoPlus;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->costo;
                        $this->obtenerSaldo();
                        $this->caso = "pagandoPlus";
                        return true;
                    }
                
                case 2:
                    $this->costo = $this->valor;
                    $this->saldo = $this->saldo - $this->costo;
                    $this->caso = "Normal";
                    $this->obtenerSaldo();
                    return true;

            }
        }
    
    }
    
    public function obtenerCosto(){
        return $this->costo;
        
    }
    
    public function gastarPlus(){
        $this->viajesplus = $this->viajesplus - 1;
    }
    
    public function obtenervalor(){
        return $this->valor; 
    }

    public function obtenerId(){
        return $this->id;
    }

    public function obtenerCostoPlus(){
        return $this->costoPlus;
    }

    public function obtenerTipo():string{
        return $this->tipo;
    }
}
