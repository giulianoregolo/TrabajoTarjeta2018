<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
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
                        $this->pagarTarjeta();
                        $this->obtenerSaldo();
                        return true;
                    }

                case 1:
                    $this->valor= $this->valor+14.80;
                    if($this->saldo < $this->valor){
                        return false;
                    }
                    else{
                        $this->pagarTarjeta();
                        $this->obtenerSaldo();
                        return true;
                    }
                
                case 2:
                    $this->pagarTarjeta();
                    $this->obtenerSaldo();
                    return true;
                    break;
            }
        }
    
    }
    
    public function gastarPlus(){
        $this->viajesplus = $this->viajesplus - 1;
    }
    
}
