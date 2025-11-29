# Plan de Migración: Inertia.js a Blade

**Proyecto:** SEGOB - Sistema de Gestión de Contenido Gubernamental
**Fecha de inicio:** 2025-11-29
**Branch:** `from-inertia-to-blade`
**Estado actual:** Preparación

---

## 📊 Resumen del Proyecto Actual

- **15 páginas Inertia.js** con Vue 3
- **25 componentes Vue**
- **13 rutas públicas**
- **SSR habilitado** con Vite
- **Tecnologías:** Laravel 11, Vue 3, Inertia.js, Tailwind CSS, jQuery (Slick)

---

## 🎯 Decisiones Arquitectónicas

Antes de comenzar la migración, es necesario tomar estas decisiones críticas:

### 1. Framework de JavaScript para Interactividad
- [ ] **Alpine.js** (recomendado - similar a Vue, curva de aprendizaje baja)
- [ ] Vanilla JavaScript
- [ ] HTMX para peticiones AJAX
- [ ] **Decisión tomada:** _______________

### 2. Estrategia de Paginación y Filtrado
- [ ] **Server-side rendering completo** con recarga de página
- [ ] **AJAX** con HTMX/Fetch API (mantiene UX actual)
- [ ] **Híbrido:** páginas simples SSR, páginas complejas AJAX (recomendado)
- [ ] **Decisión tomada:** _______________

### 3. Reemplazo de Carruseles (Slick/jQuery)
- [ ] **Swiper.js** (moderno, no requiere jQuery) (recomendado)
- [ ] **Embla Carousel**
- [ ] CSS puro con scroll-snap
- [ ] Alpine.js carousel component
- [ ] **Decisión tomada:** _______________

### 4. Estrategia de Testing
- [ ] Migrar tests junto con cada página
- [ ] Migrar todos los tests al final
- [ ] Crear tests E2E antes de migrar (recomendado)
- [ ] **Decisión tomada:** _______________

### 5. Período de Coexistencia
- [ ] Coexistencia Inertia + Blade durante migración (recomendado)
- [ ] Migración completa de una vez
- [ ] **Decisión tomada:** _______________

---

## 🚀 FASE 0: Preparación y Configuración Base

**Objetivo:** Configurar el entorno para que Blade e Inertia coexistan durante la migración

### 0.1 Versionamiento y Documentación
- [ ] Crear tag `pre-blade-migration` en el commit actual
- [ ] Documentar estado actual con screenshots de páginas clave
- [ ] Confirmar que branch `from-inertia-to-blade` está actualizado
- [ ] Crear este archivo de plan con checkboxes

### 0.2 Instalación de Dependencias Nuevas
- [ ] Instalar Alpine.js: `npm install alpinejs`
- [ ] Instalar HTMX (opcional): `npm install htmx.org`
- [ ] Instalar Swiper.js: `npm install swiper`
- [ ] Ejecutar `npm ci` para verificar instalación
- [ ] Actualizar `package.json` si es necesario

### 0.3 Crear Estructura de Directorios Blade
- [ ] Crear `resources/views/layouts/` para layouts
- [ ] Crear `resources/views/components/` para componentes Blade
- [ ] Crear `resources/views/components/layout/` para header, footer, menu
- [ ] Crear `resources/views/partials/` para includes
- [ ] Crear `resources/views/pages/` para páginas principales

### 0.4 Configurar Sistema Dual (Blade + Inertia)
- [ ] Crear archivo de configuración `config/migration.php`:
  ```php
  return [
      'use_blade' => env('USE_BLADE_ROUTES', false),
      'dual_mode' => env('DUAL_MODE', true),
      'migrated_routes' => [],
  ];
  ```
- [ ] Crear middleware `app/Http/Middleware/DetectViewEngine.php`
- [ ] Registrar middleware en `app/Http/Kernel.php`
- [ ] Añadir variables en `.env`: `DUAL_MODE=true`, `USE_BLADE_ROUTES=false`

### 0.5 Crear Helper para Datos Compartidos
- [ ] Crear `app/Helpers/ViewHelper.php` con funciones:
  - `getMainMenu()` - lógica de menú principal
  - `getAppSettings()` - configuración global
  - `getSharedData()` - todos los datos compartidos
