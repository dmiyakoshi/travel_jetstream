<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                @if (!empty($prefix))
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route($prefix . 'dashboard') }}" :active="request()->routeIs($prefix . 'dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
            </div>
            @endif

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (!empty($prefix))
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $prefix == 'user')
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ $user->name }}
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        メニュー
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            @if ($prefix == null)
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    <x-dropdown-link href="{{ route('welcome') }}">
                                        {{ 'アカウント登録はこちら' }}
                                    </x-dropdown-link>
                                </div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    <x-dropdown-link href="{{ route('user.login') }}">
                                        {{ 'ユーザーアカウントログイン' }}
                                    </x-dropdown-link>
                                </div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    <x-dropdown-link href="{{ route('company.login') }}">
                                        {{ '企業アカウントログイン' }}
                                    </x-dropdown-link>
                                </div>
                            @endif

                            @if (Auth::guard('companies')->check())
                            <x-dropdown-link href="{{ route('hotels.create') }}">
                                {{ 'ホテル登録' }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('plans.create') }}">
                                {{ '掲載プラン登録' }}
                            </x-dropdown-link>
                        @endif
                

                            @if (!empty($prefix))
                                <x-dropdown-link href="{{ route($prefix . 'profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route($prefix . 'logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route($prefix . 'logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        メニュー
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if (!empty($prefix))
        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route($prefix . 'dashboard') }}" :active="request()->routeIs($prefix . 'dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>
        @else
            {{-- <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('welcome') }}">
            アカウント登録
        </x-responsive-nav-link>
    </div> --}}
    @endif

    <!-- Responsive Settings Options -->
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $prefix == 'user')
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                {{-- <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                        alt="{{ $user->name }}" />
                </div> --}}

                <div>
                    <div class="font-medium text-base text-gray-800">{{ $user->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                </div>
            </div>
    @endif

    <div class="mt-3 space-y-1">
        <!-- Account Management -->
        @if (!empty($prefix))
            <x-responsive-nav-link href="{{ route($prefix . 'profile.show') }}" :active="request()->routeIs($prefix . 'profile.show')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
        @endif


        @if (Auth::guard('companies')->check())
            <x-dropdown-link href="{{ route('hotels.create') }}">
                {{ 'ホテル登録' }}
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('plans.create') }}">
                {{ '掲載プラン登録' }}
            </x-dropdown-link>
        @endif

        <!-- Authentication -->
        @if (!empty($prefix))
            <form method="POST" action="{{ route($prefix .'logout') }}" x-data>
                @csrf
                <x-responsive-nav-link href="{{ route($prefix .'logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        @endif
    </div>
</nav>
