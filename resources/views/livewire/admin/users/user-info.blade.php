<div wire:ignore.self class="modal fade" id="infoUserModal" tabindex="-1" role="dialog" aria-labelledby="infoUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold" id="infoUserModalLabel">
                    <i class="fas fa-user-circle mr-2"></i> Informations de l'utilisateur
                    <span class="font-weight-bold text-white-50"> -  {{ $userId }}</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    @if($image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Photo profil" class="rounded-circle" width="100">
                    @else
                        <i class="fas fa-user-circle fa-5x text-secondary"></i>
                    @endif
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nom</label>
                        <input type="text" class="form-control" value="{{ $name }}" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ $email }}" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Rôle</label>
                        <input type="text" class="form-control" value="{{ $role }}" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Statut</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ucfirst($statut) }}" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text bg-light">
                                    @if($statut === 'actif')
                                        <i class="fas fa-check text-success"></i>
                                    @elseif($statut === 'inactif')
                                        <i class="fas fa-minus text-secondary"></i>
                                    @elseif($statut === 'bloquer')
                                        <i class="fas fa-times text-danger"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Fermer
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openInfoModal', () => {
            $('#infoUserModal').modal('show'); // Bootstrap 4
        });
    });
</script>
