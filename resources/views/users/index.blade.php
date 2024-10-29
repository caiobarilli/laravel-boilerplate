<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @if ($user->hasTeamPermission($user->currentTeam, 'user:create'))
            <livewire:user.crud.create />
        @endif

        <livewire:user.user-table />

        <livewire:user.crud.view />

        <livewire:user.crud.edit />

        <livewire:user.crud.delete />
    </div>
</div>
