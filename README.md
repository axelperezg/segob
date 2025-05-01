# SEGOB Project

Este es un proyecto desarrollado con Laravel 11 y Vue.js, utilizando Inertia.js para la integración del frontend y backend.

## Requisitos Previos

- PHP 8.2
- Composer
- Git
- Node.js (versión LTS recomendada)
- npm o yarn
- MySQL

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/axelperezg/segob
   cd segob
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**
   ```bash
   npm ci
   npm run build
   ```

4. **Configurar el entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**
   - Editar el archivo `.env` con tus credenciales de base de datos:
     ```
     APP_NAME=SEGOB
     APP_URL=https://tu-dominio.com
     APP_ENV=production
     APP_DEBUG=false

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=tu_base_de_datos
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_contraseña
     ```

6. **Ejecutar las migraciones**
   ```bash
   composer fresh
   ```