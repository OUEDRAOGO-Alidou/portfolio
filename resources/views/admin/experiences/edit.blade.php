@extends('layouts.layout')

@section('title', 'Modifier une formation')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Modifier : {{ $experience->titre }}</h2></div>
        <div class="card-body">
            <form action="{{ route('experiences.update', $experience) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Titre *</label>
                    <input type="text" name="titre" class="form-control" required value="{{ old('titre', $experience->titre) }}">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $experience->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $experience->order) }}">
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
