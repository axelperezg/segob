# Blade Conventions and Patterns

**Project:** SEGOB - Sistema de Gestión de Contenido Gubernamental
**Date Created:** 2025-11-29
**Purpose:** Document conventions and patterns for Blade migration

---

## Naming Conventions

### Components
- **Location:** `resources/views/components/`
- **Naming:** Use kebab-case (e.g., `button.blade.php`, `post-article.blade.php`)
- **Usage in Blade:** `<x-button>` or `<x-post-article>`
- **Subdirectories:** Group related components (e.g., `components/layout/`, `components/posts/`)

### Pages
- **Location:** `resources/views/pages/`
- **Naming:** Use kebab-case with directory structure matching routes
- **Example:** `/videos/{slug}` → `pages/videos/show.blade.php`

### Layouts
- **Location:** `resources/views/layouts/`
- **Main Layout:** `layouts/app.blade.php`

### Partials
- **Location:** `resources/views/partials/`
- **Usage:** Small reusable pieces that aren't full components

---

## Alpine.js Usage Patterns

### Basic Counter Pattern
```blade
<div x-data="{ count: 0 }">
    <span x-text="count"></span>
    <button @click="count++">Increment</button>
</div>
```

### Toggle/Dropdown Pattern
```blade
<div x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen">Toggle</button>
    <div x-show="isOpen">Content</div>
</div>
```

### Hover Menu Pattern (for MainMenu)
```blade
<li x-data="{ isOpen: false }"
    @mouseenter="isOpen = true"
    @mouseleave="isOpen = false">
    <a href="#">Menu Item</a>
    <ul :class="{ 'hidden': !isOpen, 'block': isOpen }">
        <li><a href="#">Submenu Item</a></li>
    </ul>
</li>
```

---

## Pagination Pattern

### Standard Laravel Pagination
```php
// Controller
$posts = Post::paginate(15);
return view('pages.posts.index', compact('posts'));
```

```blade
<!-- View -->
@if($posts->count() > 0)
    @foreach($posts as $post)
        <!-- Post content -->
    @endforeach

    <x-pagination :paginator="$posts" />
@else
    <p>No posts found</p>
@endif
```

### Pagination with Filters
Filters are preserved automatically using `appends()`:

```php
// Controller
$query = Post::query();

if ($request->filled('search')) {
    $query->where('title', 'like', "%{$request->search}%");
}

$posts = $query->paginate(15)->appends($request->query());
```

---

## Filtering Pattern

### Approach: Server-Side with Forms
For SEO and simplicity, use traditional forms with GET method:

```blade
<form method="GET" action="{{ route('news.index') }}" class="mb-6">
    <!-- Search -->
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar por título"
        class="px-4 py-2 border rounded"
    >

    <!-- Date Filter -->
    <input
        type="date"
        name="date"
        value="{{ request('date') }}"
        class="px-4 py-2 border rounded"
    >

    <!-- Content Type Filter -->
    <select name="content_type" class="px-4 py-2 border rounded">
        <option value="">Todos los tipos</option>
        <option value="audio" {{ request('content_type') === 'audio' ? 'selected' : '' }}>Audio</option>
        <option value="video" {{ request('content_type') === 'video' ? 'selected' : '' }}>Video</option>
    </select>

    <!-- Submit -->
    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded">
        Filtrar
    </button>

    <!-- Clear -->
    <a href="{{ route('news.index') }}" class="px-4 py-2 text-gray-600">
        Limpiar filtros
    </a>
</form>
```

```php
// Controller
public function __invoke(Request $request)
{
    $query = Post::query();

    if ($request->filled('search')) {
        $query->filterByTitle($request->search);
    }

    if ($request->filled('date')) {
        $query->filterByPublishedAt($request->date);
    }

    if ($request->filled('content_type')) {
        $query->filterByContentType($request->content_type);
    }

    $posts = $query->paginate(15)->appends($request->query());

    return view('pages.news.index', compact('posts'));
}
```

---

## Media Handling

### Images with Spatie Media Library
```blade
@if($post->hasMedia('image'))
    <img
        src="{{ $post->getFirstMediaUrl('image', 'thumb') }}"
        alt="{{ $post->title }}"
        class="w-full h-auto rounded"
    >
@else
    <img src="/assets/placeholder.jpg" alt="Placeholder">
@endif
```

### Video Embeds
```blade
@if($video->url)
    @php
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $video->url, $matches);
        $youtubeId = $matches[1] ?? null;
    @endphp

    @if($youtubeId)
        <iframe
            src="https://www.youtube.com/embed/{{ $youtubeId }}"
            class="w-full aspect-video"
            frameborder="0"
            allowfullscreen
        ></iframe>
    @endif
@endif
```

### PDF Documents
```blade
@if($document->pdf_url)
    <iframe
        src="{{ $document->pdf_url }}"
        class="w-full h-screen"
        frameborder="0"
    ></iframe>

    <a
        href="{{ $document->pdf_url }}"
        download
        class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700"
    >
        Descargar PDF
    </a>
@endif
```

---

## Carousel Pattern (Swiper.js)

### Basic Swiper Implementation
```blade
<div class="swiper banners-swiper">
    <div class="swiper-wrapper">
        @foreach($banners as $banner)
            <div class="swiper-slide">
                <img src="/storage/{{ $banner->image }}" alt="{{ $banner->title }}">
            </div>
        @endforeach
    </div>

    <!-- Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>

@push('scripts')
<script>
    new Swiper('.banners-swiper', {
        modules: [window.SwiperModules.Navigation, window.SwiperModules.Pagination, window.SwiperModules.Autoplay],
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
        loop: true,
    });
</script>
@endpush
```

