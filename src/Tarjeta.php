<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo = 0;
    protected $viajesplus = 2;
    protected $valor = 14.80;
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
                    return true;
                case 2:
                    $this->gastarplus();
                    return true;
            }
        }
        else{
            switch($this->viajesplus){
                case 0:
                    $costo = $this->valor * 3;
                    if($this->saldo < $costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $costo;
                        $this->obtenerSaldo();
                        return true;
                    }

                case 1:
                    $costo = $this->valor * 2;
                    if($this->saldo < $costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $costo;
                        $this->obtenerSaldo();
                        return true;
                    }
                
                case 2:
                    $costo = $this->valor;
                    $this->saldo = $this->saldo - $costo;
                    $this->obtenerSaldo();
                    return true;
            }
        }
    
    }
    
    public function obtenerCosto(){
        switch($this->viajesplus){
            case 0:
                return ($this->valor * 3);
            case 1:
                return ($this->valor * 2);
            case 2:
                return $this->valor;
        }
    }
    
    public function gastarPlus(){
        $this->viajesplus = $this->viajesplus - 1;
    }
    
    public function obtenervalor(){
        return $this->valor; 
    
    }
}
