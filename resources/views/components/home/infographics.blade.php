@props(['infographics'])

<section class="py-12 -mx-4">
    <div class="container px-16 mx-auto">
        <a href="{{ route('documents.index') }}" 
           class="block mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Infografías
        </a>
        
        @if($infographics && count($infographics) > 0)
            <div class="infographics-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($infographics as $infographic)
                        <div class="swiper-slide">
                            <x-home.infographic-item :document="$infographic" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <div class="text-center text-gray-500 py-8">
                No hay infografías disponibles en este momento.
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.infographics-slider')) {
            new Swiper('.infographics-slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                speed: 500,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.infographics-slider .swiper-button-next',
                    prevEl: '.infographics-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.infographics-slider .swiper-pagination',
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