---

## Shared Data Access

Shared data is automatically available in all Blade views (configured in `ViewServiceProvider`):

```blade
<!-- Access main menu -->
@foreach($mainMenu as $item)
    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
@endforeach

<!-- Access app settings -->
<img src="/storage/{{ $appSettings['logo'] }}" alt="Logo">

<!-- Social networks -->
@foreach($appSettings['social_networks'] as $social)
    <a href="{{ $social['url'] }}" target="_blank">
        <i class="fa-brands fa-{{ $social['network'] }}"></i>
    </a>
@endforeach
```

---

## Component Patterns

### Button Component
```blade
<x-button variant="primary">Click Me</x-button>
<x-button variant="secondary">Cancel</x-button>
<x-button variant="outline" type="submit">Submit</x-button>
```

### Card Component
```blade
<x-card>
    <h2>Card Title</h2>
    <p>Card content</p>
</x-card>

<x-card :padding="false">
    <img src="image.jpg" class="w-full">
    <div class="p-6">Content with manual padding</div>
</x-card>
```

### Badge Component
```blade
<x-badge variant="primary">New</x-badge>
<x-badge variant="success">Active</x-badge>
<x-badge variant="warning">Pending</x-badge>
```

---

## Controller Patterns

### Invokable Controllers (Single Action)
```php
class NewsController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = Post::published()
            ->latest()
            ->paginate(15);

        return view('pages.news.index', compact('posts'));
    }
}
```

### Resource Controllers (Multiple Actions)
```php
class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::paginate(12);
        return view('pages.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('pages.videos.show', compact('video'));
    }
}
```

---

## Conditional Rendering

### Content Types
```blade
@if($post->audio_id)
    <audio controls>
        <source src="{{ $post->audio->file_url }}" type="audio/mpeg">
    </audio>
@endif

@if($post->video_id)
    <!-- Render video -->
@endif

@if($post->photo_gallery_id)
    <!-- Render photo gallery -->
@endif
```

### Tabs with Alpine.js
```blade
<div x-data="{ activeTab: 'content' }">
    <!-- Tab Navigation -->
    <ul class="flex gap-4 border-b">
        <li>
            <button
                @click="activeTab = 'content'"
                :class="{ 'border-b-2 border-red-600': activeTab === 'content' }"
                class="px-4 py-2"
            >
                Contenido
            </button>
        </li>
        <li>
            <button
                @click="activeTab = 'gallery'"
                :class="{ 'border-b-2 border-red-600': activeTab === 'gallery' }"
                class="px-4 py-2"
            >
                Galería
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div x-show="activeTab === 'content'">
        <p>{{ $post->content }}</p>
    </div>

    <div x-show="activeTab === 'gallery'">
        <!-- Gallery content -->
    </div>
</div>
```

---

## Date Formatting

Use Carbon in Blade:

```blade
{{ $post->published_at->format('d/m/Y') }}
{{ $post->published_at->diffForHumans() }}
{{ $post->created_at->translatedFormat('F d, Y') }}
```

---

## URL Generation

```blade
<!-- Named routes -->
<a href="{{ route('news.index') }}">Noticias</a>
<a href="{{ route('posts.show', $post->slug) }}">Ver post</a>

<!-- Asset URLs -->
<img src="{{ asset('assets/logo.png') }}">
<img src="/storage/{{ $image->path }}">

<!-- External URLs -->
<a href="{{ $url }}" target="_blank">External Link</a>
```

---

## Error Handling

```blade
<!-- Check for existence -->
@if($post->image)
    <img src="{{ $post->image }}">
@else
    <img src="/assets/placeholder.jpg">
@endif

<!-- Check for empty collections -->
@if($posts->count() > 0)
    @foreach($posts as $post)
        <!-- Content -->
    @endforeach
@else
    <p class="text-gray-500">No se encontraron resultados.</p>
@endif
```

---

## Best Practices

1. **Keep controllers thin:** Move complex logic to models or service classes
2. **Use scope methods:** For filtering queries (e.g., `Post::published()`)
3. **Avoid N+1 queries:** Use eager loading (`with()`) in controllers
4. **Component reusability:** Create small, focused components
5. **Accessibility:** Use semantic HTML and ARIA attributes
6. **Responsive design:** Use Tailwind's responsive prefixes (`md:`, `lg:`)
7. **Security:** Always escape output (Blade does this by default with `{{ }}`)
8. **Performance:** Use pagination for large datasets
9. **SEO:** Use server-side filtering for better indexing
10. **Testing:** Write feature tests for each page migration

---

## Migration Checklist for Each Page

- [ ] Controller returns `view()` instead of `Inertia::render()`
- [ ] Route added to `config/migration.php` migrated_routes
- [ ] Blade view created in appropriate directory
- [ ] Components extracted for reusability
- [ ] Alpine.js used for interactivity
- [ ] Swiper.js used for carousels (not Slick)
- [ ] Pagination implemented with `<x-pagination>`
- [ ] Filters work and preserve pagination
- [ ] Shared data is accessible
- [ ] Images and media load correctly
- [ ] Responsive design tested
- [ ] Tests updated and passing
- [ ] Inertia route removed after confirming Blade works

---

**Last Updated:** 2025-11-29
