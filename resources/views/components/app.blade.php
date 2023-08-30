<x-app-layout>
    @if (request()->is('libros'))
        @livewire('libros-component')
    @elseif (request()->is('prestamos'))
        @livewire('prestamos-component')
    @elseif (request()->is('users'))
        @livewire('user-component')
    @endif
</x-app-layout>
