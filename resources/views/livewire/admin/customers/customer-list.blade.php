<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>KobPam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Gest. Clients</a></li>
                        <li class="breadcrumb-item active">Lister</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary d-flex align-items-center">
                            <h3 class="card-title flex-grow-1"> <i class="fa fa-users fa-2x"></i> Liste des Clients</h3>


                            <div class="card-tools d-flex align-items-center">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-round ms-auto d-block"
                                    data-toggle="modal"
                                    data-target="#createCustomerModal"
                                >
                                    <i class="fa fa-plus"></i>
                                    Ajouter
                                </button>
                                <div class="input-group input-group-md " style="width: 250px;">
                                    <input type="text" wire:model.live="search" class="form-control float-right" placeholder="Rechercher...">


                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed ">
                                <thead>
                                <tr>
                                    <th style="width:5%;">Identifiant</th>
                                    <th style="width:25%;" class ="text-center">Client</th>
                                    <th style="width:25%;" >Telephone</th>
                                    <th style="width:20%;">Adresse</th>
                                    <th style="width:10%">Statut</th>
                                    <th style="width:15%";class="text-center" >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->id_customer}}</td>
                                        <td class ="text-center">{{$customer->nom." "}} {{"  "}} {{" ".$customer->prenom}} </td>
                                        <td>{{$customer->telephone}}</td>
                                        <td><span class="tag tag-success">{{$customer->adresse}}</span></td>
                                        <td class="text-center">
                                            @if($customer->etat === 'actif')
                                                <span class="badge bg-success btn-view me-2" style="cursor: pointer;"  data-code = "" >
                                                       <i class="fas fa-check"></i> <!-- Icône remove -->

                                        </span>

                                            @elseif($customer->etat === 'inactif')
                                                <span class="badge bg-secondary btn-view me-2" style="cursor: pointer;"  data-code = "" >
                                                       <i class="fas fa-minus"></i> <!-- Icône remove -->

                                        </span>

                                            @elseif($customer->etat === 'bloquer')
                                                <span class="badge bg-danger btn-view me-2" style="cursor: pointer;"  data-code = "" >
                                                       <i class="fas fa-times"></i> <!-- Icône remove -->

                                        </span>
                                            @endif
                                        </td>
                                        <td class ="text-center">

                                        <span class="badge bg-primary btn-edit-modal me-2" style="cursor: pointer;" data-code = "" wire:click="$dispatch('editUser',[{{$customer->id_customer}}])" >
                                                    <i class="fas fa-edit"></i> <!-- Icône remove -->
                                        </span>
                                            <span class="badge bg-danger btn-delete me-2"  style="cursor: pointer;"wire:click="$dispatch('deleteUser',[{{$customer->id_customer}}])">

                                                  <i class="fas fa-trash"></i>
                                        </span>

                                            <span class="badge bg-success btn-view me-2" style="cursor: pointer;"  data-code = ""
                                                  wire:click="$dispatch('viewCustomer', ['{{$customer->id_customer}}'])">
                                                       <i class="fas fa-eye"></i> <!-- Icône remove -->

                                        </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Modals -->
                            @livewire('admin.customers.customer-create')
                            @livewire('admin.customers.customer-info')
                        </div>
                        <!-- /.card-body -->
                        <div class = "card-footer">
                            {{$customers->links()}}

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->



        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

