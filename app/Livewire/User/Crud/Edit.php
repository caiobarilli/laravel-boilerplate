<?php

namespace App\Livewire\User\Crud;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;

    public User $user;

    public $users;

    public $user_Id;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $openModal = false;

    protected $listeners = ['onView'];

    public function onView(User $user)
    {
        $this->user = $user;

        $this->user_Id = $user->id;

        $this->name = $user->name;

        $this->email = $user->email;

        $this->password = $user->password;

        $this->password_confirmation = $user->password;

        $this->openModal();
    }

    public function onEdit()
    {
        $rules = (new UserRequest)->rules();

        $rules['email'] = 'required|email|max:255|unique:users,email,'.$this->user->id;

        $validatedData = $this->validate($rules);

        $this->user->update($validatedData);

        $this->success('Usuário atualizado com sucesso!');

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
        return view('users.edit');
    }
}
