<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;

    public function recargar($monto) {
	  if($monto == 10 or $monto == 20 or $monto == 30 or $monto == 50 or $monto == 100 or $monto == 510,15 or $monto == 962,59)
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
