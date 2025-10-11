# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

SEGOB is a government news and content management system built with Laravel 11 and Vue.js 3, using Inertia.js for seamless frontend-backend integration. The project includes a Filament admin panel for content management and a public-facing website for displaying news, documents, galleries, and multimedia content.

## Technology Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Vue.js 3, Inertia.js, Tailwind CSS
- **Admin Panel**: Filament 3
- **Build Tools**: Vite
- **Testing**: Pest PHP
- **Database**: MySQL
- **Media Management**: Spatie Media Library
- **Additional**: Laravel Sanctum, Ziggy (route helpers), jQuery (for legacy slick-carousel)

## Development Commands

### Setup
```bash
composer install
npm ci
cp .env.example .env
php artisan key:generate
composer fresh  # Runs migrate:fresh with DefaultDataSeeder
```

### Development Server
```bash
composer dev  # Runs server, queue, logs, and vite concurrently with color-coded output
# Or run individually:
php artisan serve
php artisan queue:listen --tries=1
php artisan pail --timeout=0
npm run dev
```

### Building for Production
```bash
npm run build  # Builds both client and SSR bundles
```

### Code Quality
```bash
npm run format  # Formats JS/Vue files with Prettier
php artisan pint  # Laravel Pint for PHP formatting (if configured)
```

### Testing
```bash
php artisan test  # Run all tests with Pest
php artisan test --filter=TestName  # Run specific test
php artisan test tests/Feature/Posts/CreatePostTest.php  # Run specific test file
```

## Architecture Overview

### Content Model Hierarchy

The system uses a flexible **Post** model as the primary content type with polymorphic relationships to specialized content:

- **Post**: Main content model with fields for title, content, excerpt, slug, publication status
  - Can be linked to: Audio, Document, PhotoGallery, Video, or StenographicVersion (another Post)
  - Has many-to-many relationships with: Actions, Dependencies, States
  - Supports multiple content types via `ContentTypeEnum`
  - Uses Spatie Media Library for image handling

### Key Models

- **Post**: News articles, press releases, stenographic versions (bulletin, year tracking)
- **Action**: Government actions that can be associated with posts
- **Dependency**: Government departments/dependencies
- **Document**: PDF documents and infographics (typed via `DocumentTypeEnum`)
- **DocumentSection**: Categorizes documents into sections
- **PhotoGallery**: Image galleries
- **Video**: Video content
- **Audio**: Audio content
- **Banner**: Homepage banners
- **FeaturedPost**: Ordered list of featured posts for homepage
- **MexicoNews** / **MexicoDependency**: Separate Mexico-wide news system
- **State**: Mexican states that can be tagged to posts

### Frontend Architecture

**Inertia.js Integration**:
- All pages in `resources/js/Pages/` automatically use `AppLayout.vue` unless overridden
- Shared props defined in `HandleInertiaRequests.php`:
  - `main_menu`: Navigation structure with dynamic Actions submenu
  - `app_settings`: Logo, social networks, contact info, meta tags
  - `ziggy`: Route helpers for frontend

**Component Organization**:
- `Components/Layout/`: Header, Footer, MainMenu, TopBar
- `Components/Posts/`: PostArticle, PostsLayout, PostsFilter
- `Components/Home/`: Homepage-specific components (Banners, Actions, Dependencies, etc.)
- `Components/*/`: Organized by feature (Documents, PhotoGalleries, Videos, etc.)

### Backend Structure

**Filament Admin Panel** (`/admin` route):
- Resources in `app/Filament/Resources/` for CRUD operations
- Custom page: `GeneralSettings.php` for site-wide settings (via Spatie Laravel Settings)
- Navigation organized into groups: CMS Contenido, Catálogos, Noticias MX, Acciones, Configuración

**Controllers**:
- Most are single-action invokable controllers
- Use Eloquent API Resources for JSON transformation
- Route model binding with slugs for public routes

**Query Filtering**:
- Posts use scope methods: `scopeFilterByTitle`, `scopeFilterByContentType`, `scopeFilterByPublishedAt`, `scopeFilterByDependency`
- Spatie Query Builder package available for advanced filtering

### Routing Pattern

Public routes (`routes/web.php`):
- Index pages: `/noticias`, `/documentos`, `/galerias`, `/videos`
- Show pages use slug binding: `/posts/{post:slug}`, `/acciones/{action:slug}`
- Specialized sections: `/noticias-segob`, `/noticias-mexico`, `/versiones`

## Important Patterns

### Posts Content Relationships

Posts can reference specialized content via foreign keys:
- `audio_id` → Audio
- `document_id` → Document
- `photo_gallery_id` → PhotoGallery
- `video_id` → Video
- `stenographic_version_id` → Post (self-reference)

### Auditing Fields

Posts track editorial history:
- `created_by` → User who created
- `last_edited_by` → User who last modified
- `last_edited_at` → Timestamp of last edit
- Updated automatically via model boot method

### Media Collections

Models using Spatie Media Library define collections:
- Posts: `image` (single), `documents` (multiple)
- Check `registerMediaCollections()` in each model for specifics

## Database Seeding

Run `composer fresh` to reset database with `DefaultDataSeeder`. This is the recommended way to refresh the database during development.

## Frontend Build Notes

- SSR is enabled: `vite build && vite build --ssr`
- Ziggy routes are available in Vue components via `route()` helper
- Day.js is used for date formatting
- Slick Carousel (jQuery) is used for some carousels
- Vue PDF Embed for document viewing

## Settings Management

Global site settings managed via Spatie Laravel Settings:
- Class: `App\Settings\AppSettings`
- Admin UI: Filament page at `/admin/general-settings`
- Settings include: logos, social networks, map URL, contact info, footer/top bar links, meta tags
