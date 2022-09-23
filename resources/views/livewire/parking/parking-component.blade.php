<div x-data="{
        createModal : @entangle('createModal'),
        editModal : @entangle('editModal'),
    }">

    <x-layout.title>
        Estacionamentos
        <x-button small success @click="createModal = true">
            <x-svg.plus class="h-5 w-5" />
        </x-button>
    </x-layout.title>

    <x-table class="mt-4" :items="$parkings">
        <x-table.head>
            <x-table.tr>
                <x-table.th column="id" :sort="$sort" :direction="$direction" label="#" />
                <x-table.th column="name" :sort="$sort" :direction="$direction" label="Nome" />
                <x-table.th column="spaces" :sort="$sort" :direction="$direction" label="Quantidade de Vagas" />
                <x-table.th column="spaces" :sort="$sort" :direction="$direction" label="Criado" />
                <x-table.th column="spaces" :sort="$sort" :direction="$direction" label="Atualizado" />
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-table.head>
        <x-table.body>
            @php /** @var \App\Models\Parking $parking */ @endphp
            @forelse ($parkings as $parking)
                <x-table.tr>
                    <x-table.td>{{ $parking->id }}</x-table.td>
                    <x-table.td>{{ $parking->name }}</x-table.td>
                    <x-table.td>{{ $parking->spaces }}</x-table.td>
                    <x-table.td>{{ $parking->created_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>{{ $parking->updated_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>
                        <x-button small primary>
                            <x-svg.pencil class="h-4 w-4" wire:click="append({{ $parking }})" />
                        </x-button>
                        <x-button small danger wire:click="confirmingBeforeDestroy({{ $parking->id }})">
                            <x-svg.trash class="h-4 w-4" />
                        </x-button>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.empty/>
            @endforelse
        </x-table.body>
    </x-table>

    <x-modal trigger="createModal" title="Criação de Estacionamento" :close="false">
        <div class="mt-6 grid grid-cols-1 gap-y-5 gap-x-4 sm:grid-cols-6">
            <div class="col-span-3">
                <x-form.input label="Nome" wire:model.defer="create.name" type="text" />
            </div>
            <div class="col-span-3">
                <x-form.input label="Vagas" wire:model.defer="create.spaces" type="number" />
            </div>
            <hr class="my-3 col-span-full">
            <div class="col-span-3">
                <x-form.input label="CEP" wire:model.debouce.500ms="postcode" type="text" x-mask="99.999-999" />
            </div>
            <div class="col-span-3">
                <x-form.input label="Número" wire:model.defer="create.number" type="number" />
            </div>
            <div class="col-span-3">
                <x-form.input label="Rua" wire:model="create.street" type="text" disabled />
            </div>
            <div class="col-span-3">
                <x-form.input label="Bairro" wire:model="create.district" type="text" disabled />
            </div>
            <div class="col-span-4">
                <x-form.input label="Cidade" wire:model="create.city" type="text" disabled />
            </div>
            <div class="col-span-2">
                <x-form.input label="Estado" wire:model="create.state" type="text" disabled />
            </div>
        </div>
        <x-slot:footer>
            <x-button-outline secondary @click="createModal = false; $wire.resetPostCode();">
                Fechar
            </x-button-outline>
            <x-button
                wire:click.prevent="create"
                wire:loading.attr="disabled"
                wire:target="create">
                Salvar
            </x-button>
        </x-slot:footer>
    </x-modal>

    @if(($id = data_get($edit, 'id')) !== null)
        <x-modal trigger="editModal" title="Edição de Estacionamento: #{{ $id }}" :close="false">
            <div class="mt-6 grid grid-cols-1 gap-y-5 gap-x-4 sm:grid-cols-6">
                <div class="col-span-3">
                    <x-form.input label="Nome" wire:model.defer="edit.name" type="text" />
                </div>
                <div class="col-span-3">
                    <x-form.input label="Vagas" wire:model.defer="edit.spaces" type="number" />
                </div>
                <hr class="my-3 col-span-full">
                <div class="col-span-3">
                    <x-form.input label="CEP" wire:model.debouce.500ms="postcode" type="text" x-mask="99.999-999" />
                </div>
                <div class="col-span-3">
                    <x-form.input label="Número" wire:model.defer="edit.number" type="number" />
                </div>
                <div class="col-span-3">
                    <x-form.input label="Rua" wire:model="edit.street" type="text" disabled />
                </div>
                <div class="col-span-3">
                    <x-form.input label="Bairro" wire:model="edit.district" type="text" disabled />
                </div>
                <div class="col-span-4">
                    <x-form.input label="Cidade" wire:model="edit.city" type="text" disabled />
                </div>
                <div class="col-span-2">
                    <x-form.input label="Estado" wire:model="edit.state" type="text" disabled />
                </div>
            </div>
            <x-slot:footer>
                <x-button-outline secondary @click="editModal = false; $wire.resetPostCode();">
                    Fechar
                </x-button-outline>
                <x-button
                    wire:click.prevent="edit"
                    wire:loading.attr="disabled"
                    wire:target="edit">
                    Salvar
                </x-button>
            </x-slot:footer>
        </x-modal>
    @endif

</div>