<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Account;
use App\Models\Customer;
use Livewire\Component;

class CustomerInfo extends Component
{
    public $customerId;
    public $nom, $email, $etat, $prenom,$activite,$telephone,$adresse, $image,$customer;
    public $activeTab = 'infos'; // onglet par défaut

    protected $listeners = ['viewCustomer' => 'loadCustomer'];

    public function showTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function loadCustomer($customer_id)
    {


        $this->customer = Customer::with('accounts')
            ->where('id_customer', $customer_id)
            ->firstOrFail();


        $this->customerId = $this->customer->id_customer;
        $this->nom = $this->customer->nom;
        $this->prenom = $this->customer->prenom;
        $this->telephone=$this->customer->telephone;
        $this->activite = $this->customer->activite;
        $this->email = $this->customer->email;
        $this->etat = $this->customer->etat;
        $this->adresse = $this->customer->adresse;
        $this->image = $this->customer->image; // Assure-toi que c’est le chemin relatif


        $this->dispatch('openInfoModal');
    }
    public function render()
    {
        return view('livewire.admin.customers.customer-info',[
            'customer'=>$this->customer,

        ]);
    }
}
