@extends('layouts.layout')

@section('title', 'Gestion des témoignages')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Témoignages</h1>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">+ Nouveau témoignage</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Poste</th>
                        <th>Témoignage</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->order }}</td>
                            <td>
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                                @else
                                    <img src="https://via.placeholder.com/50" width="50" height="50" style="border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->position }}</td>
                            <td>{{ Str::limit($testimonial->message, 60) }}</td>
                            <td>
                                @if($testimonial->is_active)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce témoignage ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Aucun témoignage</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
