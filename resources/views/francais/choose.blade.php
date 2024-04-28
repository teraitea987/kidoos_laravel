<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Français') }}
        </h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </x-slot>

    <div class="mt-8">
        <h1 class="text-center text-5xl font-bold">Apparier les lettres</h1>
        <div class="flex justify-center mt-10">

            <x-nav-link class="mr-4" :href="route('french_easy')">
                <img src="{{ asset('assets/images/facile.png') }}" alt="" class="w-90 h-90" />
            </x-nav-link>
            <x-nav-link class="mr-4" :href="route('french_medium')">
                <img src="{{ asset('assets/images/moyen.png') }}" alt="" class="w-90 h-90" />
            </x-nav-link>
            <x-nav-link class="mr-4" :href="route('french_hard')">
                <img src="{{ asset('assets/images/difficile.png') }}" alt="" class="w-90 h-90" />
            </x-nav-link>
        </div>
    </div>
</x-app-layout>