- [ ] Registrar helper en `composer.json` autoload files
- [ ] Ejecutar `composer dump-autoload`

### 0.6 Configurar View Composer para Blade
- [ ] Crear `app/Providers/ViewServiceProvider.php`
- [ ] Registrar View::composer para compartir datos en todas las vistas Blade:
  ```php
  View::composer('*', function ($view) {
      $view->with('mainMenu', ViewHelper::getMainMenu());
      $view->with('appSettings', ViewHelper::getAppSettings());
  });
  ```
- [ ] Registrar provider en `config/app.php`

### 0.7 Configurar Vite para Dual Build
- [ ] Crear `resources/js/app-blade.js` como nuevo entry point
- [ ] Configurar Alpine.js en app-blade.js
- [ ] Configurar Swiper en app-blade.js (si se usa)
- [ ] Modificar `vite.config.js` para incluir ambos entry points
- [ ] Crear `resources/css/app-blade.css` si es necesario
- [ ] Probar build: `npm run build`

### 0.8 Crear Layout Maestro Blade
- [ ] Crear `resources/views/layouts/app.blade.php`:
  - Estructura HTML base
  - Meta tags dinámicos
  - @vite(['resources/js/app-blade.js', 'resources/css/app.css'])
  - @yield('content')
  - Slots para scripts adicionales
- [ ] Verificar que Tailwind CSS funciona correctamente
- [ ] Probar layout con página de prueba

### 0.9 Crear Componentes Blade Base
- [ ] Crear componentes atómicos reutilizables:
  - `components/button.blade.php`
  - `components/link.blade.php`
  - `components/card.blade.php`
  - `components/badge.blade.php`
- [ ] Crear componente de paginación: `components/pagination.blade.php`
- [ ] Documentar uso de cada componente

### 0.10 Migrar Componentes de Layout
- [ ] Crear `components/layout/header.blade.php` (de Header.vue)
- [ ] Crear `components/layout/top-bar.blade.php` (de TopBar.vue)
- [ ] Crear `components/layout/footer.blade.php` (de Footer.vue)
- [ ] Crear `components/layout/main-menu.blade.php` (de MainMenu.vue)
  - Implementar lógica de hover/mobile con Alpine.js
- [ ] Probar componentes de layout en layout maestro

### 0.11 Establecer Estrategia de Testing
- [ ] Ejecutar suite de tests actual: `php artisan test`
- [ ] Documentar tests que están pasando (baseline)
- [ ] Crear tests E2E para páginas críticas si no existen:
  - Home page
  - News/Index
  - Posts/Show
- [ ] Definir estrategia: ¿migrar tests con cada página?

### 0.12 Crear Página de Prueba Blade
- [ ] Crear ruta de prueba en `routes/web.php`: `/blade-test`
- [ ] Crear controller `BladeTestController`
- [ ] Crear vista `resources/views/pages/blade-test.blade.php`
- [ ] Verificar que:
  - Layout funciona
  - Alpine.js funciona
  - Tailwind CSS funciona
  - Datos compartidos están disponibles
  - Componentes se renderizan correctamente
- [ ] Eliminar ruta de prueba después de verificación

### 0.13 Documentar Convenciones y Patrones
- [ ] Crear `plans/blade-conventions.md` con:
  - Convención de nombres para componentes
  - Patrón de uso de Alpine.js
  - Patrón de paginación
  - Patrón de filtrado
  - Patrón de manejo de media (imágenes, videos, PDFs)
- [ ] Definir estructura de controllers (mantener invokable o cambiar)

### 0.14 Preparar Rollback Plan
- [ ] Documentar comando para revertir: `git checkout main`
- [ ] Crear tag antes de cada fase importante
- [ ] Definir feature flags si es necesario
- [ ] Documentar cómo mantener ambas versiones corriendo

**✅ Fase 0 Completa cuando todos los checkboxes estén marcados**

---

## 🟢 FASE 1: Migrar Páginas Simples (Videos, Documents, Galleries - Show)

**Objetivo:** Migrar páginas de detalle simples para establecer patrones base

**Páginas a migrar:** 3 páginas de tipo "Show" (detalle)

