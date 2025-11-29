@props(['dependencies'])

<section class="py-12 -mx-4">
    <div class="container px-16 mx-auto">
        <a href="{{ route('segob-news.index') }}" 
           class="block mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Segob
        </a>
        
        @if($dependencies && count($dependencies) > 0)
            <div class="dependencies-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($dependencies as $dependency)
                        <div class="swiper-slide px-2">
                            <a href="{{ route('dependencies.show', $dependency->slug) }}" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <img src="{{ $dependency->getFirstMediaUrl('image') }}" 
                                     alt="{{ $dependency->name }}" 
                                     class="w-full rounded-lg" />
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <div class="text-center text-gray-500 py-8">
                No hay dependencias disponibles en este momento.
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.dependencies-slider')) {
            new Swiper('.dependencies-slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                speed: 500,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.dependencies-slider .swiper-button-next',
                    prevEl: '.dependencies-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.dependencies-slider .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            });
        }
    });
</script>
@endpush

