<?php

namespace TrabajoTarjeta;

interface BoletoInterface {

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor();

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo();

    public function obtenerTarjetaId();

    public function obtenerCostoplus();

    public function obtenersaldo();

    public function obtenertipoTarjeta();

    public function obtenerhora();

    
}
