<div>

    <x-filament::dropdown
            maxHeight="250px"
            placement="left-start"
            teleport="true"
    >
        <x-slot name="trigger">
            <div class="p-2 flex items-center justify-start gap-2">
                <x-filament::icon
                        icon="heroicon-c-chevron-left"
                        class="mx-1 h-5 w-5 text-gray-500 dark:text-gray-400"
                />
                {{ __('Current Team') }}
            </div>
        </x-slot>

        <x-filament::dropdown.header
                class="font-semibold"
                color="gray"
                icon="heroicon-c-language"
        >
            Select Team
        </x-filament::dropdown.header>


        <x-filament::dropdown.list>
            @foreach(auth()->user()->allTeams() as $team)
                <x-filament::dropdown.list.item
                        :color="auth()->user()->isCurrentTeam($team) ? 'primary' : null"
                        icon="heroicon-m-chevron-right"
                        tag="{{ auth()->user()->isCurrentTeam($team) ? 'button' : 'a' }}"
                >
                    {{ $team->name }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>