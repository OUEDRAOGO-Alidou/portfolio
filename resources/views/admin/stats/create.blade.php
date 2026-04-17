@extends('layouts.layout')
@section('title', 'Ajouter une statistique')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Ajouter une statistique</h1>

    <form action="{{ route('stats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Icône (classe Bootstrap Icons)</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', 'bi-briefcase') }}" required>
            <small>Ex:<code>fas fa-laptop-code</code> Liste des icônes : <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
        </div>

        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label>Valeur (nombre)</label>
            <input type="number" name="value" class="form-control" value="{{ old('value') }}" required>
        </div>

        <div class="mb-3">
            <label>Lien (optionnel)</label>
            <input type="url" name="link" class="form-control" value="{{ old('link') }}">
            <small>Ex: {{ route('performence.project') }} ou toute autre URL</small>
        </div>

        <div class="mb-3">
            <label>Ordre d’affichage</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" @checked(old('is_active', false))>
            <label class="form-check-label">Actif</label>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('stats.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