### 1.1 Migrar Videos/Show.vue
- [ ] Crear `resources/views/pages/videos/show.blade.php`
- [ ] Convertir estructura de template Vue a Blade
- [ ] Implementar player de video (iframe YouTube o video HTML5)
- [ ] Convertir VideoPresenter a helper PHP o usar directamente en Blade
- [ ] Actualizar `VideoController@show` para retornar view() en vez de Inertia
- [ ] Añadir 'videos.show' a `config/migration.php` migrated_routes
- [ ] Probar página: `/videos/{slug}`
- [ ] Verificar responsive design
- [ ] Actualizar tests si existen

### 1.2 Migrar Documents/Show.vue
- [ ] Crear `resources/views/pages/documents/show.blade.php`
- [ ] Implementar visor de PDF (iframe o embed)
- [ ] Añadir botón de descarga
- [ ] Convertir DocumentPresenter a helper PHP
- [ ] Actualizar `DocumentController@show` para retornar view()
- [ ] Añadir 'documents.show' a migrated_routes
- [ ] Probar página: `/documentos/{slug}`
- [ ] Verificar que PDF se carga correctamente
- [ ] Actualizar tests si existen

### 1.3 Migrar PhotoGalleries/Show.vue
- [ ] Crear `resources/views/pages/photo-galleries/show.blade.php`
- [ ] Implementar grid de imágenes con Tailwind
- [ ] Añadir lightbox/modal para ampliar imágenes (Alpine.js o librería)
- [ ] Convertir PhotoGalleryPresenter a helper PHP
- [ ] Actualizar `PhotoGalleryController@show` para retornar view()
- [ ] Añadir 'photo-galleries.show' a migrated_routes
- [ ] Probar página: `/galerias/{slug}`
- [ ] Verificar carga de imágenes y responsive
- [ ] Actualizar tests si existen

### 1.4 Refactorización y Documentación Fase 1
- [ ] Extraer patrones comunes a componentes Blade
- [ ] Documentar patrón de "página de detalle" en conventions.md
- [ ] Ejecutar tests: `php artisan test --filter=Video|Document|PhotoGallery`
- [ ] Code review de cambios
- [ ] Crear tag: `blade-migration-phase-1-complete`
- [ ] Commit: "Phase 1: Migrate Videos, Documents, PhotoGalleries Show pages to Blade"

**✅ Fase 1 Completa: 3 páginas migradas**

---

## 🟡 FASE 2: Migrar Páginas con Listado Simple (Videos, Galleries, Infographics - Index)

**Objetivo:** Migrar páginas de listado con paginación simple (sin filtros complejos)

**Páginas a migrar:** 4 páginas de tipo "Index" con paginación

### 2.1 Crear Componente de Paginación Blade
- [ ] Mejorar `components/pagination.blade.php` si es necesario
- [ ] Añadir estilos Tailwind consistentes con diseño actual
- [ ] Probar paginación con datos de prueba
- [ ] Documentar uso del componente

### 2.2 Migrar Videos/Index.vue
- [ ] Crear `resources/views/pages/videos/index.blade.php`
- [ ] Crear componente `components/videos/video-article.blade.php` (de VideoArticle.vue)
- [ ] Implementar grid de videos con paginación
- [ ] Implementar filtrado por fecha publicación (si existe)
- [ ] Actualizar `VideoController@index` para retornar view()
- [ ] Añadir 'videos.index' a migrated_routes
- [ ] Probar página: `/videos`
- [ ] Verificar paginación funciona
- [ ] Actualizar tests si existen

### 2.3 Migrar PhotoGalleries/Index.vue
- [ ] Crear `resources/views/pages/photo-galleries/index.blade.php`
- [ ] Crear componente `components/photo-galleries/gallery-article.blade.php`
- [ ] Implementar grid de galerías con paginación
- [ ] Implementar filtrado por fecha/título (si existe)
- [ ] Actualizar `PhotoGalleryController@index` para retornar view()
- [ ] Añadir 'photo-galleries.index' a migrated_routes
- [ ] Probar página: `/galerias`
- [ ] Verificar paginación funciona
- [ ] Actualizar tests si existen

