<?php

namespace App\Livewire\User\Crud;

use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public User $user;

    public $name;

    public $email;

    public $openModal = false;

    protected $listeners = ['onView'];

    public function onView(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;

        $this->email = $user->email;

        $this->openModal();
    }

    public function render()
    {
        return view('users.view');
    }

    public function openModal()
    {
        $this->openModal = true;
    }

    public function closeModal()
    {
        $this->openModal = false;

        $this->dispatch('$refresh')->self();

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';

        $this->email = '';
    }
}
