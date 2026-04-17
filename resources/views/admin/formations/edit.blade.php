@extends('layouts.layout')

@section('title', 'Modifier une formation')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Modifier : {{ $formation->diplome }}</h2></div>
        <div class="card-body">
            <form action="{{ route('formations.update', $formation) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Diplôme *</label>
                    <input type="text" name="diplome" class="form-control" required value="{{ old('diplome', $formation->diplome) }}">
                </div>
                <div class="mb-3">
                    <label>Année *</label>
                    <input type="text" name="annee" class="form-control" required value="{{ old('annee', $formation->annee) }}">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $formation->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $formation->order) }}">
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('formations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
