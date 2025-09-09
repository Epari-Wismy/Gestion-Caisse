<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class UserPermission extends Component
{
    public function render()
    {
        return view('livewire.admin.users.user-permission')->layout('layouts.app');
    }
}