### 2.4 Migrar Infographics/Index.vue
- [ ] Crear `resources/views/pages/infographics/index.blade.php`
- [ ] Crear componente `components/infographics/infographic-article.blade.php`
- [ ] Implementar grid de infografías con paginación
- [ ] Actualizar `InfographicController@index` para retornar view()
- [ ] Añadir 'infographics.index' a migrated_routes
- [ ] Probar página: `/infografias`
- [ ] Verificar paginación funciona
- [ ] Actualizar tests si existen

### 2.5 Migrar Version.vue
- [ ] Crear `resources/views/pages/versions/index.blade.php`
- [ ] Implementar listado de versiones estenográficas
- [ ] Implementar filtros por boletín/año si existen
- [ ] Actualizar `VersionController` para retornar view()
- [ ] Añadir 'versions.index' a migrated_routes
- [ ] Probar página: `/versiones`
- [ ] Verificar filtros y paginación
- [ ] Actualizar tests si existen

### 2.6 Refactorización y Documentación Fase 2
- [ ] Extraer patrones comunes de listados a componentes
- [ ] Documentar patrón de "página de listado con paginación"
- [ ] Ejecutar tests completos de páginas migradas
- [ ] Code review de cambios
- [ ] Crear tag: `blade-migration-phase-2-complete`
- [ ] Commit: "Phase 2: Migrate Index pages with simple pagination to Blade"

**✅ Fase 2 Completa: 7 páginas migradas (3 de Fase 1 + 4 de Fase 2)**

---

## 🟠 FASE 3: Migrar Sistema de Filtrado y PostsLayout

**Objetivo:** Implementar el sistema de filtrado complejo (PostsFilter) con AJAX o server-side

**Páginas a migrar:** 3 páginas que usan PostsFilter + Documents/Index

**⚠️ DECISIÓN CRÍTICA NECESARIA:** ¿AJAX con Alpine.js/HTMX o Server-side con forms?

### 3.1 Diseñar e Implementar Sistema de Filtrado
- [ ] **Decidir enfoque final:** AJAX o Server-side
- [ ] Crear componente `components/posts/posts-filter.blade.php`
  - [ ] Input de búsqueda por título
  - [ ] Date picker para filtro por fecha
  - [ ] Checkboxes para tipos de contenido
  - [ ] Select para dependencias
  - [ ] Botón "Limpiar filtros"
- [ ] Implementar lógica de filtrado:
  - [ ] Si AJAX: Alpine.js + Fetch API con debounce
  - [ ] Si Server-side: Form con GET method
- [ ] Crear endpoint API si se usa AJAX: `/api/posts/filter`
- [ ] Probar filtros independientemente

### 3.2 Crear Componente PostsLayout
- [ ] Crear `components/posts/posts-layout.blade.php`
- [ ] Implementar estructura: sidebar (filters) + content (grid)
- [ ] Integrar componente posts-filter
- [ ] Añadir slot para content
- [ ] Probar con datos de prueba

### 3.3 Crear Componente PostArticle
- [ ] Crear `components/posts/post-article.blade.php`
- [ ] Convertir lógica de PostPresenter a helper PHP
- [ ] Implementar card de post con imagen, título, excerpt, fecha
- [ ] Añadir badges para tipo de contenido
- [ ] Añadir enlaces a posts relacionados

### 3.4 Migrar News/Index.vue
- [ ] Crear `resources/views/pages/news/index.blade.php`
- [ ] Usar componente posts-layout
- [ ] Implementar listado de posts con filtros
- [ ] Implementar paginación con filtros preservados
- [ ] Actualizar `NewsController` para manejar filtros
- [ ] Añadir 'news.index' a migrated_routes
- [ ] Probar página: `/noticias`
- [ ] Probar todos los filtros funcionan
- [ ] Verificar paginación mantiene filtros
- [ ] Actualizar tests

### 3.5 Migrar SegobNews/Index.vue
- [ ] Crear `resources/views/pages/segob-news/index.blade.php`
- [ ] Reutilizar posts-layout con filtro de dependencia SEGOB
- [ ] Actualizar `SegobNewsController` para filtros
- [ ] Añadir 'segob-news.index' a migrated_routes
- [ ] Probar página: `/noticias-segob`
- [ ] Verificar filtros específicos de SEGOB
- [ ] Actualizar tests

