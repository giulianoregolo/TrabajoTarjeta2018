<?php

namespace TrabajoTarjeta;

class TarjetaFranquiciaCompleta extends Tarjeta {
    protected $valor = 0.0;
    protected $tipo = "FranquisiaCompleta";
    public function pagarTarjeta(){
        return true;
    }
}
