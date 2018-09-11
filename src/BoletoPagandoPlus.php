<?php

namespace TrabajoTarjeta;

class BoletoPagandoPlus extends Boleto {

    protected $costoPlus;

    public function __construct($linea,$hora,$costo,$id,$saldo,$costoPlus,$valor){
        $this->valor = $valor;
        $this->costo = $costo; 
        $this->hora = $hora;
        $this->id = $id;
        $this->linea = $linea; 
        $this->saldo= $saldo;
        $this->costoPlus = $costoPlus;
    }
    
}