### 3.6 Migrar Documents/Index.vue
- [ ] Crear componente de filtro específico para documentos
- [ ] Implementar filtros por sección de documento
- [ ] Actualizar `DocumentController@index` con lógica de filtros
- [ ] Añadir 'documents.index' a migrated_routes
- [ ] Probar página: `/documentos`
- [ ] Verificar filtros y paginación
- [ ] Actualizar tests

### 3.7 Refactorización y Documentación Fase 3
- [ ] Optimizar queries de filtrado (N+1 queries)
- [ ] Documentar patrón de filtrado en conventions.md
- [ ] Extraer helpers comunes de presenters
- [ ] Ejecutar tests completos
- [ ] Code review de cambios
- [ ] Crear tag: `blade-migration-phase-3-complete`
- [ ] Commit: "Phase 3: Migrate filtering system and posts listing pages to Blade"

**✅ Fase 3 Completa: 10 páginas migradas**

---

## 🔴 FASE 4: Migrar Páginas Complejas (Posts/Show, Actions, Dependencies, MexicoNews)

**Objetivo:** Migrar las páginas más complejas con interactividad avanzada

**Páginas a migrar:** 4 páginas complejas

### 4.1 Migrar Posts/Show.vue (Página más compleja)
- [ ] Crear `resources/views/pages/posts/show.blade.php`
- [ ] Implementar sistema de tabs con Alpine.js:
  - [ ] Tab: Contenido principal
  - [ ] Tab: Galería de fotos (condicional)
  - [ ] Tab: Audio (condicional)
  - [ ] Tab: Documento (condicional)
  - [ ] Tab: Video (condicional)
  - [ ] Tab: Versión estenográfica (condicional)
- [ ] Implementar renderizado condicional de tabs según post properties
- [ ] Integrar reproductor de audio (HTML5 audio)
- [ ] Integrar visor de PDF
- [ ] Integrar reproductor de video
- [ ] Mostrar galería de fotos (grid o carousel)
- [ ] Mostrar estados/dependencias asociadas
- [ ] Actualizar `PostController` para retornar view()
- [ ] Añadir 'posts.show' a migrated_routes
- [ ] Probar página: `/posts/{slug}`
- [ ] Verificar todos los tipos de contenido funcionan
- [ ] Probar navegación entre tabs
- [ ] Actualizar tests

### 4.2 Migrar Actions/Show.vue
- [ ] Crear `resources/views/pages/actions/show.blade.php`
- [ ] Implementar búsqueda de posts asociados (Alpine.js + AJAX o form)
- [ ] Implementar grid de posts con paginación
- [ ] Preservar búsqueda en paginación
- [ ] Actualizar `ActionController` para búsqueda y paginación
- [ ] Añadir 'actions.show' a migrated_routes
- [ ] Probar página: `/acciones/{slug}`
- [ ] Verificar búsqueda funciona
- [ ] Verificar paginación con búsqueda
- [ ] Actualizar tests

### 4.3 Migrar Dependencies/Show.vue
- [ ] Crear `resources/views/pages/dependencies/show.blade.php`
- [ ] Implementar similar a Actions/Show (búsqueda + posts)
- [ ] Actualizar `DependencyController`
- [ ] Añadir 'dependencies.show' a migrated_routes
- [ ] Probar página: `/dependencias/{slug}`
- [ ] Verificar búsqueda y paginación
- [ ] Actualizar tests

### 4.4 Migrar MexicoNews.vue
- [ ] Crear `resources/views/pages/mexico-news/index.blade.php`
- [ ] Implementar filtros específicos de noticias México
- [ ] Implementar listado con modelos MexicoNews y MexicoDependency
- [ ] Actualizar `MexicoNewsController`
- [ ] Añadir 'mexico-news.index' a migrated_routes
- [ ] Probar página: `/noticias-mexico`
- [ ] Verificar filtros funcionan
- [ ] Actualizar tests

### 4.5 Refactorización y Documentación Fase 4
- [ ] Extraer componente de tabs reutilizable
- [ ] Extraer componente de búsqueda reutilizable
- [ ] Documentar patrón de tabs con Alpine.js
- [ ] Documentar patrón de búsqueda + paginación
- [ ] Ejecutar tests completos
- [ ] Code review de cambios
- [ ] Crear tag: `blade-migration-phase-4-complete`
- [ ] Commit: "Phase 4: Migrate complex pages (Posts/Show, Actions, Dependencies, MexicoNews) to Blade"

