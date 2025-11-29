@props(['dependencies'])

<div class="pt-10 my-12">
    <h2 class="my-10 text-3xl font-bold text-center">Segob</h2>

    @if(count($dependencies) === 0)
        <div class="py-8 text-center">
            <p class="text-xl text-gray-600">No hay dependencias disponibles en este momento.</p>
        </div>
    @else
        <div class="px-2 dependencies-swiper">
            <div class="swiper-wrapper">
                @foreach($dependencies as $dependency)
                    <div class="swiper-slide px-2">
                        <a
                            href="{{ route('dependencies.show', $dependency->slug) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <div class="flex flex-col items-center">
                                <div class="overflow-hidden">
                                    <img
                                        src="{{ $dependency->image }}"
                                        alt="{{ $dependency->name }}"
                                        class="object-contain w-full h-full"
                                    />
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        @push('scripts')
        <script type="module">
            import Swiper from 'swiper';
            import { Navigation, Pagination, Autoplay } from 'swiper/modules';

            new Swiper('.dependencies-swiper', {
                modules: [Navigation, Pagination, Autoplay],
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        </script>
        @endpush
    @endif
</div>
