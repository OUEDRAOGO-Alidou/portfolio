@extends('layouts.layout')

@section('title', 'Ajouter une formation')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Ajouter une formation</h2></div>
        <div class="card-body">
            <form action="{{ route('formations.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Diplôme *</label>
                    <input type="text" name="diplome" class="form-control" required value="{{ old('diplome') }}">
                </div>
                <div class="mb-3">
                    <label>Année *</label>
                    <input type="text" name="annee" class="form-control" placeholder="2025" required value="{{ old('annee') }}">
                </div>
                <div class="mb-3">
                    <label>Description (optionnel)</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('formations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