**✅ Fase 4 Completa: 14 páginas migradas**

---

## 🏠 FASE 5: Migrar Home Page (Página más compleja)

**Objetivo:** Migrar la página de inicio con todos sus componentes y carruseles

**Páginas a migrar:** 1 página (la más compleja del proyecto)

### 5.1 Migrar Componente Banners (Carousel)
- [ ] Crear `components/home/banners.blade.php`
- [ ] Implementar Swiper.js para carousel de banners
- [ ] Configurar autoplay, flechas de navegación
- [ ] Añadir lazy loading de imágenes
- [ ] Probar responsividad

### 5.2 Migrar Componentes de Featured Posts
- [ ] Analizar estructura de featured posts en Home.vue
- [ ] Crear componentes para diferentes tamaños de posts
- [ ] Implementar grid con orden específico (xl:order-*)
- [ ] Probar con datos de FeaturedPost

### 5.3 Migrar Componentes de Acciones
- [ ] Crear `components/home/actions.blade.php`
- [ ] Implementar grid de acciones
- [ ] Añadir enlaces a páginas de detalle
- [ ] Probar con datos reales

### 5.4 Migrar Componentes de Dependencias
- [ ] Crear `components/home/dependencies.blade.php`
- [ ] Implementar carousel de dependencias con Swiper
- [ ] Configurar navegación
- [ ] Probar responsividad

### 5.5 Migrar Componentes de Infografías
- [ ] Crear `components/home/infographics.blade.php`
- [ ] Crear `components/home/infographic.blade.php` (item individual)
- [ ] Implementar grid de infografías
- [ ] Probar con datos reales

### 5.6 Migrar Componentes de Media Gallery
- [ ] Crear `components/home/media-gallery.blade.php`
- [ ] Crear `components/home/photo-gallery-item.blade.php`
- [ ] Crear `components/home/video-item.blade.php`
- [ ] Implementar sección combinada de fotos/videos
- [ ] Probar con datos reales

### 5.7 Migrar Componente de Noticias México
- [ ] Crear `components/home/noticias-mx.blade.php`
- [ ] Implementar listado de noticias México
- [ ] Añadir enlace a página completa
- [ ] Probar con datos reales

### 5.8 Migrar Componente de Contacto
- [ ] Crear `components/home/contact.blade.php`
- [ ] Implementar sección de contacto con mapa
- [ ] Integrar datos de app_settings
- [ ] Probar con datos reales

### 5.9 Integrar Todos los Componentes en Home
- [ ] Crear `resources/views/pages/home/index.blade.php`
- [ ] Integrar todos los componentes en orden correcto:
  - [ ] Banners
  - [ ] Featured posts
  - [ ] Actions
  - [ ] Dependencies
  - [ ] Infographics
  - [ ] Media Gallery
  - [ ] Noticias MX
  - [ ] Contact
- [ ] Actualizar `HomeController` para retornar view()
- [ ] Añadir 'home' a migrated_routes
- [ ] Configurar meta tags con app_settings

### 5.10 Testing y Optimización Home
- [ ] Probar página: `/`
- [ ] Verificar todos los carouseles funcionan
- [ ] Verificar carga de imágenes (lazy loading)
- [ ] Optimizar queries (N+1 prevention)
- [ ] Verificar responsividad en móvil/tablet/desktop
- [ ] Probar performance (Lighthouse)
- [ ] Actualizar tests

### 5.11 Refactorización y Documentación Fase 5
- [ ] Documentar patrón de carousel con Swiper
- [ ] Documentar estructura de homepage
- [ ] Ejecutar tests completos
- [ ] Code review de cambios
- [ ] Crear tag: `blade-migration-phase-5-complete`
- [ ] Commit: "Phase 5: Migrate Home page with all components and carousels to Blade"

**✅ Fase 5 Completa: 15 páginas migradas (TODAS)**

---

## 🧹 FASE 6: Limpieza y Eliminación de Inertia.js

