<style>
    /* Style pour la section documents */
    .documents-section {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .documents-header {
        border-left: 5px solid #0d6efd;
        padding-left: 1rem;
        margin-bottom: 1.5rem;
    }

    .document-item {
        transition: all 0.2s ease-in-out;
        border-radius: 12px !important;
        margin-bottom: 0.5rem;
        border: 1px solid #e9ecef;
    }

    .document-item:hover {
        transform: translateX(8px);
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-color: #0d6efd;
    }

    .document-icon {
        font-size: 1.4rem;
        margin-right: 12px;
        color: #0d6efd;
    }

    .document-size {
        font-size: 0.75rem;
        font-weight: normal;
        background: #e9ecef;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .btn-download {
        border-radius: 30px;
        padding: 0.25rem 1rem;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-download:hover {
        background-color: #0d6efd;
        color: white !important;
    }

</style>
<div class="documents-section">
    <div class="documents-header">
        <h2 class="mb-0">📄 Mes documents</h2>
        <p class="text-muted mb-0">CV, attestations, et autres fichiers utiles</p>
    </div>

    @if($documents->count())
        <div class="list-group">
            @foreach($documents as $doc)
                <div class="list-group-item document-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-pdf document-icon"></i>
                        <!-- ou selon le type : fa-file-word, fa-file-alt -->
                        <div>
                            <strong>{{ $doc->title }}</strong>
                            <span class="document-size ms-2">{{ $doc->size }} Ko</span>
                        </div>
                    </div>
                    <a href="{{ route('public.download', $doc) }}" class="btn btn-sm btn-outline-primary btn-download">
                        <i class="fas fa-download"></i> Télécharger
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle"></i> Aucun document disponible pour le moment.
        </div>
    @endif
</div>
