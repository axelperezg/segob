@props(['photos', 'videos'])

<section class="py-12 -mx-4 bg-gold-lighter">
    <div class="container px-16 mx-auto">
        <a href="{{ route('photo-galleries.index') }}" 
           class="block mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Fotos
        </a>
        
        @if(!$photos || count($photos) === 0)
            <div class="py-8 text-center">
                <p class="text-xl text-gray-700">No hay fotos disponibles en este momento.</p>
            </div>
        @else
            <div class="photos-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($photos as $photo)
                        <div class="swiper-slide">
                            <x-home.photo-gallery-item :photo="$photo" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        @endif

        <a href="{{ route('videos.index') }}" 
           class="block mt-24 mb-8 text-3xl font-bold text-center hover:text-gold transition-colors hover:underline hover:cursor-pointer">
            Videos
        </a>
        
        @if(!$videos || count($videos) === 0)
            <div class="py-8 text-center">
                <p class="text-xl text-gray-700">No hay videos disponibles en este momento.</p>
            </div>
        @else
            <div class="videos-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($videos as $video)
                        <div class="swiper-slide">
                            <x-home.video-item :video="$video" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiperConfig = {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 500,
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
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
        };

        if (document.querySelector('.photos-slider')) {
            new Swiper('.photos-slider', {
                ...swiperConfig,
                navigation: {
                    nextEl: '.photos-slider .swiper-button-next',
                    prevEl: '.photos-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.photos-slider .swiper-pagination',
                    clickable: true,
                },
            });
        }

        if (document.querySelector('.videos-slider')) {
            new Swiper('.videos-slider', {
                ...swiperConfig,
                navigation: {
                    nextEl: '.videos-slider .swiper-button-next',
                    prevEl: '.videos-slider .swiper-button-prev',
                },
                pagination: {
                    el: '.videos-slider .swiper-pagination',
                    clickable: true,
                },
            });
        }
    });
</script>
@endpush

