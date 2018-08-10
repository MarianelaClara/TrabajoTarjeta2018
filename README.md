

https://travis-ci.org/MarianelaClara/TrabajoTarjeta2018.svg?branch=master

# Trabajo Tarjeta: Versión 2018

El siguiente trabajo es un enunciado iterativo. Todas las semanas nuevos
requerimientos serán agregados y/o modificados para ilustrar la dinámica de
desarrollo de software.

## Iteracion 1. (31 de Julio al 14 de Agosto)

Escribir un programa con programación orientada a objetos que permita ilustrar
el funcionamiento del transporte urbano de pasajeros de la ciudad de rosario.

Las clases que interactuan en la simulación son: Colectivo, Tarjeta y Boleto.

Cuando un usuario viaja en colectivo con una tarjeta, obtiene un boleto como
resultado de la operación $coletivo->pagarCon($tarjeta);


Para esta iteracion se consideran los siguientes supuestos:

- No hay medio boleto de ningun tipo.
- No hay transbordos.
- No hay viajes plus.
- La tarifa básica de un pasaje es de: $ 14,80
- Las cargas aceptadas de tarjetas son: (10, 20, 30, 50, 100, 510,15 y 962,59)
- Cuando se cargan  $510,15 se acreditan de forma adicional: 81,93
- Cuando se cargan  $962,59 se acreditan de forma adicional: 221,58

Se pide:

- Hacer un fork del repositorio.
- Implementar el código de las clases Tarjeta, Colectivo y Boleto.
- Hacer que el test Boleto.php funcione correctamente con todos los montos de pago listados.
- Conectar el repositorio con travis-ci para que los tests se ejecuten automaticamente en cada commit.
- Enviar el enlace del repositorio al mail del profesor con los integrantes del grupo: **dos por grupo.**


Para instalar el codigo inicial clonar el repositorio y luego ejecutar:

```
composer install
```

En caso de no contar con composer instalado, descargarlo desde: https://getcomposer.org/

Para correr los tests:

```
./vendor/bin/phpunit
```


## Iteracion 2. (14 de Agosto al 28 de Agosto)

... Próximamente :)
