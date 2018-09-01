<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaMedioUniTest extends TestCase {

public function testusarMedio(){
    $tarjetaMedioUni = new TarjetaMedioUni;
    $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 0);
    $tarjetaMedioUni->usarMedio();
    $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 1);
    $tarjetaMedioUni->UsarMedio();
    $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
}

public function testactualizarDia(){
    $tarjetaMedioUni = new TarjetaMedioUni;
    $tarjetaMedioUni->actualizarDia(10);
    $this->assertEquals($tarjetaMedioUni->obtenerDiaDeUso(), 10);
    $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),0);
}}