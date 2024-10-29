<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);

        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);

        Jetstream::addTeamMembersUsing(AddTeamMember::class);

        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);

        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);

        Jetstream::deleteTeamsUsing(DeleteTeam::class);

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('superadmin', 'Super Administrator', [
            '*', // Wildcard All Permissions
        ])->description('Super Administrator users can perform any action.');

        Jetstream::role('admin', 'Administrator', [
            'create:users',
            'read:users',
            'update:users',
            'delete:users',

            // 'create:teams',
            'read:teams',
            // 'update:teams',
            // 'delete:teams',

        ])->description('Administrator users can perform any action.');

        Jetstream::role('user', 'User', [
            'read:teams',
        ])->description('Users have the ability to update their profile information.');
    }
}
