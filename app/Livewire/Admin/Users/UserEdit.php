<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class UserEdit extends Component
{
    use WithFileUploads;
    public $userId;

    public $name , $email ,$password,$role,$statut,$image, $currentImage;

    protected $listeners = ['editUser'=>'loadUser'];

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6',
            'role' => 'required',
            'statut'=>'required|in:actif,inactif,bloquer',
            'image'=>'nullable|image|max:2048',
        ];
    }

    public  function loadUser($id){
//dd($id);
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->statut = $user->statut;
        $this->currentImage = $user->image;
        $this->email = $user->email;
        $this->password = null;

        //on ouvre le modal
        $this->dispatch('openEditModal');
    }

    public function update(){


        $this->validate();
        $user = User::findOrFail($this->userId);
        if($this->image){
            $imagePath = $this->image->store('users','public');
        } else {
            $imagePath = $this->currentImage;
        }

        $user->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'role'=>$this->role,
            'statut'=>$this->statut,
            'image'=>$imagePath,
            'password'=>$this->password ? Hash::make($this->password): $user->password,

        ]);

       $this->dispatch('closeEditModal');
       $this->dispatch('swal',
       title:'Succès',
       text: 'Utilisateur modifié avec succès',
        icon:'success'
       );
       $this->reset(['email','role','password','name','userId','statut','image','currentImage']);
       $this->dispatch('userUpdated'); //rafraichir la liste

    }
    public function render()
    {
        return view('livewire.admin.users.user-edit');
    }
}
