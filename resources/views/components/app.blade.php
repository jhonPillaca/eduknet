<x-app-layout>
    @if (request()->is('libros'))
        @livewire('libros-component')
    @elseif (request()->is('prestamos'))
        @livewire('prestamos-component')
    @else
        @livewire('prestamos-component')
    @endif
</x-app-layout>
