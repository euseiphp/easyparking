<div>

    <x-layout.title>
        Atendimentos
    </x-layout.title>

    <x-table class="mt-4" :items="$attendances">
        <x-table.head>
            <x-table.tr>
                <x-table.th column="id" :sort="$sort" :direction="$direction" label="#" />
                <x-table.th column="status" :sort="$sort" :direction="$direction" label="Status" />
                <x-table.th column="name" :sort="$sort" :direction="$direction" label="Cliente" />
                <x-table.th label="Carro" />
                <x-table.th column="spaces" :sort="$sort" :direction="$direction" label="Estacionamento" />
                <x-table.th label="Serviço" />
                <x-table.th label="Preço" />
                <x-table.th column="created_at" :sort="$sort" :direction="$direction" label="Criado" />
                <x-table.th column="updated_at" :sort="$sort" :direction="$direction" label="Atualizado" />
                <x-table.th column="finished_at" :sort="$sort" :direction="$direction" label="Finalizado" />
            </x-table.tr>
        </x-table.head>
        <x-table.body>
            @php /** @var \App\Models\Attendance $attendance */ @endphp
            @forelse ($attendances as $attendance)
                <x-table.tr>
                    <x-table.td>{{ $attendance->id }}</x-table.td>
                    <x-table.td><x-badge :type="$attendance->status->badge()" :label="$attendance->status->translate()" /></x-table.td>
                    <x-table.td>{{ $attendance->user?->name ?? '-/-' }}</x-table.td>
                    <x-table.td>{{ $attendance->car?->identification }}</x-table.td>
                    <x-table.td>{{ $attendance->parking->name }}</x-table.td>
                    <x-table.td><x-badge type="primary" :label="$attendance->service?->name ?? 'Avulso'" /></x-table.td>
                    <x-table.td>R$ {{ price($attendance->price) }}</x-table.td>
                    <x-table.td>{{ $attendance->created_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>{{ $attendance->updated_at->format('d/m/Y H:i') }}</x-table.td>
                    <x-table.td>{{ $attendance->finished_at?->format('d/m/Y H:i') ?? '-/-' }}</x-table.td>
                </x-table.tr>
            @empty
                <x-table.empty/>
            @endforelse
        </x-table.body>
    </x-table>

</div>