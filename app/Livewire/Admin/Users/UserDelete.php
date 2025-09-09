<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class UserDelete extends Component
{

    public $userId;

    protected $listeners = ['deleteUser' => 'loadUser'];

    public function loadUser($id)
    {
        $this->userId = $id;
        $this->dispatch('openDeleteModal'); // on déclenche l’ouverture du modal
    }

    public function delete()
    {
        $user = User::findOrFail($this->userId);
        $user->delete();

        $this->dispatch('userDeleted'); // informe la liste
        $this->dispatch('closeDeleteModal'); // ferme le modal
        $this->dispatch('swal',
            title:'Succès',
            text: 'Utilisateur supprimé avec succès',
            icon:'success'
        );
        // ⚡️ Événement pour rafraîchir la liste
        $this->dispatch('userDeleted');
    }
    public function render()
    {
        return view('livewire.admin.users.user-delete');
    }
}
