[![Build Status](https://travis-ci.org/MarianelaClara/TrabajoTarjeta2018.svg?branch=master)](https://travis-ci.org/MarianelaClara/TrabajoTarjeta2018)

[![Coverage Status](https://coveralls.io/repos/github/MarianelaClara/TrabajoTarjeta2018/badge.svg?branch=master)](https://coveralls.io/github/MarianelaClara/TrabajoTarjeta2018?branch=master)

## Trabajo Tarjeta: Versión 2018

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

Si se agregan nuevas clases al código tal vez sea necesario correr:

```
composer dump-autoload
```


## Iteracion 2. (14 de Agosto al 28 de Agosto)


Para esta iteración hay 3 tareas principales. Crear un [issue](https://github.com/dagostinoips/TrabajoTarjeta2018/issues) en github copiando la descripción de cada tarea y completar cada uno en una rama diferente. Éstas serán mergeadas al validar, luego de una [revisión cruzada](https://www.youtube.com/watch?v=HW0RPaJqm4g) (de ambos integrantes del grupo), que todo el código tiene sentido y está correctamente implementado.

No es necesario que todo el código para un issue esté funcionando al 100% antes de mergiarlo, pueden crear pull requests que solucionen algún item particular del problema para avanzar más rápido.

Además de las tareas planteadas, cada grupo tiene tareas pendientes de la iteración anterior que debe finalizar antes de comenzar con la iteración 2. Cuando la iteración 1 este completada, [crear un tag](https://git-scm.com/book/es/v1/Fundamentos-de-Git-Creando-etiquetas#Creando-etiquetas) llamado iteracion1:
Y [subirlo](https://git-scm.com/book/es/v1/Fundamentos-de-Git-Creando-etiquetas#Compartiendo-etiquetas) a github

**IMPORTANTE:** Como punto de control, alguna de estas dos funcionalidades: "Viaje plus" o "Franquicia de Boleto" tiene que estar lista para revisar a mitad de la iteración. (21 de Agosto).

## Descuento de saldos.

- Cada vez que una tarjeta paga un boleto, descuenta el valor del monto gastado.
- Si la tarjeta se queda sin saldo, la operación `$colectivo->pagarCon($tarjeta)` devuelve FALSE,
- Escribir un test que valide dos casos, pagar con saldo y pagar sin saldo.

## Viaje plus

- Si la tarjeta se queda sin crédito, puede otorgar hasta dos viajes plus.
- Cuando se vuelve a cargar la tarjeta, se descuenta el saldo de lo que se haya
consumido en concepto de viaje plus.
- Escribir un test que valide que se pueden dar hasta dos viajes plus.
- Escribir un test que valide que el saldo de la tarjeta descuenta correctamente el/los viaje/s plus otorgado/s.

## Franquicia de Boleto.

- Existen dos tipos de franquicia en lo que refiere a tarjetas, las franquicias
parciales, como el medio boleto estudiantil o el universitario, y las completas
como las de jubilados.
- Implementar cada tipo de tarjeta como una Herencia de la tarjeta original.
- Para esta iteración considerar simplemente que cuando se paga con una tarjeta
del tipo MedioBoleto el costo del pasaje vale la mitad, independientemente de
cuantas veces se use y que dia de la semana sea.
- Escribir un test que valide que una tarjeta de FranquiciaCompleta siempre puede
pagar un boleto.
- Escribir un test que valide que el monto del boleto pagado con medio boleto es siempre la mitad del normal.

