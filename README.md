# Properati CRM challenge

## Challenge

> Te proponemos que nos muestres cómo resolverías una tarea del mundo real:
desarrollar una API REST en base a un dataset de anuncios de propiedades en venta o alquiler. Para la autenticación se debe utilizar el patrón JWT. No necesitamos que tenga calidad para ir a producción; nos interesa ver cómo lo resolverías y podés dejarnos #TODO con lo que te parece que se podría mejorar. Nos gustaría que inviertas un máximo de 6 hs. de tu tiempo. API Endpoints:
> - **Login**: generación de token para el usuario, utilizar credenciales hardcodeadas con:
    usuario: admin clave: 12345
> - **Listado de propiedades**: con parámetros de búsqueda por tipo de propiedad, tipo de operación (venta o alquiler), rango de precio y texto libre.
> - **Cambio de estado**: utilizando el ID del item. Valores disponibles [available,rented,closed]
> - **Datos de la propiedad**: utilizando el ID del item
> - **Eliminación de propiedad**: utilizando el ID del item

## Notas sobre la solución

#### Tecnologías y stacks utilizados:

| Framework    | Versión | Justificación |
| -------   | ----------- | ------------- |
| Laravel    | 8.x      | Aprovechar la nueva lógica de factories y el soporte para las nuevas features de php 7.3+
| MySQL | 5.7           | Aprovechar las columnas tipo JSON para poder guardar la información desnormalizada, como por ejemplo: tags

#### Fuente de datos:

Se importó el dataset a una tabla MySQL para simplificar la implementación y llegar al resultado esperado rápidamente. Considero que en cuanto a optimización de recursos no es la mejor solución, se
podría utilizar una base No-SQL, como [MongoDB](https://www.mongodb.com). También sería interesante implementar GraphQL para brindar mayor flexibilidad a las consultas. Además, para las búsquedas
basadas en texto se podría agregar un motor de búsqueda full-text, como por ejemplo [Algolia](https://www.algolia.com/products/search/) o [Meilisearch](https://www.meilisearch.com/)

#### Entorno de desarrollo:

Se utilizó [Laravel Sail](https://laravel.com/docs/8.x/sail) como entorno de desarrollo con el fin de que cualquier desarrollador pueda hacer el "start-up" del proyecto rápidamente.

#### Tests

Se realizaron tests de integración para poder validar los alcances esperados, sin embargo no son los suficientes para cubrir todos los casos de usos posibles.

*Limitación*: Dado que se usó el motor de base de datos MySQL 5.7 para aprovechar las columnas tipo JSON, las mismas no están disponibles en el motor SQLite. Razón por la cual, para correr los tests,
es necesario crear una base de datos MySQL con los mismos permisos que la base de datos de la implementación. En mi proyecto la definí
como [`properati_crm_challenge_test`](https://github.com/diegoldev/properati-crm-challenge/blob/master/phpunit.xml#L27)
Esta configuración no es la ideal dado que en un contexto de mayor cantidad de pruebas enlentecería demasiado el proceso de CI / CD. La solución sería utilizar
el [Repository Pattern](https://docs.microsoft.com/en-us/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/infrastructure-persistence-layer-design#:%7E:text=of%20Work%20patterns.-,The%20Repository%20pattern,from%20the%20domain%20model%20layer)
de modo de abstraer la capa de acceso a datos y poder entonces "mockearla" en los tests.
