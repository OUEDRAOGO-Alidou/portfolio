@extends('layouts.layout')

@section('title', 'Gestion des formations')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Formations</h1>
        <a href="{{ route('formations.create') }}" class="btn btn-primary">+ Nouvelle formation</a>
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
                        <th>Diplôme</th>
                        <th>Année</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formations as $formation)
                        <tr>
                            <td>{{ $formation->order }}</td>
                            <td>{{ $formation->diplome }}</td>
                            <td>{{ $formation->annee }}</td>
                            <td>{{ Str::limit($formation->description, 50) }}</td>
                            <td>
                                <a href="{{ route('formations.edit', $formation) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('formations.destroy', $formation) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Aucune formation</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
