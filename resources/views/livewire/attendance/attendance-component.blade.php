<div x-data="{
        view : @entangle('view')
    }">

    <x-layout.title>
        Atendimentos
    </x-layout.title>

    <x-table class="mt-4" :items="$attendances">
        <x-table.head>
            <x-table.tr>
                <x-table.th column="id" :sort="$sort" :direction="$direction" label="#" />
                <x-table.th column="status" :sort="$sort" :direction="$direction" label="Status" />
                <x-table.th label="Carro (Placa)" />
                <x-table.th column="parking_id" :sort="$sort" :direction="$direction" label="Estacionamento" />
                <x-table.th column="created_at" :sort="$sort" :direction="$direction" label="Criado" />
                <x-table.th column="updated_at" :sort="$sort" :direction="$direction" label="Atualizado" />
                <x-table.th column="finished_at" :sort="$sort" :direction="$direction" label="Finalizado" />
                <x-table.th></x-table.th>
            </x-table.tr>
        </x-table.head>
        <x-table.body>
            @php /** @var \App\Models\Attendance $attendance */ @endphp
            @forelse ($attendances as $attendance)
                <x-table.tr>
                    <x-table.td>{{ $attendance->id }}</x-table.td>
                    <x-table.td><x-badge :type="$attendance->status->badge()" :label="$attendance->status->translate()" /></x-table.td>
                    <x-table.td>{{ $attendance->car?->identification }}</x-table.td>
                    <x-table.td>{{ $attendance->parking->name }}</x-table.td>
                    <x-table.td>{{ $attendance->created_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>{{ $attendance->updated_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>{{ $attendance->finished_at?->format('d/m/Y H:i') ?? '-/-' }}</x-table.td>
                    <x-table.td>
                        <x-button small primary wire:click="append({{ $attendance }})">
                            <x-svg.pencil class="h-4 w-4" />
                        </x-button>
                        <x-button small danger wire:click="confirmingBeforeDestroy({{ $attendance->id }})">
                            <x-svg.trash class="h-4 w-4" />
                        </x-button>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.empty/>
            @endforelse
        </x-table.body>
    </x-table>

    @if(($id = data_get($edit, 'id')) !== null)
        <x-modal trigger="view" title="Atendimento: #{{ $id }}" :dismiss="true">
            <div class="mt-6 grid grid-cols-1 gap-y-5 gap-x-4 sm:grid-cols-6">

            </div>
            <x-slot:footer>
                <x-button success wire:click="finish({{ $id }})">
                    Concluir
                </x-button>
            </x-slot:footer>
        </x-modal>
    @endif

</div>