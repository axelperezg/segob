#!/bin/bash

# Script de despliegue para Ploi.io - SEGOB Project
# Repositorio: https://github.com/axelperezg/segob.git

echo "🚀 Iniciando despliegue de SEGOB en Ploi.io..."

# Variables del proyecto
REPO_URL="https://github.com/axelperezg/segob.git"
BRANCH="main"
PROJECT_DIR="/home/ploi/tudominio.com"
WEB_DIR="$PROJECT_DIR/public"

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Función para imprimir mensajes con colores
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Verificar si estamos en el directorio correcto
if [ ! -d "$PROJECT_DIR" ]; then
    print_error "El directorio del proyecto no existe: $PROJECT_DIR"
    print_status "Creando directorio del proyecto..."
    mkdir -p "$PROJECT_DIR"
fi

# Navegar al directorio del proyecto
cd "$PROJECT_DIR"

# Verificar si el repositorio ya existe
if [ -d ".git" ]; then
    print_status "Repositorio Git encontrado, actualizando..."
    git fetch origin
    git reset --hard origin/$BRANCH
    print_success "Repositorio actualizado desde $BRANCH"
else
    print_status "Clonando repositorio desde GitHub..."
    git clone -b $BRANCH $REPO_URL .
    if [ $? -eq 0 ]; then
        print_success "Repositorio clonado exitosamente"
    else
        print_error "Error al clonar el repositorio"
        exit 1
    fi
fi

# Verificar que el archivo composer.json existe
if [ ! -f "composer.json" ]; then
    print_error "No se encontró composer.json. Verifica que el repositorio se clonó correctamente."
    exit 1
fi

print_status "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -eq 0 ]; then
    print_success "Dependencias de Composer instaladas"
else
    print_error "Error al instalar dependencias de Composer"
    exit 1
fi

print_status "Instalando dependencias de Node.js..."
npm ci --production
if [ $? -eq 0 ]; then
    print_success "Dependencias de Node.js instaladas"
else
    print_warning "Error al instalar dependencias de Node.js, intentando con npm install..."
    npm install --production
fi

print_status "Compilando assets..."
npm run build
if [ $? -eq 0 ]; then
    print_success "Assets compilados exitosamente"
else
    print_error "Error al compilar assets"
    exit 1
fi

# Verificar si existe el archivo .env
if [ ! -f ".env" ]; then
    print_warning "Archivo .env no encontrado, copiando desde .env.example..."
    cp .env.example .env
    print_status "Generando APP_KEY..."
    php artisan key:generate
fi

print_status "Limpiando cachés..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

print_status "Optimizando para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

print_status "Ejecutando migraciones de base de datos..."
php artisan migrate --force
if [ $? -eq 0 ]; then
    print_success "Migraciones ejecutadas correctamente"
else
    print_warning "Error al ejecutar migraciones. Verifica la configuración de la base de datos."
fi

print_status "Configurando permisos..."
chmod -R 755 storage bootstrap/cache
chown -R ploi:ploi storage bootstrap/cache

print_status "Creando enlaces simbólicos para storage..."
php artisan storage:link

print_status "Reiniciando workers de cola..."
php artisan queue:restart

# Verificar que el directorio web existe
if [ ! -d "$WEB_DIR" ]; then
    print_error "Directorio web no encontrado: $WEB_DIR"
    exit 1
fi

print_status "Configurando permisos finales..."
find "$PROJECT_DIR" -type f -exec chmod 644 {} \;
find "$PROJECT_DIR" -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache

print_success "🎉 ¡Despliegue completado exitosamente!"
print_status "Tu aplicación SEGOB está lista en: https://tudominio.com"
print_status "Panel de administración: https://tudominio.com/admin"

# Información adicional
echo ""
print_status "📋 Información del despliegue:"
echo "   - Repositorio: $REPO_URL"
echo "   - Rama: $BRANCH"
echo "   - Directorio: $PROJECT_DIR"
echo "   - Directorio web: $WEB_DIR"
echo "   - PHP Version: $(php -v | head -n 1)"
echo "   - Node Version: $(node -v)"
echo "   - NPM Version: $(npm -v)"

print_warning "⚠️  Recuerda configurar las variables de entorno en el panel de Ploi.io"
print_warning "⚠️  Verifica la configuración de la base de datos en el archivo .env" 