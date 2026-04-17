@extends('layouts.layout')

@section('title', 'Modifier un témoignage')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h2>Modifier : {{ $testimonial->name }}</h2></div>
        <div class="card-body">
            <form action="{{ route('testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $testimonial->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Poste *</label>
                    <input type="text" name="position" class="form-control" required value="{{ old('position', $testimonial->position) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Témoignage *</label>
                    <textarea name="message" rows="4" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image actuelle</label><br>
                    @if($testimonial->image)
                        <img src="{{ asset($testimonial->image) }}" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
                    @else
                        <span class="text-muted">Aucune image</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Nouvelle image (laisser vide pour conserver)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $testimonial->order) }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" {{ $testimonial->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Actif</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
