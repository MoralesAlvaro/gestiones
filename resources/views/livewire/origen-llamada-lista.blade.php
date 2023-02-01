<div class="py-12">
    <x-alerts></x-alerts>
    <div class=" mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 mt-4">
                <x-jet-button class=" active:bg-gray-900" wire:click="showNew()" wire:key="new">
                    <a>{{ __('Nuevo Origen') }}</a>
                </x-jet-button>
                <x-search></x-search>
            </div>
            <div class="p-5">
                <table class="min-w-full table-auto ">
                    <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Origen Llamada</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Fecha de Registro</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Fecha de Editado</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @foreach ($data as $item)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $item->origen_llamada }}</span>
                                </td>
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ date_format($item->created_at, 'D M Y, g:m a') }}</span>
                                </td>
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ date_format($item->updated_at, 'D M Y, g:m a') }}</span>
                                </td>
                                <td>
                                    <div class="grid grid-cols-2 items-center">
                                        <div wire:click='showDeleteModal({{ $item->id }})'>
                                            <x-button-action-delete title="Eliminar" />
                                        </div>
                                        <div wire:click="editModal({{ $item->id }})">
                                            <x-button-action-edit title="Editar" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-white uppercase border-none  sm:grid-cols-9">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Nuevo Origen --}}
    <form wire:submit.prevent="actionSaveModal" class="w-full " enctype="multipart/form-data">
        <x-jet-dialog-modal wire:model.defer="new_modal" maxWidth="5xl">
            <x-slot name="title">
                <div class="my-2 py-2 px-2 bg-white rounded-lg shadow-sm space-y-6">
                    <div class="">
                        <p class="text-xl text-azul-500 font-sans md:text-2xl text-center"><strong>Ingresar
                                Gestion</strong></p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content" class="">
                <div class="px-1 bg-white rounded-lg shadow-sm">
                    <div class="my-3 py-2">
                        <div class="grid md:w-auto">

                            {{-- Inputs --}}
                            <div>
                                <div class="grid divide-y divide-none md:w-auto">

                                    <!-- Origen Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="origen_llamada" value="{{ __('Origen Llamada') }}" />
                                        <x-jet-input id="origen_llamada" class="block mt-1 w-full" type="text"
                                            name="origen_llamada" autocomplete="origen_llamada" wire:model.defer="origen_llamada"
                                            placeholder="Ej: José Antonio" />
                                        <x-jet-input-error for='origen_llamada' />
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 place-content-end mt-4 mb-4 justify-items-center">
                            <x-jet-secondary-button wire:click="$toggle('new_modal')" wire:loading.attr="disabled"
                                type="button">
                                Cancelar
                            </x-jet-secondary-button>
                            <x-jet-button wire:loading.attr="disabled" type="submit">Registrar</x-jet-button>
                        </div>

                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <p class="font-simbol mb-4 mt-3 pt-3 text-xs text-blue-900 md:m-0 md:p-0">
                </p>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

    {{-- Modal Elimina --}}
    <form class="w-full ">
        <x-jet-dialog-modal wire:model.defer="show_delete" maxWidth="xl">
            <x-slot name="title">
                <div class="my-2 py-2 px-2 bg-white rounded-lg shadow-sm space-y-6">
                    <div class="">
                        <p class="text-xl text-azul-500 font-sans md:text-2xl text-center"><strong>Eliminar
                                Registro</strong></p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="pl-4 pr-4  bg-white rounded-lg shadow-sm">
                    <div class="my-3 py-2">
                        <p class="font-bold text-center text-red-500">¿Está seguro de que desea eliminar este registro?
                        </p>
                        <span class="text-sm font-light">
                            <br>
                            Una vez que se elimine el registro, todos sus recursos y datos se eliminarán de forma
                            permanente.
                        </span>
                    </div>
                    <hr>
                    <div class="grid grid-cols-2 gap-4 place-content-end mt-4 pb-4 justify-items-center">
                        <x-jet-secondary-button wire:click="$toggle('show_delete')" wire:loading.attr="disabled"
                            class="">
                            Cancelar
                        </x-jet-secondary-button>
                        <x-jet-danger-button wire:click="actionDelete()" type="button">
                            Eliminar</x-jet-danger-button>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <p class="font-simbol mb-4 mt-3 pt-3 text-xs text-blue-900 md:m-0 md:p-0">
                </p>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

    {{-- Editar Origen --}}
    <form wire:submit.prevent="actionUpdateModal" class="w-full " enctype="multipart/form-data">
        <x-jet-dialog-modal wire:model.defer="show_edit" maxWidth="5xl">
            <x-slot name="title">
                <div class="my-2 py-2 px-2 bg-white rounded-lg shadow-sm space-y-6">
                    <div class="">
                        <p class="text-xl text-azul-500 font-sans md:text-2xl text-center"><strong>Ingresar
                                Gestion</strong></p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content" class="">
                <div class="px-1 bg-white rounded-lg shadow-sm">
                    <div class="my-3 py-2">
                        <div class="grid md:w-auto">

                            {{-- Inputs --}}
                            <div>
                                <div class="grid divide-y divide-none md:w-auto">

                                    <!-- Origen Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="origen_llamada" value="{{ __('Origen Llamada') }}" />
                                        <x-jet-input id="origen_llamada" class="block mt-1 w-full" type="text"
                                            name="origen_llamada" autocomplete="origen_llamada" wire:model.defer="origen_llamada"
                                            placeholder="Ej: José Antonio" />
                                        <x-jet-input-error for='origen_llamada' />
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 place-content-end mt-4 mb-4 justify-items-center">
                            <x-jet-secondary-button wire:click="$toggle('show_edit')" wire:loading.attr="disabled"
                                type="button">
                                Cancelar
                            </x-jet-secondary-button>
                            <x-jet-button wire:loading.attr="disabled" type="submit">Registrar</x-jet-button>
                        </div>

                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <p class="font-simbol mb-4 mt-3 pt-3 text-xs text-blue-900 md:m-0 md:p-0">
                </p>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

</div>
