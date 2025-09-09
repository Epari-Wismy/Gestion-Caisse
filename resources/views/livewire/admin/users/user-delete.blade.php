<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="fas fa-trash"></i> Confirmation de suppression
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet utilisateur ?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" wire:click="delete" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {

        Livewire.on('openDeleteModal', () => {
            $('#deleteUserModal').modal('show'); // jQuery Bootstrap 4
        });
        Livewire.on('closeDeleteModal', () => {
            $('#deleteUserModal').modal('hide'); // jQuery Bootstrap 4
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
