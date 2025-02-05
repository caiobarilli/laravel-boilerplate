<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        if (Team::where('name', 'Team')->doesntExist()) {
            $team = Team::forceCreate([
                'user_id' => $user->id,
                'name' => 'Team',
                'personal_team' => false,
            ]);

            $user->ownedTeams()->save($team);

            $this->attachTeamRole($team, $user, 'superadmin');

            $user->switchTeam($team);
        }
    }

    /**
     * Attach the "superadmin" role to the user.
     */
    protected function attachTeamRole(Team $team, User $user, string $role): void
    {
        $team->users()->attach($user, ['role' => $role]);
    }
}
