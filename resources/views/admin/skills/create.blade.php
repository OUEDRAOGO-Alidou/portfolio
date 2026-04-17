@extends('layouts.layout')

@section('title', 'Ajouter une compétence')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Nouvelle compétence</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('skills.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nom *</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="percentage" class="form-label">Pourcentage * (0-100)</label>
                    <input type="number" name="percentage" id="percentage" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" min="0" max="100" required>
                    @error('percentage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icône (Bootstrap Icons)</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}" placeholder="ex: bi bi-code-slash">
                    <small class="form-text text-muted">
                        Liste des icônes : <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                    </small>
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}">
                    <small class="form-text text-muted">Plus le chiffre est petit, plus il apparaît en premier.</small>
                    @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Actif (affiché sur le site)</label>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('skills.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
