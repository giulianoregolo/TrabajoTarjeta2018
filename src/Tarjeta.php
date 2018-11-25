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
    protected $costoPlus = 0.0;
    protected $tiempo;
    protected $lineaAnterior = NULL;
    protected $numeroAnterior = NULL;
    protected $ultimopago = NULL;
    protected $trasbordo =false;

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
    
    public function pagarTarjeta( $colectivo){
        $this->valor=14.80;
        $this->costoPlus = 0.0;
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
                            $this->valor = ($this->valor /33)*10;
                            $this->costo = $this->costoPlus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            $this->viajesplus = 2;
                            return true;
                        }
                        else{
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = true;
                            $this->viajesplus = 2;
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
                            $this->valor = ($this->valor /33)*10;
                            $this->costo = $this->costoPlus + $this->valor;
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "Trasbordo";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = false;
                            $this->viajesplus = 2;
                            return true;
                        }
                        else{
                            $this->saldo = $this->saldo - $this->costo;
                            $this->caso = "pagandoPlus";
                            $this->ultimopago = $this->tiempo->time();
                            $this->guardoCole($colectivo);
                            $this->trasbordo = true;
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
                        $this->trasbordo = false;
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

    public function obtenerhora(){
        return $this->ultimopago;
    }

    public function haytrans( $colectivo){
		return ( $this->esTrasbordo( $colectivo ) && $this->tiempoValido() && $this->trasbordo);
    }

	public function esTrasbordo( $colectivo) {	
		return (($this->lineaAnterior != $colectivo->linea()) || ($this->numeroAnterior != $colectivo->numero()));
    }
    public function tiempoValido() { 
		if ( $this->intervalo_trasbordo() ) {
			return ($this->tiempo->time() - $this->ultimopago < 5400);
		}
		return ($this->tiempo->time() - $this->ultimopago < 3600);
    }
    public function intervalo_trasbordo() {
		$sabado = date( 'w', $this->tiempo->time() ) == 6 && (date( 'G', $this->tiempo->time() ) >= 14 && date( 'G', $this->tiempo->time() ) < 22);
		$domingo = date( 'w', $this->tiempo->time() ) == 0 && (date( 'G', $this->tiempo->time() ) >= 6 && date( 'G', $this->tiempo->time() ) < 22);
		$noche = date( 'G', $this->tiempo->time() ) >= 22 && date( 'G', $this->tiempo->time() ) < 6;
		return ($sabado || $domingo || $noche);
    }
    public function guardoCole($colectivo){
        $this->lineaAnterior = $colectivo->linea();
		$this->numeroAnterior = $colectivo->numero();
    }

}

