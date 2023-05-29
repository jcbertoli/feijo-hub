<div>
    @if(isset($data))
        @if(count($data))
        <p class="font-bold text-lg">Repositórios ({{ count($data) }})</p>
        @endif

        @forelse ($data as $info)
        <div class="repo-info mt-2">
            <div class="text">
                <p>👥 Nome do Repositório: <strong>{{ $info['name'] }} </strong></p>
                <p>📚 Descrição: <strong>{{ $info['description'] ?? 'Nenhuma descrição inserida.' }}</strong></p>
                <p>🕔 Criado em: <strong>{{ \Carbon\Carbon::parse($info['created_at'])->format('d/m/Y H:i:s') }} </strong></p>
                <p>🔄 Atualizado por último: <strong>{{ \Carbon\Carbon::parse($info['updated_at'])->format('d/m/Y H:i:s') }}</strong></p>
                <p>⭐ Quantidade de Estrelas: <strong>{{ $info['stargazers_count'] }}</strong></p>
            </div>
            
            <div class="buttons mt-2">
                <x-button wire:click="createRepository({{ $info['id'] }}, '{{ $info['owner']['login'] }}')">Adicionar</x-button>
                <x-danger-button wire:click="deleteRepository({{ $info['id'] }})">Remover</x-danger-button>
            </div>
            
            <hr class="mt-3">
        </div>
        @empty
            <p class="font-bold text-xl">Usuário não encontrado!</p>
        @endforelse
    
    @else
        <p class="font-bold text-xl">Procura seu ximpa</p>
    @endif
</div>
