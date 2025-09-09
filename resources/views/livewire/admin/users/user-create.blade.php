<div wire:ignore.self class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form wire:submit.prevent="save" class="w-100">
            <div class="modal-content shadow-lg border-0">
                <!-- Header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold" id="createUserModalLabel">
                        <i class="fas fa-user-plus mr-2"></i> Ajouter un utilisateur
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">
                    <!-- Ligne 1 : Nom & Email -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-user mr-1 text-success"></i> Nom</label>
                            <input type="text" class="form-control rounded" wire:model.defer="name" placeholder="Entrez le nom complet">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-envelope mr-1 text-success"></i> Email</label>
                            <input type="email" class="form-control rounded" wire:model.defer="email" placeholder="exemple@mail.com">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Ligne 2 : Mot de passe & Rôle -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-lock mr-1 text-success"></i> Mot de passe</label>
                            <input type="password" class="form-control rounded" wire:model.defer="password" placeholder="6 caractères minimum">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-user-shield mr-1 text-success"></i> Rôle</label>
                            <select class="form-control rounded" wire:model.defer="role">
                                <option value="caissier">Caissier</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Ligne 3 : Statut & Image -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-toggle-on mr-1 text-success"></i> Statut</label>
                            <select class="form-control rounded" wire:model.defer="statut">
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                                <option value="bloquer">Bloqué</option>
                            </select>
                            @error('statut') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-6">
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
            $('#createUserModal').modal('hide'); // jQuery Bootstrap 4
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
