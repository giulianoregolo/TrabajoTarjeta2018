<?php

namespace TrabajoTarjeta;

class TarjetaFranquiciaCompleta extends Tarjeta {
    protected $valor = 0.0;
    public function pagarTarjeta(){
        return true;
    }
}
