@extends('layouts.layout')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Gérer les images du portfolio</h1>

    <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-4">
            <label>Image bannière</label>
            <input type="file" name="banner" class="form-control" accept="image/*">
            @if(isset($images['banner']))
                <div class="mt-2">
                    <img src="{{ $images['banner']->path }}" alt="Bannière" style="max-width: 200px;">
                    <p>Actuelle : {{ basename($images['banner']->path) }}</p>
                </div>
            @endif
        </div>

        <div class="form-group mb-4">
            <label>Image profil</label>
            <input type="file" name="profile" class="form-control" accept="image/*">
            @if(isset($images['profile']))
                <div class="mt-2">
                    <img src="{{ $images['profile']->path }}" alt="Profil" style="max-width: 150px; border-radius: 50%;">
                    <p>Actuelle : {{ basename($images['profile']->path) }}</p>
                </div>
            @endif
        </div>

        <div class="form-group mb-4">
            <label>Image À propos (about)</label>
            <input type="file" name="about" class="form-control" accept="image/*">
            @if(isset($images['about']))
                <div class="mt-2">
                    <img src="{{ $images['about']->path }}" alt="About" style="max-width: 200px;">
                    <p>Actuelle : {{ basename($images['about']->path) }}</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

    <hr>
<div class="documents-section">
    <div class="documents-header">
        <h2>📄 Mes documents</h2>
        <p class="text-muted">Gérez vos documents (CV, attestations, etc.)</p>
    </div>

    @if($documents->count())
        <div class="list-group">
            @foreach($documents as $doc)
                <div class="list-group-item document-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-pdf document-icon"></i>
                        <div>
                            <strong>{{ $doc->title }}</strong>
                            <span class="document-size ms-2">{{ $doc->size }} Ko</span>
                        </div>
                    </div>
                    <!-- Formulaire de suppression -->
                    <form action="{{ route('documents.destroy', $doc) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ce document ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Aucun document pour le moment.
        </div>
    @endif
</div>

    <h3>Ajouter un nouveau document</h3>
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre du document</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Fichier (PDF, DOC, DOCX, max 5 Mo)</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Ordre d'affichage</label>
            <input type="number" name="order" id="order" class="form-control" value="0">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Actif (visible par les recruteurs)</label>
        </div>

        <button type="submit" class="btn btn-success">Uploader</button>
    </form>
</div>
@endsection
