<?php

namespace App\Livewire\User\Crud;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Mary\Traits\Toast;

class Delete extends Component
{
    use Toast;

    public User $user;

    public $openModal = false;

    protected $listeners = ['onView'];

    public function onView(User $user)
    {
        $this->user = $user;

        $this->openModal();
    }

    public function onDelete(Request $request)
    {
        $this->user->delete();

        $this->success('Usuário removido com sucesso!');

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

        $this->dispatch('$refresh')->self();
    }

    public function render()
    {
        return view('users.delete');
    }
}
