<nav x-data="{ open: false, reviewOpen: false }" class="fixed top-0 w-full bg-white z-50 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('photos/logo telyucoffee fix.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
                <!-- Navigation Links -->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-red-700">
                    {{ __('Home') }}
                </x-nav-link>
                @if (auth()->check() && auth()->user()->email != 'admin@gmail.com')
                    <x-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')" class="text-gray-700 hover:text-red-700">
                        {{ __('Menu') }}
                    </x-nav-link>
                @endif

                @if (auth()->check() && auth()->user()->email == 'admin@gmail.com')
                    <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('products.index')" class="text-gray-700 hover:text-red-700">
                        {{ __('Manage Menu') }}
                    </x-nav-link>
                @endif

                @if (auth()->check() && auth()->user()->email != 'admin@gmail.com')
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('products.index')" class="text-gray-700 hover:text-red-700">
                        {{ __('Cart') }}
                    </x-nav-link>
                @endif

                <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')" class="text-gray-700 hover:text-red-700">
                    {{ __('History') }}
                </x-nav-link>

                <!-- Review Menu -->
                @if(auth()->check() && auth()->user()->email != 'admin@gmail.com')
                    <x-dropdown align="center" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                {{ __('Review') }}
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('reviews.yourReview')" :active="request()->routeIs('reviews.yourReview')" class="text-gray-500 hover:bg-red-700 hover:text-white">
                                {{ __('Your Review') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')" class="text-gray-500 hover:bg-red-700 hover:text-white">
                                {{ __('All Reviews') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')" class="text-gray-700 hover:text-red-700">
                        {{ __('All Reviews') }}
                    </x-nav-link>
                @endif

                <!-- Gallery Menu -->
                @if(auth()->check() && auth()->user()->email != 'admin@gmail.com')
                    <x-dropdown align="center" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                {{ __('Gallery') }}
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('galleries.your')" :active="request()->routeIs('galleries.your')" class="text-gray-500 hover:bg-red-700 hover:text-white">
                                {{ __('Your Gallery') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('galleries.index')" :active="request()->routeIs('galleries.index')" class="text-gray-500 hover:bg-red-700 hover:text-white">
                                {{ __('All Galleries') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.index')" class="text-gray-700 hover:text-red-700">
                        {{ __('All Galleries') }}
                    </x-nav-link>
                @endif

                <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.index')" class="text-gray-700 hover:text-red-700">
                    {{ __('News') }}
                </x-nav-link>

                <x-nav-link :href="route('donation.index')" :active="request()->routeIs('donation.index')" class="text-gray-700 hover:text-red-700">
                    {{ __('Donation') }}
                </x-nav-link>

            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center space-x-4">
                <!-- User Name Dropdown with Profile Picture on the Right -->
                @if(Auth::check())
                    <x-dropdown align="center" width="48" class="bg-white">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-100 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-2">
                                    <img src="{{ asset('photos/avatar.png') }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full object-cover">
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-500 hover:bg-red-700 hover:text-white">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-500 hover:bg-red-700 hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
