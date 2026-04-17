@extends('layouts.layout')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>{{ isset($project) ? 'Modifier' : 'Ajouter' }} un projet</h1>
    <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($project) @method('PUT') @endisset

        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $project->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $project->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Catégorie</label>
            <input type="text" name="categorie" class="form-control" value="{{ old('categorie', $project->categorie ?? '') }}" required placeholder="Ex: Web, Data, Mobile, IA...">
            <small class="text-muted">Saisissez la catégorie de votre choix (une seule par projet).</small>
        </div>


        <div class="mb-3">
            <label>Technologies (séparées par des virgules)</label>
            <input type="text" name="technologies" class="form-control" value="{{ old('technologies', isset($project) ? implode(',', $project->technologies) : '') }}">
            <small>Ex: Laravel, Vue.js, MySQL</small>
        </div>

        <div class="mb-3">
            <label>Lien du projet (URL)</label>
            <input type="url" name="lien" class="form-control" value="{{ old('lien', $project->lien ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Chiffre clé (optionnel)</label>
            <input type="text" name="chiffre_cle" class="form-control" value="{{ old('chiffre_cle', $project->chiffre_cle ?? '') }}" placeholder="ex: +30% performance">
        </div>

       <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
          @if(isset($project) && $project->image && file_exists(public_path($project->image)))
            <img src="{{ asset($project->image) }}" width="100" class="mt-2">
            <p class="text-muted mt-1">Image actuelle. Laissez vide pour la conserver.</p>
        @endif
        </div>

        <div class="mb-3">
            <label>Ordre d'affichage (plus petit = plus haut)</label>
            <input type="number" name="ordre" class="form-control" value="{{ old('ordre', $project->ordre ?? 0) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ (old('is_active', $project->is_active ?? false) ? 'checked' : '') }}>
            <label class="form-check-label">Actif</label>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
