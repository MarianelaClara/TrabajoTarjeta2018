<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaMedioUniTest extends TestCase {
     /**
     * Se sumen correctamente el uso de medios boleto.
     */
    public function testusarMedio(){
        $tarjetaMedioUni = new TarjetaMedioUni;
        $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 0);
        $tarjetaMedioUni->usarMedio();
        $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 1);
        $tarjetaMedioUni->UsarMedio();
        $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(), 2);
    }
    
    /**
     * Comprueba que se establezca el nuevo dia de uso y los medios se reseteen correctamente.
     */
    public function testactualizarDia(){
        $tarjetaMedioUni = new TarjetaMedioUni;
        $tarjetaMedioUni->usarMedio();
        $tarjetaMedioUni->actualizarDia(10);
        $this->assertEquals($tarjetaMedioUni->obtenerDiaDeUso(), 10);
        $this->assertEquals($tarjetaMedioUni->obtenerUsoDeMedio(),0);
    }
     /**
     * Comprueba que al pagar un transbordo normal se descuente el saldo correspondiente al mismo.
     */

    public function testPagarTransbordoNormal(){
        $tarjetaMedioUni= new TarjetaMedioUni;
        $tarjetaMedioUni->recargar(50);
        $tarjetaMedioUni->normalTransbordo();
        $this->assertEquals($tarjetaMedioUni->obtenerSaldo(), 50-$tarjetaMedioUni->obtenerValor()*2*33/100);
    }
}
