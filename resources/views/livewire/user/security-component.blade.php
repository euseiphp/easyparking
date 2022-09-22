<div x-data>

    <x-layout.title title="Senha" />

    <x-card class="space-y-4">
        <x-slot:body>
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2">
                    <x-form.input label="Senha Atual" wire:model.defer="current" type="password" />
                </div>
                <div class="col-span-2">
                    <x-form.input label="Nova Senha" wire:model.defer="password" type="password" />
                </div>
                <div class="col-span-2">
                    <x-form.input label="Confirme a Nova Senha" wire:model.defer="password_confirmation" type="password" />
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
