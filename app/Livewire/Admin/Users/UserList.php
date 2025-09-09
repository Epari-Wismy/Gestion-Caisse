<?php

namespace App\Livewire\Admin\Users;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    public $search='';

    protected $queryString =['search'];
    protected $paginationTheme= "bootstrap";
    protected $listeners = ['userDeleted' => '$refresh',  'userUpdated' => '$refresh',];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $users= User::where('name','like','%'.$this->search.'%')
            ->orwhere('email','like','%'.$this->search.'%')
            ->orwhere('role','like','%'.$this->search.'%')
            ->paginate(5);

        return view('livewire.admin.users.user-list',[
           "users"=> $users,
        ])->layout('layouts.app');
    }
}
