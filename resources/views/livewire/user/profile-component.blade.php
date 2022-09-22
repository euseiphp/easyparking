<div x-data>

    <x-layout.title title="Perfil" />

    <x-card class="space-y-4">
        <x-slot:body>
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2">
                    <x-form.input label="Nome" wire:model.defer="name" type="text" />
                </div>
                <div class="col-span-2">
                    <x-form.input label="E-mail" wire:model.defer="email" type="text" disabled />
                </div>
                <div class="col-span-2">
                    <x-form.input label="Telefone" wire:model.defer="phone" type="text" x-mask:dynamic="(() => $input.length <= 14 ? '(99) 9999-9999' : '(99) 99999-9999')" />
                </div>
            </div>
        </x-slot:body>

        <x-slot:footer>
            <x-button wire:click.prevent="update">
                Salvar
            </x-button>
        </x-slot:footer>
    </x-card>

</div>
