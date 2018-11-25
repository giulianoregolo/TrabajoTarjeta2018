<?php

namespace TrabajoTarjeta;

class Tarjeta_Franquicia_Completa extends Tarjeta {
    protected $valor = 0.0;
    protected $tipo = 'Franquicia Completa';
    public function pagar_tarjeta( $colectivo ) {
        return true;
    }
}
