<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TiempoFalsoTest extends TestCase {
    /**
     * Verifica el timepo retroceda lo indicado.
     */
  public function testRetroceder(){
   $tiempo = new TiempoFalso;
   $tiempo->retroceder(10);
   $this->assertEquals($tiempo->tiempo(),-10);
  }
    /**
     * Verifica el tiempo se resetee correctamente.
     */
  public function testReset(){
    $tiempo = new TiempoFalso;
    $tiempo->avanzar(10);
    $this->assertEquals($tiempo->tiempo(), 10);
    $tiempo->reset();
    $this->assertEquals($tiempo->tiempo(), 0);
  }
    /**
     * Verifica el timepo avance lo indicado.
     */
    public function testAvanzar(){
      $tiempo = new TiempoFalso;
      $tiempo->avanzar(10);
      $this->assertEquals($tiempo->tiempo(),10);
     }

}