**Objetivo:** Remover todo el código relacionado con Inertia.js y Vue.js

### 6.1 Actualizar Configuración
- [ ] Cambiar `.env`: `USE_BLADE_ROUTES=true`, `DUAL_MODE=false`
- [ ] Eliminar `config/migration.php` (ya no necesario)
- [ ] Eliminar middleware `DetectViewEngine`
- [ ] Limpiar `app/Http/Kernel.php` de referencias al middleware

### 6.2 Eliminar Archivos de Inertia/Vue
- [ ] Eliminar `resources/js/Pages/` completo
- [ ] Eliminar `resources/js/Components/` completo
- [ ] Eliminar `resources/js/Layouts/` completo
- [ ] Eliminar `resources/js/Presenters/` completo
- [ ] Eliminar `resources/js/Composables/` completo
- [ ] Eliminar `resources/js/app.js` (entry point de Inertia)
- [ ] Eliminar `resources/js/ssr.js` (entry point SSR)
- [ ] Renombrar `resources/js/app-blade.js` a `resources/js/app.js`
- [ ] Eliminar `resources/views/app.blade.php` (layout de Inertia)

### 6.3 Limpiar Controllers
- [ ] Remover imports de `use Inertia\Inertia;`
- [ ] Verificar que todos usan `return view()` en vez de `Inertia::render()`
- [ ] Limpiar imports no utilizados
- [ ] Ejecutar `composer dump-autoload`

### 6.4 Limpiar Middleware
- [ ] Remover `app/Http/Middleware/HandleInertiaRequests.php`
- [ ] Actualizar `app/Http/Kernel.php` para remover HandleInertiaRequests
- [ ] Limpiar grupo de middleware 'web' si es necesario

### 6.5 Desinstalar Dependencias
- [ ] Desinstalar paquetes Vue/Inertia:
  ```bash
  npm uninstall @inertiajs/vue3 @vue/server-renderer vue @vitejs/plugin-vue
  npm uninstall vue-pdf-embed jszip
  ```
- [ ] Desinstalar paquetes PHP:
  ```bash
  composer remove inertiajs/inertia-laravel tightenco/ziggy
  ```
- [ ] Ejecutar `npm ci` y `composer install` para limpiar

### 6.6 Actualizar Vite Config
- [ ] Remover plugin Vue de `vite.config.js`
- [ ] Remover SSR de configuración
- [ ] Simplificar entry points a solo `resources/js/app.js`
- [ ] Actualizar `vite.config.js`:
  ```javascript
  export default defineConfig({
      plugins: [
          laravel({
              input: ['resources/css/app.css', 'resources/js/app.js'],
              refresh: true,
          }),
      ],
  });
  ```
- [ ] Probar build: `npm run build`

### 6.7 Actualizar Package.json
- [ ] Remover scripts relacionados con SSR
- [ ] Simplificar script de build: `"build": "vite build"`
- [ ] Remover dependencias de Vue/Inertia del package.json
- [ ] Limpiar scripts no utilizados

### 6.8 Limpiar Routes
- [ ] Verificar que todas las rutas usan controllers Blade
- [ ] Remover imports de Inertia si existen
- [ ] Limpiar comentarios obsoletos

### 6.9 Eliminar API Endpoints de Composables
- [ ] Verificar si `/api/content-types` y `/api/dependencies` siguen siendo necesarios
- [ ] Si no: eliminar rutas en `routes/api.php`
- [ ] Si no: eliminar controllers correspondientes
- [ ] Limpiar `routes/api.php`

### 6.10 Testing Final
- [ ] Ejecutar suite completa de tests: `php artisan test`
- [ ] Verificar que todos los tests pasan
- [ ] Probar manualmente todas las páginas migradas
- [ ] Probar en diferentes navegadores
- [ ] Probar responsividad móvil/tablet/desktop
- [ ] Ejecutar Lighthouse audit en páginas clave

### 6.11 Documentación Final
- [ ] Actualizar README.md para reflejar nueva arquitectura
- [ ] Actualizar CLAUDE.md para remover referencias a Inertia/Vue
- [ ] Documentar comandos de desarrollo actualizados
- [ ] Documentar nueva estructura de frontend
- [ ] Crear guía de componentes Blade disponibles

