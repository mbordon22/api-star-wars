# Star Wars API Project

Este proyecto es una aplicación basada en Symfony 6.3 que consume la API de Star Wars para listar y buscar personajes. Incluye un paginado de lado del servidor y una opción para filtrar por nombre del personaje, además de caché para optimizar las llamadas a la API.

## Requisitos

- **PHP 8.1** o superior
- **Symfony 6.3**
- **Composer**
- **GuzzleHttp** (para realizar peticiones HTTP)
- **Caching PSR-6/PSR-16** (Symfony)
- **Git** (para la gestión del repositorio)
- **Twig** (Para renderizado de vistas)
- **Bootstrap 5** (Para el diseño responsivo)

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/mbordon22/socialpubli.git
    ```
2. Acceder al respositorio:

   ```bash
   cd socialpubli
   ```
2. Instalar las dependencias del proyecto con Composer:

   ```bash
   composer install
   ```
3. Configurar las variables de entorno. Configura el caché:

   ```bash
   CACHE_TTL=300
   ```
4. Asignar permisos para los directorios var y logs:

   ```bash
   chmod -R 777 var logs
   ```
5. Levantar el servidor con php:
   ```bash
   php -S localhost:8000 -t public
   ```
6. Acceder a la aplicación desde el navegador: 
   http://localhost:8000/starwars