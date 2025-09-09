<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads; // ← Ajouter ceci

class UserCreate extends Component
{
    use WithFileUploads; // ← Ajouter ceci
    public $name, $email, $password, $role = 'caissier';
    public $statut = 'inactif';
    public $image;
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required',
        'statut'=>'required|in:actif,inactif,bloquer',
        'image'=>'nullable|image|max:2048',
    ];

    public function save()
    {
        $this->validate();
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('users', 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'statut' => $this->statut,
            'image' => $imagePath,

        ]);

        // 🚀 Livewire 3 : on utilise dispatch() au lieu de emit()
      //  $this->dispatch('userAdded');
        $this->reset(['name','email','password','role','statut','image']);
        // Notification SweetAlert
        $this->dispatch('swal',
            title: 'Succès',
            text: 'Utilisateur ajouté avec succès',
            icon: 'success'
        );
        $this->dispatch('close-modal');

    }

    public function render()
    {
        return view('livewire.admin.users.user-create');
    }
}
