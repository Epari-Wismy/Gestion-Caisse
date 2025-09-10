<div wire:ignore.self class="modal fade" id="infoCustomerModal" tabindex="-1" role="dialog" aria-labelledby="infoUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold" id="infoCustomerModalLabel">
                    <i class="fas fa-user-circle mr-2"></i> Informations du Client
                    <span class="font-weight-bold text-white-50"> | {{ $customerId }}</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">

                <!-- Stepper amélioré -->
                <div class="stepper-wrapper">
                    <div class="stepper-item active" data-step="1">
                        <div class="step-counter">1</div>
                        <div class="step-name">Infos Client</div>
                    </div>
                    <div class="stepper-item" data-step="2">
                        <div class="step-counter">2</div>
                        <div class="step-name">Comptes</div>
                    </div>
                </div>

                <!-- Contenu du stepper -->
                <div class="stepper-content" id="step-1-content">
                    <div class="text-center mb-4">
                        @if($image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Photo profil" class="rounded-circle" width="100">
                        @else
                            <i class="fas fa-user-circle fa-5x text-secondary"></i>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nom</label>
                            <input type="text" class="form-control" value="{{ $nom }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Prenom</label>
                            <input type="text" class="form-control" value="{{ $prenom }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $email }}" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Telephone</label>
                            <input type="text" class="form-control" value="{{ $telephone }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Activite</label>
                            <input type="text" class="form-control" value="{{ $activite }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Etat</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ ucfirst($etat) }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light">
                                        @if($etat === 'actif')
                                            <i class="fas fa-check text-success"></i>
                                        @elseif($etat === 'inactif')
                                            <i class="fas fa-minus text-secondary"></i>
                                        @elseif($etat === 'bloquer')
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary" onclick="showStep(2)">
                            Suivant <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="stepper-content d-none" id="step-2-content">
                    <h5 class="mb-4 text-center"><i class="fas fa-wallet mr-2"></i>Comptes du Client</h5>

                    @if($customer && $customer->accounts && count($customer->accounts) > 0)
                        @foreach($customer->accounts as $account)
                            @php
                                $pourcentage = 0;
                                if ($account->nb_jours > 0) {
                                    $pourcentage = (1 - ($account->nb_jours_rester / $account->nb_jours)) * 100;
                                }

                                // Déterminer la couleur en fonction du pourcentage
                                $progressColor = 'bg-success';
                                if ($pourcentage < 30) {
                                    $progressColor = 'bg-danger';
                                } elseif ($pourcentage < 70) {
                                    $progressColor = 'bg-warning';
                                }
                            @endphp

                            <div class="card account-card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 border-right">
                                            <h6 class="card-title text-info">Compte #{{ $account->id_account }}</h6>
                                            <p class="mb-1"><small class="text-muted">Créé le: {{ $account->created_at->format('d/m/Y') }}</small></p>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row mb-2">
                                                <div class="col-sm-4">
                                                    <strong>Montant:</strong> {{ $account->montant_plan }} Gdes
                                                </div>
                                                <div class="col-sm-4">
                                                    <strong>Jours total:</strong> {{ $account->nb_jours }}
                                                </div>
                                                <div class="col-sm-4">
                                                    <strong>Jours restants:</strong>
                                                    <span class="{{ $account->nb_jours_rester < 7 ? 'text-danger' : 'text-success' }}">
                                                        {{ $account->nb_jours_rester }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="d-flex justify-content-between">
                                                    <small>Progression:</small>
                                                    <small><strong>{{ round($pourcentage, 1) }}%</strong></small>
                                                </div>
                                                <div class="progress progress-sm mt-1">
                                                    <div class="progress-bar {{ $progressColor }}"
                                                         role="progressbar"
                                                         style="width: {{ $pourcentage }}%"
                                                         aria-valuenow="{{ $pourcentage }}"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun compte trouvé pour ce client.</p>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-secondary" onclick="showStep(1)">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function showStep(stepNumber) {
        // Masquer tous les contenus de step
        document.querySelectorAll('.stepper-content').forEach(content => {
            content.classList.add('d-none');
        });

        // Afficher le contenu du step sélectionné
        document.getElementById('step-' + stepNumber + '-content').classList.remove('d-none');

        // Mettre à jour le stepper
        document.querySelectorAll('.stepper-item').forEach(item => {
            item.classList.remove('active', 'completed');
        });

        // Marquer les étapes précédentes comme complétées
        for (let i = 1; i < stepNumber; i++) {
            const stepItem = document.querySelector('.stepper-item[data-step="' + i + '"]');
            if (stepItem) {
                stepItem.classList.add('completed');
            }
        }

        // Marquer l'étape actuelle comme active
        const currentStepItem = document.querySelector('.stepper-item[data-step="' + stepNumber + '"]');
        if (currentStepItem) {
            currentStepItem.classList.add('active');
        }
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('openInfoModal', () => {
            $('#infoCustomerModal').modal('show');
            // Réinitialiser le stepper à la première étape
            setTimeout(() => showStep(1), 100);
        });
    });
</script>
