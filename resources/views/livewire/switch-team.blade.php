<div>
    <x-filament::dropdown
            maxHeight="250px"
            placement="left-start"
            teleport="true"
    >
        <x-slot name="trigger">
            <x-filament::dropdown.header
                    class="font-semibold"
                    color="gray"
                    icon="heroicon-c-user-group"
            >
                {{ auth()->user()->currentTeam->name ?? 'Select Team' }}
            </x-filament::dropdown.header>
        </x-slot>

        <x-filament::dropdown.header
                class="font-medium"
                color="gray"
        >
            {{ __('Select Team') }}
        </x-filament::dropdown.header>


        <x-filament::dropdown.list>
            @foreach(auth()->user()->allTeams() as $team)
                <x-filament::dropdown.list.item
                        :color="auth()->user()->isCurrentTeam($team) ? 'primary' : null"
                        icon="heroicon-m-chevron-right"
                        tag="button"
                        :disabled="auth()->user()->isCurrentTeam($team) ?? false"
                        wire:click="changeTeam({{ $team }})"
                >
                    {{ $team->name }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>