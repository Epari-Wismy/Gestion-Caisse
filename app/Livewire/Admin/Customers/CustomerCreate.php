<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Account;

class CustomerCreate extends Component
{
    use WithFileUploads; // ← Ajouter ceci
    public $nom,$prenom,$activite,$telephone, $email, $adresse, $etat = 'actif',$montant_plan,$nb_jours;
    //public $etat = 'actif';
    public $image;
    protected $rules = [
        'nom' => 'required|min:3',
        'email' => 'required|email|unique:customers,email',
        'prenom' => 'required|min:3',
        'adresse' => 'required',
        'activite'=>'required',
        'telephone'=>'required|max:20',
        'etat'=>'required|in:actif,inactif,bloquer',
        'image'=>'nullable|image|max:2048',
        'montant_plan'=>'required',
        'nb_jours'=>'required',
    ];

//Fonction pour générer un code xxxx-xxxx
    function generateCustomerCode() {
        return sprintf('%04d-%04d', rand(1000, 9999), rand(1000, 9999));
    }

    function generateAccountCode() {
        return sprintf('%04d-%04d', rand(1000, 9999), rand(1000, 9999));
    }

    public function save()
    {
        $this->validate();

        $code = $this->generateCustomerCode();
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('customers', 'public');
        }

        Customer::create([
            'id_customer'=>$code,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'etat' => $this->etat,
            'adresse' => $this->adresse,
            'activite' => $this->activite,
            'telephone' => $this->telephone,
            'image' => $imagePath,

        ]);

        Account::create([
            'id_account' => $this->generateAccountCode(),
            'id_customer' => $code,
            'montant_plan' => $this->montant_plan,
            'nb_jours' => $this->nb_jours,
            'solde' => 0.00,
            'nb_jours_rester' => $this->nb_jours,
            'etat' => 'actif',
        ]);

        // 🚀 Livewire 3 : on utilise dispatch() au lieu de emit()
        //  $this->dispatch('userAdded');
        $this->reset(['nom','email','telephone','etat','adresse','image','prenom','activite','montant_plan','nb_jours']);
        // Notification SweetAlert
        $this->dispatch('swal',
            title: 'Succès',
            text: 'Client ajouté avec succès',
            icon: 'success'
        );

        $this->dispatch('close-modal');
        $this->dispatch('customerCreate'); //rafraichir la liste

    }
    public function render()
    {
        return view('livewire.admin.customers.customer-create');
    }
}
