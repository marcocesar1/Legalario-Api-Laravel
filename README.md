# 🚀 Proyecto Backend con Laravel

Este proyecto es una aplicación backend con login y administración de clientes.

Url de la aplicación en producción:

[https://legalario-api-laravel-main-plvc8k.laravel.cloud/](https://legalario-api-laravel-main-plvc8k.laravel.cloud/)

---

## 📋 Requisitos previos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- **Docker**

Puedes verificar la versión de Docker ejecutando el siguiente comando en tu terminal:

```bash
docker -v

# Debería mostrar algo como:
Docker version 20.10.23, build 100c701
```

Si no aparece la versión, puedes instalarla siguiendo las instrucciones de la documentación oficial de Docker.


Una vez instalado docker, ingresa a la carpeta /docker y copia el archivo `.env.example` a `.env`.
para tener la configuración necesaria para las credenciales de la base de datos en el servicio de docker-compose.

En la raiz del proyecto tambien debes copiar el archivo `.env.example` a `.env` y cambiar las credenciales de la base de datos, si dejaste las mismas credenciales del archivo `/docker/.env` no necesitas cambiar nada.

Después de esto, ejecuta el siguiente comando para levantar los servicios de docker-compose:


```bash
cd docker
docker-compose up
```

en otra terminal ejecuta el siguiente comando para ingresar al container de php:

```bash
docker exec -it legalario_app bash
```

Si todo ha ido bien, deberías ver algo como esto:

```bash
root@legalario_app:/var/www# 
```

Ahora puedes ejecutar los comandos de composer para instalar las dependencias del proyecto:

```bash
composer install
```

Correr las migraciones de la base de datos:

```bash
php artisan migrate
```

Una vez instaladas las dependencias, ejecuta el siguiente comando para ejecutar los seeders de la base de datos:

```bash
php artisan db:seed
```

La aplicación por defecto estara corriendo en el puerto `8091` (puedes cambiar el puerto en el archivo docker-compose), para acceder a la aplicación en tu navegador con el siguiente enlace:

http://localhost:8091

Para correr los tests de la aplicación, ejecuta el siguiente comando:

```bash
php artisan test
```

Usuario inicial de la aplicación:

Se encuentra configurado en el archivo `database/seeders/UsersSeeder.php`
