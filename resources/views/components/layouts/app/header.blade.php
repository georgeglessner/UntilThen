<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>
@auth

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('events.index') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="calendar-days" :href="route('events.index')" :current="request()->routeIs('events.index')" wire:navigate>
                {{ __('Upcoming Events') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="plus" :href="route('events.create')" :current="request()->routeIs('events.create')" wire:navigate>
                {{ __('Create New Event') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="archive-box-x-mark" :href="route('events.past')" :current="request()->routeIs('events.past')" wire:navigate>
                {{ __('Past / Inactive Events') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            <flux:profile
                class="cursor-pointer"
                :initials="auth()->user()->initials()" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('events.index') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')">
                <flux:navlist.item icon="calendar-days" :href="route('events.index')" :current="request()->routeIs('events.index')" wire:navigate>
                    {{ __('Upcoming Events') }}
                </flux:navlist.item>

                <flux:navlist.item icon="plus" :href="route('events.create')" :current="request()->routeIs('events.create')" wire:navigate>
                    {{ __('Create New Event') }}
                </flux:navlist.item>

                <flux:navlist.item icon="archive-box-x-mark" :href="route('events.past')" :current="request()->routeIs('events.past')" wire:navigate>
                    {{ __('Past / Inactive Events') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />
    </flux:sidebar>
    @else

    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="/" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0">
                <x-app-logo />
            </a>

            <flux:spacer />
        </flux:header>
        @endauth

        {{ $slot }}

        @fluxScripts
    </body>

</html>