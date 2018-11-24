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
    
    public function pagarTarjeta(ColectivoInterface $colectivo){
        if($this->haytrans(ColectivoInterface $colectivo)){
            $valor = 
            $this->saldo = $this->saldo - $valor;
            $this->guardoCole($colectivo);
            $this->trasbordo = false
            return true;
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
                    $this->costoPlus = 14.80*2;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->costo;
                        $this->obtenerSaldo();
                        $this->caso = "pagandoPlus";
                        $this->ultimopago = $this->tiempo->time();
                        return true;
                        $this->trasbordo = true;
                        $this->guardoCole($colectivo);
                    }

                case 1:
                    $this->costoPlus = 14.80;
                    if($this->saldo < $this->costo){
                        return false;
                    }
                    else{
                        $this->saldo = $this->saldo - $this->costo;
                        $this->obtenerSaldo();
                        $this->caso = "pagandoPlus";
                        $this->ultimopago = $this->tiempo->time();
                        $this->guardoCole($colectivo);
                        $this->trasbordo = true;
                        return true;
                    }
                
                case 2:
                    $this->saldo = $this->saldo - $this->costo;
                    $this->obtenerSaldo();
                    $this->ultimopago = $this->tiempo->time();
                    $this->guardoCole($colectivo);
                    $this->trasbordo = true;
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

    public function haytrans(ColectivoInterface $colectivo){
        $saldoSuf = ( round( ($this->valor / 3), 3 ) + abs( $this->viajesplus - 2 ) * $this->valor ) < $this->saldo;
		return ( $this->esTrasbordo( $colectivo ) && $this->tiempoValido() && $this->trasbordo && $saldoSuf );
    }

	public function esTrasbordo(ColectivoInterface $colectivo) {	
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

