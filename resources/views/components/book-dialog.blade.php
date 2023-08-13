<div x-show="isOpen" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:w-11/12">
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

                        <form wire:submit.prevent="addBook" class="overflow-auto">
                            <div class="space-y-12">
                                <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Titulo
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" name="first-name" id="first-name"
                                                wire:model="libro.titulo" autocomplete="given-name"
                                                style="min-width:300px"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="last-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Autor</label>
                                        <div class="mt-2">
                                            <input type="text" name="last-name" id="last-name"
                                                wire:model="libro.autor" autocomplete="family-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="anio"
                                            class="block text-sm font-medium leading-6 text-gray-900">Año
                                            publicación</label>
                                        <div class="mt-2">
                                            <input type="number" name="anio" id="anio"
                                                wire:model="libro.anio_publicacion" autocomplete="example: 2023"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="genero"
                                            class="block text-sm font-medium leading-6 text-gray-900">Género</label>
                                        <div class="mt-2">
                                            <input type="text" name="genero" id="genero"
                                                wire:model="libro.genero" autocomplete="address-level1"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="cantidad"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cantidad</label>
                                        <div class="mt-2">
                                            <input type="number" name="cantidad" id="cantidad"
                                                wire:model="libro.disponible" autocomplete="Cantidad"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                </div>
                            </div>

                        </form>

                    </body>
                </div>
            </div>
        </div>
    </div>
</div>
