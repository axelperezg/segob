<div class="-mx-4 bg-center bg-cover" style="background-image: url('/assets/bg-header.jpg')">
    <div class="max-w-6xl px-4 py-8 mx-auto md:flex md:justify-between md:items-center">
        <h1 class="flex flex-col text-4xl font-bold text-gold">
            <a href="/">
                <figure>
                    <img class="h-[5rem]" src="/storage/{{ $appSettings['logo'] }}" alt="Segob Noticias" />
                </figure>
            </a>
        </h1>
        <div class="flex items-center">
            <div class="hidden pr-6 md:block">
                <div class="flex items-center justify-center gap-4">
                    @foreach($appSettings['social_networks'] as $social)
                        <a href="{{ $social['url'] }}" target="_blank">
                            <i class="text-3xl text-burgundy fa-brands fa-{{ $social['network'] === 'twitter' ? 'x-twitter' : $social['network'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <figure class="hidden md:inline-block w-[50px] -my-8 lg:w-[60px]">
                <img class="-mb-[2px]" src="/assets/grecaGuinda.png" alt="" />
            </figure>
        </div>
    </div>
</div>
