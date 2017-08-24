# techninja-test

para ejecutar este proyecto correctamente necesitarás instalar el gestor de dependencias [Composer](https://getcomposer.org/).

## Instalación

### Instalación de dependencias en windows
Teniendo instalado composer en tu sistema, ubicate dentro de la carpeta del proyecto tipicamente ubicada en **'C:\xampp\htdocs\techninja-test'**, asumiendo que el directorio de la aplicación tiene por nombre *techninja-test*.

Con el botón derecho de mouse, haz clic en **Composer install**.

Una vez instaladas las dependencias debe modificar el archivo **C:\xampp\htdocs\techninja-test\app\config\parameters.yml**, para permtirle a doctrine generar la base de datos etc. Las variables que debes modificar son: *database_name, database_user, database_password*, tipicamente son los valores de acceso de PhpMyAdmin.

Posteriormente debes generar la base de datos con los siguientes comandos
```sh
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
```

Finalmente podrás ejecutar la aplicación con el comando
```sh
$ php app/console server:run
```

para visualizarla, abre en el navegador la siguiente dirección *http://localhost:8000/*