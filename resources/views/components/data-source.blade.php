<div style="min-width:100px; overflow:auto;">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>

                @foreach ($headers as $header)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($datos as $index => $row)
                <tr>
                    @foreach ($row as $column)
                        <td class="px-6 py-4 whitespace-nowrap">{{ $column }}</td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap relative flex items-center gap-2">
                        @if ($actionEdit)
                            <button wire:click="editBook({{ json_encode($row) }})" {{ $user_logueado ? '' : 'disabled' }}
                                class="editButton rounded-md bg-cyan-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg class="w-3.5 h-3.5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                </svg>
                            </button>
                            @if (!$user_logueado)
                                <span class="tooltip">{{ $message }}</span>
                            @endif
                            <button wire:click="$emit('deletBook',{{ json_encode($row[0]) }})"
                                {{ $user_logueado ? '' : 'disabled' }}
                                class=" deletButton rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <svg class="w-3.5 h-3.5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path
                                        d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                </svg>
                            </button>
                            @if (!$user_logueado)
                                <span class="tooltip">{{ $message }}</span>
                            @endif
                        @endif
                        @if ($fin_pres)
                            <button wire:click="updatePrest({{ json_encode($row[0]) }})"
                            {{ !$estado ? '' : 'disabled' }}
                            
                                class="rounded-md bg-cyan-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Devolver
                            </button>
                            <button wire:click="$emit('deletPrest',{{ json_encode($row[0]) }})"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="w-3.5 h-3.5 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                        </svg>
                        </button>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            livewire.on('deletPrest', prestId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: `De finalizar el prestamo N°- ${prestId}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('confirmDeletPrest', prestId);
                        Swal.fire({
                            icon: 'success',
                            title: 'Prestamo finalizado correctamente!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            })

            livewire.on('deletBook', bookId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: `De Eliminar el libro N°- ${bookId}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Libro eliminado correctamente!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            });
        </script>
    @endpush
</div>
