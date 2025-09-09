<div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form wire:submit.prevent="update" class="w-100" enctype="multipart/form-data">
            <div class="modal-content shadow-lg border-0">
                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="editUserModalLabel">
                        <i class="fas fa-user-edit mr-2"></i> Modifier un utilisateur
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-user mr-1 text-primary"></i> Nom</label>
                            <input type="text" class="form-control rounded" wire:model.defer="name" placeholder="Entrez le nom">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><i class="fas fa-envelope mr-1 text-primary"></i> Email</label>
                            <input type="email" class="form-control rounded" wire:model.defer="email" placeholder="exemple@mail.com">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-lock mr-1 text-primary"></i> Mot de passe</label>
                            <input type="password" class="form-control rounded" wire:model.defer="password" placeholder="Laisser vide pour ne pas changer">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><i class="fas fa-user-shield mr-1 text-primary"></i> Rôle</label>
                            <select class="form-control rounded" wire:model.defer="role">
                                <option value="caissier">Caissier</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <label><i class="fas fa-toggle-on mr-1 text-primary"></i> Statut</label>
                            <select class="form-control rounded" wire:model.defer="statut">
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                                <option value="bloquer">Bloqué</option>
                            </select>
                            @error('statut') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><i class="fas fa-image mr-1 text-primary"></i> Image de profil</label>
                            <input type="file" class="form-control-file" wire:model="image">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="100" alt="Prévisualisation">
                            @elseif($currentImage)
                                <img src="{{ asset('storage/' . $currentImage) }}" class="img-thumbnail mt-2" width="100" alt="Profil actuel">
                            @endif
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Sauvegarder
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {

        Livewire.on('openEditModal', () => {
            $('#editUserModal').modal('show'); // jQuery Bootstrap 4
        });

        Livewire.on('closeEditModal', () => {
            $('#editUserModal').modal('hide'); // jQuery Bootstrap 4
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
