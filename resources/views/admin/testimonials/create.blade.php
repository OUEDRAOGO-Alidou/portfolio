@extends('layouts.layout')

@section('title', 'Ajouter un témoignage')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Nouveau témoignage</h2></div>
        <div class="card-body">
            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Poste / Entreprise *</label>
                    <input type="text" name="position" class="form-control" required value="{{ old('position') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Témoignage *</label>
                    <textarea name="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image (carrée de préférence)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Format : jpeg, png, jpg, gif (max 2 Mo)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : ''}}>
                    <label class="form-check-label">Actif</label>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
