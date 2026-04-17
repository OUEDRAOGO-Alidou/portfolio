@extends('layouts.layout')

@section('title', 'Ajouter une formation')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Ajouter une expérience</h2></div>
        <div class="card-body">
            <form action="{{ route('experiences.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Titre *</label>
                    <input type="text" name="titre" class="form-control" required value="{{ old('titre') }}">
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
                <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
