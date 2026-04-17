{{-- resources/views/admin/stats/edit.blade.php --}}
@extends('layouts.layout')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Modifier la statistique</h1>

    <form action="{{ route('stats.update', $stat) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Icône (classe Bootstrap Icons)</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $stat->icon) }}" required>
            <small>Ex: bi-briefcase, bi-people, bi-bar-chart, bi-mortarboard</small>
        </div>

        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $stat->title) }}" required>
        </div>

        <div class="mb-3">
            <label>Valeur (nombre)</label>
            <input type="number" name="value" class="form-control" value="{{ old('value', $stat->value) }}" required>
        </div>

        <div class="mb-3">
            <label>Lien (optionnel)</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $stat->link) }}">
            <small>Ex: {{ route('performence.project') }}</small>
        </div>

        <div class="mb-3">
            <label>Ordre d’affichage</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $stat->order) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" @checked(old('is_active', $stat->is_active))>
            <label class="form-check-label">Actif</label>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('stats.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