### 6.12 Code Review y Refactorización Final
- [ ] Revisar código duplicado
- [ ] Optimizar componentes Blade
- [ ] Limpiar helpers no utilizados
- [ ] Verificar PSR-12 compliance: `./vendor/bin/pint`
- [ ] Ejecutar formateo de código: `npm run format`

### 6.13 Finalización
- [ ] Crear tag: `blade-migration-complete`
- [ ] Commit final: "Phase 6: Remove Inertia.js and Vue.js dependencies, complete Blade migration"
- [ ] Merge a main: `git checkout main && git merge from-inertia-to-blade`
- [ ] Crear release notes con changelog completo
- [ ] Celebrar 🎉

**✅ Fase 6 Completa: Migración 100% completa, Inertia.js removido**

---

## 📊 Resumen de Progreso

### Estadísticas de Migración
- **Páginas migradas:** 0 / 15 (0%)
- **Componentes migrados:** 0 / 25 (0%)
- **Fase actual:** 0 - Preparación

### Checklist General
- [ ] Fase 0: Preparación (0/14 tareas)
- [ ] Fase 1: Páginas simples (0/4 secciones)
- [ ] Fase 2: Listados simples (0/6 secciones)
- [ ] Fase 3: Sistema de filtrado (0/7 secciones)
- [ ] Fase 4: Páginas complejas (0/5 secciones)
- [ ] Fase 5: Home page (0/11 secciones)
- [ ] Fase 6: Limpieza final (0/13 secciones)

### Páginas por Estado
**Pendientes (15):**
- Home.vue
- News/Index.vue, Posts/Show.vue, SegobNews/Index.vue, Version.vue
- Documents/Index.vue, Documents/Show.vue
- PhotoGalleries/Index.vue, PhotoGalleries/Show.vue
- Videos/Index.vue, Videos/Show.vue
- Infographics/Index.vue
- Actions/Show.vue, Dependencies/Show.vue
- MexicoNews.vue

**En progreso (0):**
- Ninguna

**Completadas (0):**
- Ninguna

---

## 📝 Notas y Lecciones Aprendidas

### Problemas Encontrados
_Documentar aquí cualquier problema encontrado durante la migración_

### Soluciones Implementadas
_Documentar aquí las soluciones a problemas comunes_

### Mejoras Descubiertas
_Documentar aquí cualquier mejora encontrada durante la migración_

### Optimizaciones Realizadas
_Documentar aquí optimizaciones de performance o código_

---

## 🔗 Referencias

- [Laravel Blade Documentation](https://laravel.com/docs/11.x/blade)
- [Alpine.js Documentation](https://alpinejs.dev/)
- [Swiper.js Documentation](https://swiperjs.com/)
- [Tailwind CSS Documentation](https://tailwindcss.com/)
- [HTMX Documentation](https://htmx.org/) (si se usa)

---

**Última actualización:** 2025-11-29
**Responsable:** Equipo de desarrollo SEGOB
**Tiempo estimado total:** Depende de complejidad de cada fase (aprox. 4-8 semanas)

---

## ✅ Progreso Actual

**Fase Actual:** Fase 0 - Completada

**Commit:** `5932b48` - Phase 0: Complete preparation and base configuration for Blade migration
**Tag:** `pre-blade-migration` (creado antes de comenzar)

**Resumen de la Fase 0:**
- ✅ Sistema dual configurado (Blade + Inertia coexisten)
- ✅ Dependencies instaladas (Alpine.js, Swiper.js)
- ✅ Estructura de directorios Blade creada
- ✅ Helper para datos compartidos implementado
- ✅ View Composer configurado
- ✅ Vite configurado para dual build
- ✅ Layout maestro Blade creado
- ✅ Componentes base creados (button, link, card, badge, pagination)
- ✅ Componentes de layout migrados (TopBar, Header, MainMenu, Footer)
- ✅ Estrategia de testing establecida
- ✅ Página de prueba creada y verificada (`/blade-test`)
- ✅ Convenciones documentadas en `blade-conventions.md`
- ✅ Plan de rollback documentado en `rollback-plan.md`

**Próximo Paso:** Fase 1 - Migrar páginas simples (Videos, Documents, PhotoGalleries - Show)
