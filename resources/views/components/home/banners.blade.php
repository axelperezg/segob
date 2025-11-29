@props(['banners'])

<section class="py-12 -mx-4">
    <div class="container px-16 mx-auto">
        <h2 class="mb-8 text-3xl font-bold text-center">Banner</h2>

        @if($banners && count($banners) > 0)
            <div class="banner-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide px-2">
                            <a href="{{ $banner->external_url }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $banner->getFirstMediaUrl('image') }}" 
                                     alt="{{ $banner->title }}" 
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
            <div class="py-8 text-center text-gray-500">
                No hay banners disponibles en este momento.
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.banner-slider')) {
            new Swiper('.banner-slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                speed: 500,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.banner-slider .swiper-button-next',
                    prevEl: '.banner-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.banner-slider .swiper-pagination',
                    clickable: true,
                },
            });
        }
    });
</script>
@endpush
