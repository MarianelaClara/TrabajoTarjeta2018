<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TiempoFalsoTest extends TestCase {
  
  public function testRetroceder(){
   $tiempo = new TiempoFalso;
   $tiempo->retroceder(10);
   $this->assertEquals($tiempo->tiempo(),-10);
  }
  
  public function testReset(){
    $tiempo = new TiempoFalso;
    $tiempo->avanzar(10);
    $this->assertEquals($tiempo->tiempo(), 10);
    $tiempo->reset();
    $this->assertEquals($tiempo->tiempo(), 0);
  }


}
