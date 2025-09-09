<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class DashboardPage extends Component
{
    public $search ='';
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-page')->layout('layouts.app');
    }
}
