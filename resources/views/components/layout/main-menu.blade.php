<nav class="-mx-4 border-burgundy md:bg-gold md:border-t-[.6rem] md:border-burgundy lg:sticky lg:top-[55px] z-10" x-data="{ isMenuOpen: false }">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex flex-wrap items-center justify-between">
            <ul
                class="flex flex-col flex-wrap w-full md:gap-x-4 md:flex-row md:space-y-0"
                :class="{ 'hidden md:flex': !isMenuOpen, 'block': isMenuOpen }"
            >
                @foreach($mainMenu as $item)
                    <li
                        class="relative py-2 md:py-4 text-[.8rem] lg:text-base"
                        x-data="{ isOpen: false }"
                        @mouseenter="isOpen = true"
                        @mouseleave="isOpen = false"
                    >
                        <a
                            href="{{ $item['url'] }}"
                            class="flex items-center gap-2 font-medium transition-colors md:text-white"
                        >
                            {{ $item['name'] }}
                            @if(isset($item['submenu']))
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 ml-1 transition-transform"
                                    :class="{ 'rotate-180': isOpen }"
                                    viewBox="0 0 512 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M239 401c9.4 9.4 24.6 9.4 33.9 0L465 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-175 175L81 175c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9L239 401z"
                                    />
                                </svg>
            @endif
                        </a>
                        @if(isset($item['submenu']))
                            <ul
                                class="left-0 mt-2 py-2 md:w-[20rem] bg-white border border-gray-200 rounded shadow-lg md:absolute"
                                :class="{ 'hidden': !isOpen, 'block': isOpen }"
                            >
                                @foreach($item['submenu'] as $subitem)
                                    <li>
                                        <a
                                            href="{{ $subitem['url'] }}"
                                            class="block px-4 py-2 text-gray-700 text-md hover:bg-gray-100"
                                        >
                                            {{ $subitem['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            <button
                @click="isMenuOpen = !isMenuOpen"
                class="w-full px-4 py-2 text-white rounded md:hidden bg-burgundy"
            >
                Menú
            </button>
        </div>
    </div>
</nav>
