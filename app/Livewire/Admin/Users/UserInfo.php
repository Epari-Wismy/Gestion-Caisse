<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
class UserInfo extends Component
{
    public $userId;
    public $name, $email, $role, $statut, $image;

    protected $listeners = ['viewUser' => 'loadUser'];

    public function loadUser($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->statut = $user->statut;
        $this->image = $user->image; // Assure-toi que c’est le chemin relatif

        $this->dispatch('openInfoModal');
    }
    public function render()
    {
        return view('livewire.admin.users.user-info');
    }
}
