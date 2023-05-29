<div>
    <div class="bg-white">
        <div class="form-group p-4">
            <x-label for="name" value="Usuário do Github" />
            <x-input wire:keydown.enter="searchGithub" id="name" wire:model="user" type="text" class="w-full mt-1 block" wire:model.defer="createApiTokenForm.name" autofocus />
            <x-button wire:click="searchGithub" class="mt-5 w-full">Buscar</x-button>
        </div>
    </div>
</div>
