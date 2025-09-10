<?php

namespace App\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Models\Account;
class CustomerList extends Component
{

    use WithPagination;
    public $search='';
    protected  $listeners =['customerDeleted'=>'$refresh','customerUpdated'=>'$refresh','customerCreate'=>'$refresh'];
    protected $paginationTheme= "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {


        $customer = Customer::where('nom','like','%'.$this->search.'%')
            ->orwhere('email','like','%'.$this->search.'%')
            ->orwhere('id_customer','like','%'.$this->search.'%')
            ->paginate(5);
        return view('livewire.admin.customers.customer-list',[
            "customers"=>$customer,
        ])->layout('layouts.app');
    }
}
