<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;

    public function recargar($monto) {
	  if($monto == 10 || $monto == 20 || $monto == 30 || $monto == 50 || $monto == 100 || $monto == 510,15 || $monto == 962,59)
	  {
			if(this->$saldo == 0,0){
				this->$saldo= $monto;
			}
			else {
	   			this->$saldo = this->$saldo + $monto;
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

}
