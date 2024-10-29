<?php

namespace App\Livewire\User;

use App\Models\User;
use Auth;
use Livewire\Component;

class Users extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('users.index')
            ->layout('layouts.app');
    }
}
