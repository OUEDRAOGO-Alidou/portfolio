@extends('layouts.layout')

@section('title', 'Ajouter un service')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ajouter un service</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titre *</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icône (classe FontAwesome ex: fas fa-code)</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}">
                    <small class="form-text text-muted">Exemple : <code>fas fa-laptop-code</code>
                        Liste des icônes : <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                        ou laisser vide.</small>
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}">
                    <small class="form-text text-muted">Plus le chiffre est petit, plus le service apparaît en premier.</small>
                    @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Actif (affiché sur le site)</label>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
