## Pruebas del sistema

El sistema FERRESUR cuenta con un proceso de pruebas funcionales orientado a verificar el comportamiento de sus principales módulos.

Las pruebas se realizan en un entorno local utilizando la aplicación Laravel, la base de datos del proyecto y un navegador web.

### Funcionalidades verificadas

Entre las funcionalidades consideradas en las pruebas se encuentran:

- Inicio de sesión con credenciales válidas.
- Validación de credenciales incorrectas.
- Registro de nuevos usuarios.
- Control de acceso de acuerdo con el rol del usuario.
- Consulta de eventos disponibles.
- Creación de eventos por parte del administrador.
- Visualización de eventos por clientes.
- Registro de clientes a eventos.
- Cancelación de registros a eventos.

### Resultados

Cada caso de prueba contempla:

- Identificador.
- Funcionalidad evaluada.
- Objetivo.
- Precondiciones.
- Datos de entrada.
- Pasos de ejecución.
- Resultado esperado.
- Resultado obtenido.
- Estado de la prueba.
- Evidencia.

Los resultados obtenidos permiten verificar el funcionamiento de las principales características del sistema antes de realizar un despliegue.
## Requisitos

Para ejecutar el proyecto de manera local se requiere:

- PHP
- Composer
- MySQL
- Node.js y npm
- Git

## Instalación

Clonar el repositorio:

    git clone https://github.com/Panquesito2308/ferresur.git

Entrar al proyecto:

    cd ferresur

Instalar las dependencias de PHP:

    composer install

Instalar las dependencias de Node.js:

    npm install

Crear el archivo de configuración de entorno a partir del archivo de ejemplo:

    copy .env.example .env

Generar la clave de Laravel:

    php artisan key:generate

Configurar la conexión a la base de datos en el archivo `.env`.

Ejecutar las migraciones correspondientes y posteriormente iniciar el servidor:

    php artisan serve

En otra terminal ejecutar:

    npm run dev

## Control de versiones

El proyecto utiliza Git y GitHub para el control de versiones.

## Seguridad

Los archivos que contienen información sensible, como `.env`, no se almacenan en el repositorio.

El archivo `.gitignore` se utiliza para excluir credenciales, dependencias, archivos temporales y otros elementos que no deben formar parte del control de versiones.

## Estrategia de despliegue

Para el sistema FERRESUR se utiliza una estrategia de despliegue controlado, en la cual los cambios deben pasar previamente por el flujo de control de versiones antes de integrarse a la rama principal.

### Preparación de la versión

Antes de realizar un despliegue se debe verificar que:

- Los cambios hayan sido revisados.
- Los Pull Request necesarios hayan sido aprobados.
- La rama `main` se encuentre actualizada.
- No existan cambios locales pendientes.
- Las principales funcionalidades hayan sido verificadas.

### Validación previa

Laravel permite preparar y validar elementos de la aplicación mediante:

    php artisan optimize

Este proceso permite optimizar elementos como configuración, eventos, rutas y vistas.

Si durante esta validación se detecta un problema, el despliegue debe detenerse hasta realizar la corrección correspondiente.

### Proceso de liberación

1. Verificar la versión estable de la rama `main`.
2. Realizar un respaldo de la información necesaria.
3. Instalar las dependencias requeridas.
4. Configurar las variables de entorno del servidor.
5. Ejecutar las tareas necesarias de Laravel.
6. Optimizar la aplicación.
7. Publicar la versión.
8. Verificar las funcionalidades principales después del despliegue.

### Respuesta ante fallos

Si se detecta un error durante el proceso de despliegue, se debe detener la liberación, identificar la causa y realizar la corrección en una rama independiente.

La corrección debe pasar nuevamente por el proceso de commit, push, Pull Request, revisión y merge antes de volver a intentar el despliegue.

En caso de que un error sea detectado después de la publicación, se deberá regresar a una versión estable y restaurar la información respaldada cuando sea necesario.

## Instalación y ejecución

Para ejecutar el sistema FERRESUR en un entorno local es necesario contar con PHP, Composer, Node.js, npm y un servidor de base de datos MySQL.

### Instalación

1. Clonar el repositorio del proyecto.
2. Acceder a la carpeta del proyecto.
3. Instalar las dependencias de PHP:

   composer install

4. Instalar las dependencias del frontend:

   npm install

5. Crear el archivo `.env` a partir de `.env.example`.
6. Configurar la conexión a la base de datos en el archivo `.env`.
7. Generar la clave de la aplicación:

   php artisan key:generate

8. Preparar la base de datos correspondiente al proyecto.

### Ejecución

Para iniciar el servidor de desarrollo de Laravel:

   php artisan serve

Para ejecutar los recursos del frontend en modo de desarrollo:

   npm run dev

Posteriormente, la aplicación puede consultarse desde el navegador utilizando la dirección proporcionada por Laravel.

### Seguridad

El archivo `.env` no debe almacenarse en el repositorio debido a que puede contener información sensible, como credenciales de conexión a la base de datos.