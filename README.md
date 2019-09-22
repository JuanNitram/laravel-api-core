# Api - Core

### Pasos inicializacion

1. `composer install`
2. `composer update`
3. Configurar adecuadamente el `.env`
4. `php artisan migrate:refresh`
5. `php artisan db:seed`
6. `php artisan passport:install`
7. `php artisan storage:link`

### Rutas

* En todas las peticiones no olvidar el header token conformado por `Bearer [my_token]`

* Login - Page
  * URL: api/page/login
  * Método: POST
  * Proteccion: Ninguna
  * Parámetros: email, password
  * Descripción: Loguea a un usuario y se le es retornado un token de autorización, el cual deberá incorporarlo en los headers para futuras peticiones que requieran autorización.
  
* Login - Admin
  * URL: api/admin/login
  * Método: POST
  * Proteccion: Ninguna
  * Parámetros: email, password
  * Descripción: Loguea a un administrador y se le es retornado un token de autorización, el cual deberá incorporarlo en los headers para futuras peticiones que requieran autorización.
  
* Register - Page
  * URL: api/page/login
  * Método: POST
  * Proteccion: Ninguna
  * Parámetros: name, email, password, c_password, [active]
  * Descripción: Realiza el registro de un nuevo usuario.
  
* Register - Admin
  * URL: api/admin/login
  * Método: POST
  * Proteccion: Ninguna
  * Parámetros: name, email, password, c_password, [active]
  * Descripción: Realiza el registro de un nuevo usuario.
  
Para cada sección (Administrador) se implementa un set de operaciones básicas (CRUD) las cuales quedan determinadas por las siguiente rutas:
  

* [Rutas - Seccion]
  * URL: api/admin/[seccion]
  * Método: GET
  * Proteccion: Token
  * Descripción: Devuelve todos los registros asociados a la seccion [section].

* [Rutas - Seccion]
  * URL: api/admin/[seccion]/{id}
  * Método: GET
  * Proteccion: Token
  * Parámetros: id
  * Descripción: Devuelve el registro con identificador id asociado a la sección [section].
  
* [Rutas - Seccion]
  * URL: api/admin/[seccion]/save
  * Método: POST
  * Proteccion: Token
  * Parámetros: name, [active]
  * Descripción: Devuelve el nuevo registro recientemente creado de la sección [section].
  
* [Rutas - Seccion]
  * URL: api/admin/[seccion]/remove/{id}
  * Método: POST
  * Proteccion: Token
  * Parámetros: id  
  * Descripción: Elimina el registro con identificador id asociado a la sección [section].
