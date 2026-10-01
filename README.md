# Sistema Web FERRESUR

Sistema web desarrollado para FERRESUR con el propósito de administrar información relacionada con la empresa y gestionar sus eventos.

## Descripción

El sistema permite administrar diferentes procesos de FERRESUR desde una aplicación web. Cuenta con distintos tipos de usuarios y funcionalidades para la gestión de eventos, empleados, clientes, productos y sucursales.

También permite que los usuarios consulten eventos disponibles y realicen su registro en ellos.

## Funcionalidades principales

- Inicio de sesión y autenticación de usuarios.
- Gestión de empleados.
- Gestión de clientes.
- Gestión de usuarios.
- Gestión de productos.
- Gestión de sucursales.
- Creación y administración de eventos.
- Registro de usuarios a eventos.
- Consulta del historial de eventos.
- Generación de reportes.
- Administración de perfiles.
- Gestión de respaldos del sistema.

## Tecnologías utilizadas

- PHP
- Laravel
- MySQL
- Blade
- HTML
- CSS
- JavaScript
- Bootstrap
- Tailwind CSS
- Vite
- Git
- GitHub

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