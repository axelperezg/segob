<footer class="py-12 bg-burgundy">
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4">
            <div>
                <img src="/storage/{{ $appSettings['mexico_logo'] }}" alt="Gobierno de México" class="w-[12rem]" />
            </div>
            @foreach($appSettings['footer_links'] as $link)
                <div>
                    <h4 class="mb-4 font-bold text-white">{{ $link['title'] }}</h4>
                    <ul class="space-y-2 text-sm text-white">
                        @foreach($link['links'] as $item)
                            <li>
                                <a href="{{ $item['url'] }}" class="hover:underline">{{ $item['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</footer>
