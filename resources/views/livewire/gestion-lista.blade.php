<div class="py-12">
    <x-alerts></x-alerts>
    <div class=" mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 mt-4">
                <x-jet-button class=" active:bg-gray-900" wire:click="showNew()" wire:key="new">
                    <a>{{ __('Nueva Gestión') }}</a>
                </x-jet-button>
                <x-search></x-search>
            </div>
            <div class="p-5">
                <table class="min-w-full table-auto ">
                    <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Nombre</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Telefono</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Gestion</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Tipo</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Origen</span>
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
                                    <span class="text-center ml-2 font-semibold">{{ $item->nombre }}</span>
                                </td>
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $item->telefono }}</span>
                                </td>
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $item->gestion }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-center ml-2 font-semibold">{{ $item->tipoLlamada['tipo_llamada'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-center ml-2 font-semibold">{{ $item->origenLlamada['origen_llamada'] }}</span>
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
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-white uppercase border-none  sm:grid-cols-9">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Nueva Gestion --}}
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
                                    <!-- Tipo Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="tipo_llamada_id" value="{{ __('Tipo Llamada') }}" />
                                        <x-input-select autofocus wire:model="tipo_llamada_id"
                                            class="text-xs block mt-1 h-8 w-full" name="tipo_llamada_id"
                                            id="tipo_llamada_id" utocomplete="tipo_llamada_id">
                                            <option class="text-xs" value="">
                                                Seleccione</option>
                                            @foreach ($tipo_llamadas as $item)
                                                <option class="text-xs" value="{{ $item->id }}">
                                                    {{ $item->tipo_llamada }}</option>
                                            @endforeach
                                        </x-input-select>
                                        <x-jet-input-error for='tipo_llamada_id' />
                                    </div>

                                    <!-- Origen Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="origen_llamada_id" value="{{ __('Tipo Llamada') }}" />
                                        <x-input-select wire:model="origen_llamada_id"
                                            class="text-xs block mt-1 h-8 w-full" name="origen_llamada_id"
                                            id="origen_llamada_id" utocomplete="origen_llamada_id">
                                            <option class="text-xs" value="">
                                                Seleccione</option>
                                            @foreach ($origen_llamadas as $item)
                                                <option class="text-xs" value="{{ $item->id }}">
                                                    {{ $item->origen_llamada }}</option>
                                            @endforeach
                                        </x-input-select>
                                        <x-jet-input-error for='origen_llamada_id' />
                                    </div>

                                    <!-- Nombre -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                                        <x-jet-input id="nombre" class="block mt-1 w-full" type="text"
                                            name="nombre" autocomplete="nombre" wire:model.defer="nombre"
                                            placeholder="Ej: José Antonio" />
                                        <x-jet-input-error for='nombre' />
                                    </div>

                                    <!-- Telefono -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="telefono" value="{{ __('Telefono') }}" />
                                        <x-jet-input id="telefono" class="block mt-1 w-full" type="text"
                                            name="telefono" autocomplete="telefono" wire:model.defer="telefono"
                                            maxlength="9" minlength="9" x-mask="9999-9999" placeholder="9999-9999" />
                                        <x-jet-input-error for='telefono' />
                                    </div>

                                    <!-- Gestion -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="gestion" value="{{ __('Gestion') }}" />
                                        <textarea wire:model="gestion" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingresa la Gestion..."></textarea>
                                        <x-jet-input-error for='gestion' />
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

    {{-- Editar Gestion --}}
    <form wire:submit.prevent="actionUpdateModal" class="w-full " enctype="multipart/form-data">
        <x-jet-dialog-modal wire:model.defer="show_edit" maxWidth="5xl">
            <x-slot name="title">
                <div class="my-2 py-2 px-2 bg-white rounded-lg shadow-sm space-y-6">
                    <div class="">
                        <p class="text-xl text-azul-500 font-sans md:text-2xl text-center"><strong>Editar
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
                                    <!-- Tipo Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="tipo_llamada_id" value="{{ __('Tipo Llamada') }}" />
                                        <x-input-select autofocus wire:model="tipo_llamada_id"
                                            class="text-xs block mt-1 h-8 w-full" name="tipo_llamada_id"
                                            id="tipo_llamada_id" utocomplete="tipo_llamada_id">
                                            @foreach ($tipo_llamadas as $item)
                                            @if ($item->id == $tipo_llamada_id)
                                                <option @selected(true) class="text-xs" value="{{ $item->id }}">
                                                {{ $item->tipo_llamada }}</option>
                                            @else
                                                <option class="text-xs" value="{{ $item->id }}">
                                                {{ $item->tipo_llamada }}</option>
                                            @endif
                                            @endforeach
                                        </x-input-select>
                                        <x-jet-input-error for='tipo_llamada_id' />
                                    </div>

                                    <!-- Origen Llamada -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="origen_llamada_id" value="{{ __('Tipo Llamada') }}" />
                                        <x-input-select wire:model="origen_llamada_id"
                                            class="text-xs block mt-1 h-8 w-full" name="origen_llamada_id"
                                            id="origen_llamada_id" utocomplete="origen_llamada_id" old>
                                            @foreach ($origen_llamadas as $item)
                                            @if ($item->id == $origen_llamada_id)
                                                <option @selected(true) class="text-xs" value="{{ $item->id }}">
                                                    {{ $item->origen_llamada }}</option>
                                            @else
                                            <option class="text-xs" value="{{ $item->id }}">
                                                {{ $item->origen_llamada }}</option>
                                            @endif
                                            @endforeach
                                        </x-input-select>
                                        <x-jet-input-error for='origen_llamada_id' />
                                    </div>

                                    <!-- Nombre -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                                        <x-jet-input id="nombre" class="block mt-1 w-full"
                                            type="text" name="nombre" autocomplete="nombre"
                                            wire:model.defer="nombre" placeholder="Ej: José Antonio" />
                                        <x-jet-input-error for='nombre' />
                                    </div>

                                    <!-- Telefono -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="telefono" value="{{ __('Telefono') }}" />
                                        <x-jet-input id="telefono" class="block mt-1 w-full" type="text"
                                            name="telefono" autocomplete="telefono" wire:model.defer="telefono"
                                            maxlength="9" minlength="9" x-mask="9999-9999"
                                            placeholder="9999-9999" />
                                        <x-jet-input-error for='telefono' />
                                    </div>

                                    <!-- Gestion -->
                                    <div class="center align-items-lg-center px-6 mt-3">
                                        <x-jet-label for="gestion" value="{{ __('Gestion') }}" />
                                        <textarea wire:model="gestion" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingresa la Gestion..."></textarea>
                                        <x-jet-input-error for='gestion' />
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
