<div wire:ignore.self class="modal fade" id="createCustomerModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form wire:submit.prevent="save" class="w-100">
            <div class="modal-content shadow-lg border-0">
                <!-- Header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold" id="createCustomerModalLabel">
                        <i class="fas fa-user-plus mr-2"></i> Ajouter un Client
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">
                    <!-- Ligne 1 : Nom & Email & adresse -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-user mr-1 text-success"></i> Nom</label>
                            <input type="text" class="form-control rounded" wire:model.defer="nom" placeholder="Entrez le nom ">
                            @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-envelope mr-1 text-success"></i> Prenom</label>
                            <input type="text" class="form-control rounded" wire:model.defer="prenom" placeholder="Entrer le prenom">
                            @error('prenom') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-envelope mr-1 text-success"></i> Adresse</label>
                            <input type="text" class="form-control rounded" wire:model.defer="adresse" placeholder="Entrer l'adresse">
                            @error('adresse') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Ligne 2 : telephone & Email & activite -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-phone mr-1 text-success"></i> telephone</label>
                            <input type="text" class="form-control rounded" wire:model.defer="telephone" placeholder="Entrez le telephone ">
                            @error('telephone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-envelope mr-1 text-success"></i> email</label>
                            <input type="email" class="form-control rounded" wire:model.defer="email" placeholder="example@gmail.com">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-user-shield mr-1 text-success"></i> Activite</label>
                            <select class="form-control rounded" wire:model.defer="activite">
                                <option value="Commercant">Commercant</option>
                                <option value="Etudiant">Etudiant</option>
                                <option value="Eleve">Eleve</option>
                                <option value="Chauffeur">Chauffeur</option>
                                <option value="Autre">Autre</option>
                            </select>
                            @error('activite') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Ligne 3 : Statut & Image -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-toggle-on mr-1 text-success"></i>Etat</label>
                            <select class="form-control rounded" wire:model.defer="etat">
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                                <option value="bloquer">Bloqué</option>
                            </select>
                            @error('etat') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-toggle-on mr-1 text-success"></i>Plan</label>
                            <select class="form-control rounded" wire:model.defer="montant_plan">
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                            @error('montant_plan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label><i class="fas fa-envelope mr-1 text-success"></i> Jours</label>
                            <input type="number" class="form-control rounded" wire:model.defer="nb_jours" placeholder="28" min="28">
                            @error('nb_jours') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label><i class="fas fa-image mr-1 text-success"></i> Image de profil</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                            @if($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Ajouter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', () => {
            $('#createCustomerModal').modal('hide'); // jQuery Bootstrap 4
        });

        Livewire.on('swal', data => {
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                confirmButtonText: 'OK'
            });
        });
    });
</script>
