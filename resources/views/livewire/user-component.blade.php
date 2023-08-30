<div>
    @if ($user_logueado)
            <x-data-source :headers="$headers" :data="$data" :actionEdit="false" :prest="false" >

    </x-data-source>
    @else
    <h1>No tienes permiso para ver los usuarios</h1>
    @endif
</div>
