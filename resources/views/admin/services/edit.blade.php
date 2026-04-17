@extends('layouts.layout')

@section('title', 'Modifier le service')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Modifier : {{ $service->title }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Titre *</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $service->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $service->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icône (classe FontAwesome)</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $service->icon) }}">
                    <small class="form-text text-muted">Exemple : <code>fas fa-chart-line</code></small>
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $service->order) }}">
                    <small class="form-text text-muted">Plus le chiffre est petit, plus le service apparaît en premier.</small>
                    @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Actif (affiché sur le site)</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
