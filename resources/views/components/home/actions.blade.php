@props(['actions'])

<section class="py-12 -mx-4 bg-gold">
    <div class="container px-16 mx-auto">
        <h2 class="mb-8 text-3xl font-medium text-center text-white">Acciones</h2>
        
        @if($actions && count($actions) > 0)
            <div class="actions-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($actions as $action)
                        <div class="swiper-slide px-2">
                            <a href="{{ route('actions.show', $action->slug) }}" target="_blank">
                                <img src="{{ $action->getFirstMediaUrl('image') }}" 
                                     alt="{{ $action->name }}" 
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
            <div class="py-8 text-center">
                <p class="text-xl text-white">No hay acciones disponibles en este momento.</p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.actions-slider')) {
            new Swiper('.actions-slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                speed: 500,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.actions-slider .swiper-button-next',
                    prevEl: '.actions-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.actions-slider .swiper-pagination',
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

