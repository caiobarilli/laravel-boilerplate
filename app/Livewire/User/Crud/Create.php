<?php

namespace App\Livewire\User\Crud;

use App\Http\Requests\UserRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public User $user;

    public $users;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $openModal = false;

    protected $listeners = ['onView'];

    public function onView()
    {
        $this->openModal();
    }

    public function store()
    {
        $rules = (new UserRequest)->rules();
        $this->validate($rules);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ]);

        $team = Team::findById(1);

        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($user->email),
            ['role' => 'user']
        );

        $user->switchTeam($team);

        $this->success('Usuário criado com sucesso!');

        $this->dispatch('pg:eventRefresh-UserTable');

        $this->closeModal();

    }

    public function openModal()
    {
        $this->openModal = true;
    }

    public function closeModal()
    {
        $this->openModal = false;

        $this->resetErrorBag();

        $this->resetInputFields();

        $this->dispatch('$refresh')->self();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('users.create');
    }
}
