<?php

namespace TrabajoTarjeta;

class BoletoPlus extends Boleto {
    public function __construct($linea,$hora,$costo,$id,$saldo){
        $this->valor = $costo;
        $this->hora = $hora;
        $this->id = $id;
        $this->linea = $linea; 
        $this->saldo= $saldo;
    }


}