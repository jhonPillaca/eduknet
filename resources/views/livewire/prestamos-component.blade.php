<div>
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div x-data="{ isOpen: @entangle('modalActive') }" class="bg-slate-200 rounded-sm p-2 flex items-center justify-between">
            <h4>List Prestamos</h4>
            <div class="buttons">
                <input type="text" id="search" wire:model="input_search" wire:keydown="filterBooks" autocomplete="off"
                    style="min-width:200px" placeholder="Search Book"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            <button x-on:click="isOpen=true"
                class="bg-cyan-600 rounded-full	text-xl	text-white flex items-center justify-center w-9 h-9">+</button>

            <div x-show="isOpen" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div style="max-width:800px !important;"
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 md:w-11/12 sm:w-11/12">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="bg-slate-200 rounded-sm p-2 flex items-center justify-between sticky tp-0">
                                    <h3>{{ $title }}</h3>
                                    <button x-on:click="isOpen=false" style="min-width:34px"
                                        class="inline-flex w-5 justify-center rounded-md bg-red-600 p-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                        <svg class="w-3.5 h-3.5 text-gray-800 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                        </svg></button>
                                </div>

                                <body>

                                    <form wire:submit.prevent="savePrestm" class="overflow-auto">
                                        @csrf
                                        <div class="space-y-12">
                                            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-6">
                                                <div class="sm:col-span-3">
                                                    <label for="book"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Libro
                                                    </label>
                                                    <div class="mt-2">
                                                        <select id="book" wire:model="book"
                                                            autocomplete="Select Book"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                            <option value="">Seleccione un libro</option>
                                                           
                                                            @foreach ($books as $book)
                                                                <option value="{{ $book->id }}">{{ $book->titulo }}
                                                                </option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="user"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Usuario</label>
                                                    <div class="mt-2">
                                                        <select id="user" wire:model="user"
                                                            autocomplete="Select User"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                            <option>United States</option>
                                                            <option>Canada</option>
                                                            <option>Mexico</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-2 sm:col-start-1">
                                                    <label for="fecha"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Fecha
                                                        Devolución
                                                    </label>
                                                    <div class="mt-2">
                                                        <input type="date" id="fecha" wire:model="fechDev"
                                                                min="{{$this->fechaPermitida}}"
                                                                wire:keydown="validFecha"
                                                            autocomplete="example: 2023"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 {{$this->fechaPermitida?'invalid:border-pink-500 invalid:text-pink-600
                                                            focus:invalid:border-pink-500 focus:invalid:ring-pink-500':''}}"
                                                            >
                                                    </div>
                                                    @if ($this->fechaInValida)
                                                        <div>
                                                        <p style="color:red">{{$this->messageError}}</p>
                                                        </div>
                                                    @endif
                                                   
                                                </div>

                                            </div>

                                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                                <input type="submit"
                                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                    value="Save">
                                            </div>
                                        </div>

                                    </form>

                                </body>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    {{-- <script>
        console.log(@json($this->users));
    </script> --}}
    <x-data-source :headers="$headers" :data="$data">

    </x-data-source>

</div>
